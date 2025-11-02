<?php
/* 
BengkelSempak — Gaje Project
Author: 0x6ick
Tagline: Nothing is useless — even underwear can be useful.

License: WTFPL v2
"You just DO WHAT THE FUCK YOU WANT TO"
*/
error_reporting(0);
set_time_limit(0);

// -------------------- Helpers --------------------
function is_possible_domain_folder($name) {
    return preg_match('/^([a-z0-9-]+\.)+[a-z]{2,}$/i', $name);
}
function normalize_lines($text){
    if ($text === null) return [];
    return preg_split("/\r\n|\n|\r/", trim($text));
}

// -------------------- Global Variables --------------------
$active_tool = 'grabber';
$grabber_output = '';
$ext_output = '';
$checker_output = '';
$checker_found_list_string = '';

// -------------------- MAIN LOGIC ROUTER --------------------

// --- 1. DOMAIN GRABBER (Runs on GET 'path') ---
$defaultPath = realpath(dirname(__FILE__)) . '/';
$baseInput = $_GET['path'] ?? '';
if ($baseInput !== '') {
    $active_tool = 'grabber';
    $base = rtrim($baseInput, '/') . '/';
    $domains_list = [];
    if (is_dir($base)) {
        $dirs = scandir($base);
        foreach ($dirs as $d) {
            if ($d === '.' || $d === '..') continue;
            if (is_dir($base . $d) && is_possible_domain_folder($d)) {
                $domains_list[] = "http://$d/";
            }
        }
        sort($domains_list);
        $grabber_output = implode(PHP_EOL, $domains_list);
    } else {
        $grabber_output = "ERROR: Path not found or is not a directory:\n" . htmlspecialchars($base);
    }
}

