<?php
error_reporting(0);
$user='user';// Your Ahangify Username
$pass='pass';// Your Ahangify Passwd
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ahangify.com/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array();
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Referer: https://ahangify.com/login';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$res = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
preg_match('/name="_token" value="([^"]+)"/',$res,$m);
//==============================Login===============================
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ahangify.com/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "_token=$m[1]&url=https%3A%2F%2Fahangify.com%2Flogin&username=$user&password=$pass&remember=1");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array();
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Referer: https://ahangify.com/login';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
var_dump($m);
