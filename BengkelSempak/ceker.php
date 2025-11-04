<?php

set_time_limit(0);

// --- Main logic to process the form on POST request ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $urls    = explode("\n", trim($_POST['urls']));
    $keyword = trim($_POST['keyword']);
    $mode    = $_POST['mode'] ?? 'normal'; // Default to 'normal'
    $scan_type = $_POST['scan_type'] ?? 'direct'; // direct or custom
    
    $found   = [];

    echo "<style>body{font-family: monospace; background-color: #121212; color: #e0e0e0;}</style>";
    echo "<h3>Scan Results (Mode: " . htmlspecialchars($mode) . ")</h3>";

    // ===================================================================
    // FAST MODE (using cURL Multi for parallel requests)
    // ===================================================================
    if ($mode === 'fast') {
        $multi_handle = curl_multi_init();
        $curl_handles = [];
        $url_map      = [];

        // 1. Initialize all cURL handles
        foreach ($urls as $url_input) {
            $url_input = trim($url_input);
            if (empty($url_input)) continue;

            // For direct scan, use the URL as-is
            if ($scan_type === 'direct') {
                $targets = [$url_input];
            } else {
                // Custom scan - append extension to base URL
                $ext = trim($_POST['ext']);
                $base_url = preg_replace('/\/[^\/]*$/', '', $url_input);
                $targets = [rtrim($base_url, '/') . '/' . $ext];
            }

            // Create cURL handles for each target
            foreach ($targets as $target) {
                if (!filter_var($target, FILTER_VALIDATE_URL)) {
                    echo "<span style='color:orange'>[SKIP]</span> Invalid URL: " . htmlspecialchars($target) . "<br>";
                    continue;
                }

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $target);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36');

                curl_multi_add_handle($multi_handle, $ch);
                $curl_handles[] = $ch;
                $url_map[(string)$ch] = $target; // Map the handle resource to its target URL
            }
        }

        // 2. Execute all requests in parallel
        $running = null;
        do {
            curl_multi_exec($multi_handle, $running);
            usleep(100);
        } while ($running > 0);

        // 3. Process the results
        foreach ($curl_handles as $ch) {
            $target     = $url_map[(string)$ch];
            $resp       = curl_multi_getcontent($ch);
            $http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curl_error = curl_error($ch);

            if ($curl_error) {
                echo "<span style='color:red'>[ERROR]</span> " . htmlspecialchars($target) . " <small>(cURL Error: " . htmlspecialchars($curl_error) . ")</small><br>";
            } elseif ($http_code == 200 && $resp !== false) {
                // Check if keyword is found or if no keyword specified
                if (empty($keyword) || strpos($resp, $keyword) !== false) {
                    echo "<span style='color:lime'>[FOUND]</span> " . htmlspecialchars($target) . "<br>";
                    $found[] = $target;
                } else {
                    echo "<span style='color:red'>[MISS]</span> " . htmlspecialchars($target) . " <small>(Code: $http_code - Keyword not found)</small><br>";
                }
            } else {
                echo "<span style='color:red'>[MISS]</span> " . htmlspecialchars($target) . " <small>(Code: $http_code)</small><br>";
            }
            
            curl_multi_remove_handle($multi_handle, $ch);
            ob_flush();
            flush();
        }
        curl_multi_close($multi_handle);

    // ===================================================================
    // NORMAL MODE (using file_get_contents for sequential requests)
    // ===================================================================
    } else {
        foreach ($urls as $url_input) {
            $url_input = trim($url_input);
            if (empty($url_input)) continue;

            // For direct scan, use the URL as-is
            if ($scan_type === 'direct') {
                $targets = [$url_input];
            } else {
                // Custom scan - append extension to base URL
                $ext = trim($_POST['ext']);
                $base_url = preg_replace('/\/[^\/]*$/', '', $url_input);
                $targets = [rtrim($base_url, '/') . '/' . $ext];
            }

            foreach ($targets as $target) {
                if (!filter_var($target, FILTER_VALIDATE_URL)) {
                    echo "<span style='color:orange'>[SKIP]</span> Invalid URL: " . htmlspecialchars($target) . "<br>";
                    continue;
                }

                $context = stream_context_create([
                    "ssl" => ["verify_peer" => false, "verify_peer_name" => false],
                    "http" => [
                        "timeout" => 15,
                        "user_agent" => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.88 Safari/537.36'
                    ]
                ]);

                $resp = @file_get_contents($target, false, $context);

                if ($resp) {
                    // Check if keyword is found or if no keyword specified
                    if (empty($keyword) || strpos($resp, $keyword) !== false) {
                        echo "<span style='color:lime'>[FOUND]</span> " . htmlspecialchars($target) . "<br>";
                        $found[] = $target;
                    } else {
                        echo "<span style='color:red'>[MISS]</span> " . htmlspecialchars($target) . " <small>(Keyword not found)</small><br>";
                    }
                } else {
                    echo "<span style='color:red'>[MISS]</span> " . htmlspecialchars($target) . "<br>";
                }
                ob_flush();
                flush();
            }
        }
    }

    // Save found results to a file
    if (!empty($found)) {
        file_put_contents('found.txt', implode(PHP_EOL, $found) . PHP_EOL, FILE_APPEND);
    }
    
    echo "<br><a href='found.txt' target='_blank' style='color: #87cefa;'>Download found.txt</a>";

} else {
// ===================================================================
// HTML FORM INTERFACE
// ===================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mass Checker</title>
   <style>
    @keyframes glow {
        0% { text-shadow: 0 0 5px #ff00ff, 0 0 10px #ff00ff; }
        50% { text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff; }
        100% { text-shadow: 0 0 5px #ff00ff, 0 0 10px #ff00ff; }
    }

    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Courier New', Courier, monospace;
        background-color: #1e1e1e;
        color: #0ff;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }

    h1 {
        margin-top: 40px;
        font-size: 36px;
        color: #ff00ff;
        text-align: center;
        animation: glow 2s infinite;
    }

    .container {
        width: 100%;
        max-width: 800px;
        padding: 20px;
        box-sizing: border-box;
    }

    input, textarea, select {
        width: 100%;
        padding: 10px 5px;
        margin-bottom: 20px;
        background-color: transparent;
        border: none;
        border-bottom: 2px solid #0ff;
        color: #0ff;
        font-size: 16px;
        outline: none;
        transition: 0.3s;
    }

    input:focus, textarea:focus, select:focus {
        border-bottom: 2px solid #ff0;
        color: #ff00ff;
        box-shadow: 0 0 10px #ff00ff;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #ff00ff;
        color: #000;
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
        box-shadow: 0 0 5px #ff00ff;
    }

    button:hover {
        box-shadow: 0 0 15px #ff00ff, 0 0 30px #ff00ff;
    }

    .radio-group {
        margin-bottom: 20px;
        color: #0ff;
    }

    .info-box {
        background-color: #2a2a2a;
        border: 1px solid #ff00ff;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        font-size: 14px;
    }

    .example {
        color: #888;
        font-size: 12px;
        margin-top: -15px;
        margin-bottom: 15px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Mass Checker</h1>
        <form method="post">
            <textarea name="urls" rows="10" cols="60" placeholder="Paste list URLs lengkap dengan nama file..."></textarea>
            <div class="example">Contoh: http://example.com/wp-admin/shell.php</div>
            
            <div class="radio-group">
                <b>Select Scan Type:</b><br>
                <label><input type="radio" name="scan_type" value="direct" checked> Direct URL Scan</label><br>
                <label><input type="radio" name="scan_type" value="custom"> Custom Extension Scan</label><br>
            </div>
            
            <input name="ext" placeholder="Example: shell.php, config.php, .env" size="40"><br>
            <input name="keyword" placeholder="Keyword to search for (leave empty to find all files)" size="40"><br>
            
            <div class="info-box">
                <b>Direct URL Scan:</b> Directly scans full URLs that already contain file names.<br>
                <b>Custom Extension Scan:</b> Add extensions to the base URL.
            </div>
            
            <div class="radio-group">
                <b>Select Scan Mode:</b><br>
                <label><input type="radio" name="mode" value="normal" checked> Normal Mode (Stable, Slower)</label><br>
                <label><input type="radio" name="mode" value="fast"> Fast Mode (Super Fast, requires cURL)</label><br>
            </div><br>
        
            <button type="submit">Scan Now</button>
        </form>
    </div>
</body>
</html>
<?php 
} 
?>