// --- 2. POST LOGIC (EXT Generator & Mass Checker) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    // --- 2a. EXT GENERATOR ---
    if ($_POST['action'] === 'ext_generate') {
        $active_tool = 'ext';
        $input_text = trim($_POST['urllist'] ?? '');
        $old_ext = trim($_POST['oldext'] ?? '');
        $new_ext = trim($_POST['newext'] ?? '');
        $lines = normalize_lines($input_text);
        $results = [];
        
        foreach ($lines as $url) {
            $u = trim($url);
            if ($u === '') continue;
            if ($old_ext !== '' && substr($u, -strlen($old_ext)) === $old_ext) {
                $results[] = substr($u, 0, -strlen($old_ext)) . $new_ext;
            } else {
                $results[] = $u . $new_ext;
            }
        }
        sort($results);
        $ext_output = implode(PHP_EOL, $results);
        @file_put_contents('ext.txt', $ext_output);
    }
     // --- 2b. MASS CHECKER ---
    if ($_POST['action'] === 'mass_check') {
        $active_tool = 'checker';
        
        ob_start(); // Start output buffering to catch all 'echo'
        
        $urls_raw = explode("\n", trim($_POST['urls']));
        $ext     = trim($_POST['ext']);
        $keyword = trim($_POST['keyword']);
        $mode    = $_POST['mode'] ?? 'normal';
        $target_mode = $_POST['target_mode'] ?? 'root';
        
        $urls = [];
        foreach ($urls_raw as $u) {
            if (trim($u) !== '') $urls[] = trim($u);
        }
        
        $keyword_is_empty = ($keyword === '');
        $total_urls = count($urls);
        $counts = ['found' => 0, 'miss' => 0, 'error' => 0, 'skip' => 0];
        $current_url = 1;
        
        // Summary
        echo '<div id="summary-box" class="summary-box">';
        echo '<div>TOTAL: <span id="s-total">' . $total_urls . '</span></div>';
        echo '<div>FOUND: <span id="s-found" style="color:lime">0</span></div>';
        echo '<div>MISS: <span id="s-miss" style="color:red">0</span></div>';
        echo '<div>ERRORS: <span id="s-error" style="color:orange">0</span></div>';
        echo '</div>';
        
        echo "<h4>Scan Results (Scan Mode: " . htmlspecialchars($mode) . " | Target Mode: " . htmlspecialchars($target_mode) . ")</h4>";
        
        $found_list = [];

        // --- FAST MODE (cURL) ---
        if ($mode === 'fast') {
            $multi_handle = curl_multi_init();
            $curl_handles = [];
            $url_map      = [];

            foreach ($urls as $url_input) {
                $test_url = $url_input;
                if (strpos($test_url, '://') === false) $test_url = 'http://' . $test_url;
                if (!filter_var($test_url, FILTER_VALIDATE_URL)) {
                    echo "<span style='color:orange'>($current_url/$total_urls) [SKIP]</span> Invalid Base URL: " . htmlspecialchars($url_input) . "<br>";
                    $counts['skip']++; $current_url++; continue;
                }
                
                $target = '';
                if ($target_mode === 'path') {
                    $base_url = preg_replace('/\/[^\/]*$/', '', $url_input);
                    $target = rtrim($base_url, '/') . '/' . $ext;
                } else {
                    $parsed_url = parse_url($test_url);
                    $target = ($parsed_url['scheme'] ?? 'http') . '://' . $parsed_url['host'] . '/' . $ext;
                }

                $ch = curl_init();
                curl_setopt_array($ch, [
                    CURLOPT_URL => $target, CURLOPT_RETURNTRANSFER => true, CURLOPT_HEADER => false,
                    CURLOPT_TIMEOUT => 15, CURLOPT_CONNECTTIMEOUT => 10, CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36'
                ]);
                curl_multi_add_handle($multi_handle, $ch);
                $curl_handles[] = $ch;
                $url_map[(string)$ch] = $target;
            }

            $running = null;
            do { curl_multi_exec($multi_handle, $running); usleep(100); } while ($running > 0);

            foreach ($curl_handles as $ch) {
                $target     = $url_map[(string)$ch];
                $resp       = curl_multi_getcontent($ch);
                $http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curl_error = curl_error($ch);
                $condition_met = false;

                if ($curl_error || $http_code == 0) {
                    echo "<span style='color:orange'>($current_url/$total_urls) [ERROR]</span> " . htmlspecialchars($target) . " <small>(cURL Error: " . htmlspecialchars($curl_error ? $curl_error : 'Connection Failed') . ")</small><br>";
                    $counts['error']++;
                } else {
                    if ($keyword_is_empty) { $condition_met = ($http_code == 200); }
                    else { $condition_met = ($http_code == 200 && $resp !== false && strpos($resp, $keyword) !== false); }
                    
                    if ($condition_met) {
                        echo "<span style='color:lime'>($current_url/$total_urls) [FOUND]</span> " . htmlspecialchars($target) . "<br>";
                        $counts['found']++; $found_list[] = $target;
                    } else {
                        echo "<span style='color:red'>($current_url/$total_urls) [MISS]</span> " . htmlspecialchars($target) . " <small>(Code: $http_code)</small><br>";
                        $counts['miss']++;
                    }
                }
                curl_multi_remove_handle($multi_handle, $ch);
                
                $current_url++;
            }
            curl_multi_close($multi_handle);
        }
        
        else {
            foreach ($urls as $url_input) {
                $test_url = $url_input;
                if (strpos($test_url, '://') === false) $test_url = 'http://' . $test_url;
                if (!filter_var($test_url, FILTER_VALIDATE_URL)) {
                    echo "<span style='color:orange'>($current_url/$total_urls) [SKIP]</span> Invalid Base URL: " . htmlspecialchars($url_input) . "<br>";
                    $counts['skip']++; $current_url++; continue;
                }

                $target = '';
                if ($target_mode === 'path') {
                    $base_url = preg_replace('/\/[^\/]*$/', '', $url_input);
                    $target = rtrim($base_url, '/') . '/' . $ext;
                } else {
                    $parsed_url = parse_url($test_url);
                    $target = ($parsed_url['scheme'] ?? 'http') . '://' . $parsed_url['host'] . '/' . $ext;
                }
                
                $context = stream_context_create([
                    "ssl" => ["verify_peer" => false, "verify_peer_name" => false],
                    "http" => [
                        "timeout" => 15,
                        "user_agent" => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36'
                    ]
                ]);
                
                $resp = @file_get_contents($target, false, $context);
                $condition_met = false;

                if ($resp === false) {
                    if (!isset($http_response_header)) {
                        echo "<span style='color:orange'>($current_url/$total_urls) [ERROR]</span> " . htmlspecialchars($target) . " <small>(Connection Failed)</small><br>";
                        $counts['error']++;
                    } else {
                        preg_match('/HTTP\/.* (\d{3})/', $http_response_header[0], $matches);
                        $http_code = $matches[1] ?? 'N/A';
                        echo "<span style='color:red'>($current_url/$total_urls) [MISS]</span> " . htmlspecialchars($target) . " <small>(Code: $http_code)</small><br>";
                        $counts['miss']++;
                    }
                } else {
                    if ($keyword_is_empty) { $condition_met = true; }
                    else { $condition_met = (strpos($resp, $keyword) !== false); }
                    
                    if ($condition_met) {
                        echo "<span style='color:lime'>($current_url/$total_urls) [FOUND]</span> " . htmlspecialchars($target) . "<br>";
                        $counts['found']++; $found_list[] = $target;
                    } else {
                        echo "<span style='color:red'>($current_url/$total_urls) [MISS]</span> " . htmlspecialchars($target) . " <small>(Keyword Not Found)</small><br>";
                        $counts['miss']++;
                    }
                }

                $current_url++;
            }
        }

        if (!empty($found_list)) {
            file_put_contents('found.txt', implode(PHP_EOL, $found_list) . PHP_EOL, FILE_APPEND);
            $checker_found_list_string = implode(PHP_EOL, $found_list);
        }
        echo "<br><a href='found.txt' target='blank' class='download'>Download found.txt</a>";
        

        echo "<script>";
        echo "document.getElementById('s-found').innerText = '" . $counts['found'] . "';";
        echo "document.getElementById('s-miss').innerText = '" . $counts['miss'] . "';";
        echo "document.getElementById('s-error').innerText = '" . $counts['error'] + $counts['skip'] . "';";
        echo "</script>";

        // Get buffered output and assign to variable
        $checker_output = ob_get_clean(); 
    }
}
// This closes the PHP block before HTML starts
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>BengkelSempak</title>
<style>
:root {
  --bg-deep: #121212;     
  --bg-main: #1a1a1a;     
  --text-main: #e0e0e0;   
  --text-muted: #8899aa;  
  --accent: #00f0e6;      
  --border: #334455;      
  --title: #ffffff;       
  --found: #50fa7b;       
  --miss: #ff5555;        
}

