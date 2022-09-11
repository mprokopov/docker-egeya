<?php
function o2 () { static $pw; if(empty($pw))$pw = md5 ('seсret'); return $pw; }

function encode ($x){$rm = o2 (); $cu = strlen ($rm); $vu = strlen ($x); $d = ''; for ($r = 0; $r < $vu + rand (16,64); ++ $r){ if ($r > $vu){ $bu = rand (0,127); } elseif ($r == $vu){ $bu = 0; } else { $bu = ord ($x[$r]); } $yu = chr (($bu + ord ($rm[$r%$cu])) % 256); $d .= $yu; } $d = base64_encode ($d); return $d;}

function decode ($x){ $rm = o2 (); $cu = strlen ($rm); $x = base64_decode ($x); $vu = strlen ($x); $d = ''; for ($r = 0; $r < $vu; ++ $r){ $nu = (ord ($x[$r]) + 256 - ord ($rm[$r%$cu])) % 256; if ($nu === 0) break; $d .= chr ($nu); } return $d; }

$connection = getenv('DATABASE_URL');

$url = parse_url($connection);

$config = unserialize(file_get_contents($argv[1]));

$config['db']['server']    = $url['host'];
$config['db']['user_name'] = $url['user'];
$config['db']['passw']     = encode($url['pass']);
$config['db']['name']      = trim($url['path'],'/');

print(serialize($config));
