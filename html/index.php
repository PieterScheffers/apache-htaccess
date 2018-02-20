<?php

header("Content-Type: text/plain");

$info = [];
$miss = [];

foreach($_SERVER as $key => $value)
{
    if (substr($key, 0, 5) == 'INFO_') {

        $newKey = substr($key, 5);

        if (!empty($value) && $value != '(null)') {
            $info[$newKey] = $value;
        }  else {
            $miss[$newKey] = $value;
        }
    }
}

ksort($info);
ksort($miss);
ksort($_SERVER);
 
echo "\nReceived These Variables:\n";
print_r($info);
 
echo "\nMissed These Variables:\n";
print_r($miss);
 
echo "\nALL Variables:\n";
print_r($_SERVER);

echo "\nAll headers:\n";
print_r(getallheaders());