*{box-sizing:border-box}
body{
  margin:0; font-family:"Courier New",Courier,monospace;
  
  background: linear-gradient(180deg, var(--bg-deep) 0%, var(--bg-main) 100%);
  
  color: var(--text-main); 
  display:flex; justify-content:center; padding:26px;
}
.wrap{width:100%;max-width:980px}
.header{text-align:center;margin-bottom:14px}
.title{
  font-size:42px;
  
  color: var(--title);
  
  text-shadow: 0 0 10px rgba(0, 240, 230, 0.2); 
  letter-spacing:2px;margin:6px 0;font-weight:700
}
.card{
  background:transparent;
  padding:14px;border-radius:8px;
  border: 1px solid var(--border);
}
.tabs{display:flex;gap:8px;margin:16px 0}
.tab{
  flex:1;padding:12px;
  background:rgba(0,0,0,0.5);
  border: 1px solid var(--border);
  color: var(--text-muted); 
  text-align:center;cursor:pointer;border-radius:6px;font-weight:600;
  transition: all 0.2s ease;
}
.tab:hover {
  color: var(--text-main);
  border-color: var(--accent);
}
.tab.active{
  background: var(--accent); 
  color: var(--bg-deep); 
  box-shadow: 0 0 18px rgba(0, 240, 230, 0.2);
  border-color: var(--accent);
}
.panel{
  margin-top:12px;padding:16px;border-radius:8px;
  background: var(--bg-deep);
  border: 1px solid var(--border);
  display:none;
}
label{
  display:block;
  color: var(--text-muted);
  margin:8px 0 6px;font-size:14px
}
.input, textarea, select {
  width:100%;padding:10px 12px;
  background:transparent;
  border: 1px solid var(--border);
  color: var(--text-main); 
  border-radius:6px;outline:none;font-family:inherit;
  transition: all 0.2s ease;
}

.input:focus, textarea:focus, select:focus {
  border-color: var(--accent);
  box-shadow: 0 0 10px rgba(0, 240, 230, 0.2);
}
textarea{min-height:140px;resize:vertical}
.btn{
  display:inline-block;
  background: var(--accent);
  color: var(--bg-deep); 
  padding:10px 18px;margin-top:10px;border-radius:6px;
  font-weight:700;cursor:pointer;border:0;
  transition: all 0.2s ease;
}
.btn:hover {
  opacity: 0.8;
}
.btn.secondary{
  background: transparent;
  color: var(--accent);
  border: 1px solid var(--accent);
}
.btn.secondary:hover {
  background: var(--accent);
  color: var(--bg-deep);
  opacity: 1;
}
.small{
  font-size:13px;
  color: var(--text-muted); 
}
.result{
  margin-top:12px;padding:12px;
  background: var(--bg-deep); 
  border: 1px dashed var(--border); 
  border-radius:6px;
  color: var(--text-main); 
  white-space:pre-wrap;font-family:monospace
}
.footer{
  text-align:center;
  color: var(--text-muted); 
  margin-top:18px;font-size:13px
}
.flex{display:flex;gap:10px;align-items:flex-start}
.col{flex:1}
a.download{
  color: var(--accent); 
  font-weight:700;text-decoration:none
}
.checker-result { 
  margin-top:15px; padding:10px; 
  background: #000; 
  border-radius: 5px; border: 1px solid var(--border); 
  max-height: 300px; overflow-y: auto; 
}
//t.me/yungx6ick
.checker-result span[style*="color:lime"] { color: var(--found) !important; }
.checker-result span[style*="color:red"] { color: var(--miss) !important; }
.checker-result span[style*="color:orange"] { color: #ffb86c !important; } 

.summary-box {
  display: flex;
  justify-content: space-around;
  background: var(--bg-deep); 
  padding: 15px;
  border-radius: 6px;
  border: 1px solid var(--accent); 
  margin-bottom: 15px;
  font-size: 1.2em;
  font-weight: bold;
}

.summary-box span[style*="color:lime"] { color: var(--found) !important; }
.summary-box span[style*="color:red"] { color: var(--miss) !important; }

.summary-box div {
  flex: 1;
  text-align: center;
}
</style>
<script>
function showTab(id){
  document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
  document.querySelectorAll('.panel').forEach(p=>p.style.display='none');
  document.getElementById('tab-'+id).classList.add('active');
  document.getElementById('panel-'+id).style.display='block';
}
function copyTxt(id){
  const el = document.getElementById(id);
  if (!el) return;
  navigator.clipboard.writeText(el.value).then(()=>alert('Copied!'));
}
//0x6ick.my.id
window.addEventListener('DOMContentLoaded', ()=> showTab('<?php echo $active_tool; ?>'));
</script>
</head>
<body>
<div class="wrap">
  <div class="header">
    <div class="title">BengkelSempak</div>
    <div class="small">Tidak ada yang sia-sia,bahkan sempak juga punya manfaat.</div>
  </div>

  <div class="card">
    <div class="tabs">
      <div class="tab" id="tab-grabber" onclick="showTab('grabber')">Domain Grabber</div>
      <div class="tab" id="tab-ext" onclick="showTab('ext')">EXT Generator</div>
      <div class="tab" id="tab-checker" onclick="showTab('checker')">Mass Checker</div>
    </div>

    <div class="panel" id="panel-grabber">
      <h3>Domain Grabber</h3>
      <div class="small">Scans a local directory for folder names that look like domains.</div>
      <form method="GET" action="">
        <label for="path">Local Directory Path</label>
        <input type="text" name="path" class="input" value="<?php echo htmlspecialchars($baseInput); ?>" placeholder="<?php echo htmlspecialchars($defaultPath); ?>">
        <button type="submit" class="btn">Grab Domains</button>
      </form>
      
      <?php if (!empty($grabber_output)): ?>
      <label style="margin-top:15px;">Results</label>
      <textarea id="grabber-result" class="result" rows="10"><?php echo htmlspecialchars($grabber_output); ?></textarea>
      <div class="btn secondary" onclick="copyTxt('grabber-result')">Copy to Clipboard</div>
      <?php endif; ?>
    </div>

    <div class="panel" id="panel-ext">
      <h3>EXT Generator</h3>
      <div class="small">Replaces or appends text to each line from a list of URLs.</div>
      <form method="POST" action="">
        <input type="hidden" name="action" value="ext_generate">
        <div class="flex">
          <div class="col">
            <label for="urllist">URL List</label>
            <textarea name="urllist" placeholder="http://domain.com/file.txt..."><?php echo htmlspecialchars($_POST['urllist'] ?? ''); ?></textarea>
          </div>
          <div class="col">
            <label for="oldext">Old Extension (Optional)</label>
            <input type="text" name="oldext" class="input" placeholder=".txt" value="<?php echo htmlspecialchars($_POST['oldext'] ?? ''); ?>">
            <label for="newext">New Extension</label>
            <input type="text" name="newext" class="input" placeholder=".php" value="<?php echo htmlspecialchars($_POST['newext'] ?? ''); ?>">
            <button type="submit" class="btn">Generate</button>
            <?php if (file_exists('ext.txt') && filesize('ext.txt') > 0): ?>
              <a href="ext.txt" target="_blank" class="download" style="margin-left:10px;">Download ext.txt (<?php echo filesize('ext.txt'); ?> bytes)</a>
            <?php endif; ?>
          </div>
        </div>
      </form>
      
      <?php if (!empty($ext_output)): ?>
      <label style="margin-top:15px;">Results</label>
      <textarea id="ext-result" class="result" rows="10"><?php echo htmlspecialchars($ext_output); ?></textarea>
      <div class="btn secondary" onclick="copyTxt('ext-result')">Copy to Clipboard</div>
      <?php endif; ?>
    </div>

    <div class="panel" id="panel-checker">
      <h3>Mass Checker</h3>
      <div class="small">Checks a list of URLs for a specific path and keyword.</div>
      <form method="POST" action="">
        <input type="hidden" name="action" value="mass_check">
        <label>URL List</label>
        <textarea name="urls" rows="8" placeholder="Enter list of URLs, one per line..."><?php echo htmlspecialchars($_POST['urls'] ?? ''); ?></textarea>
        
        <div class="flex">
            <div class="col">
                <label>Path / File</label>
                <input name="ext" class="input" placeholder="Example: .env or shell.php" value="<?php echo htmlspecialchars($_POST['ext'] ?? ''); ?>">
            </div>
            <div class="col">
                <label>Keyword</label>
                <input name="keyword" class="input" placeholder="Keyword (optional, checks HTTP 200 if empty)" value="<?php echo htmlspecialchars($_POST['keyword'] ?? ''); ?>">
            </div>
            <div class="col">
                <label>Target Mode</label>
                <select name="target_mode" class="input">
                    <option value="root" <?php echo (($_POST['target_mode'] ?? 'root') == 'root') ? 'selected' : ''; ?>>Append to Domain Root</option>
                    <option value="path" <?php echo (($_POST['target_mode'] ?? '') == 'path') ? 'selected' : ''; ?>>Append to URL Path</option>
                </select>
            </div>
            <div class="col">
                <label>Scan Mode</label>
                <select name="mode" class="input">
                    <option value="normal" <?php echo (($_POST['mode'] ?? 'normal') == 'normal') ? 'selected' : ''; ?>>Normal Mode (Stable, Slower)</option>
                    <option value="fast" <?php echo (($_POST['mode'] ?? '') == 'fast') ? 'selected' : ''; ?>>Fast Mode (Super Fast, cURL)</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn">Scan Now</button>
      </form>

      <?php if (!empty($checker_output)): ?>
        
        <label style="margin-top:15px;">Live Scan Log</label>
        <div class="checker-result">
          <?php echo $checker_output; // This contains live HTML output ?>
        </div>
        
        <?php if (!empty($checker_found_list_string)): ?>
          <label style="margin-top:15px;">Found Results (List)</label>
          <textarea id="checker-result-list" class="result" rows="8"><?php echo htmlspecialchars($checker_found_list_string); ?></textarea>
          <div class="btn secondary" onclick="copyTxt('checker-result-list')">Copy to Clipboard</div>
        <?php endif; ?>

      <?php endif; ?>
    </div>
  </div> <div class="footer">
    0x6ick — Gaje Project
  </div>
</div>
</body>
</html>
