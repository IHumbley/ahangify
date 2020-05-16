<?php
error_reporting(0);
header('content-type: application/json');
$q=$_GET['q']; // Search In Ahangify
$id=$_GET['id']; // Music Id
$action=$_GET['a']; // Your Action Mode For exam Newtrack
$u=$_GET['u']; // Music Id
function ahangify($url,$data=[]){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $headers = array();
    $headers[] = 'Host: ahangify.com';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0';
    $headers[] = 'Accept: application/json, text/plain, */*';
    $headers[] = 'Accept-Language: en-US,en;q=0.5';
    $headers[] = 'Referer: https://ahangify.com/';
    $headers[] = 'X-JS-APP-VERSION: 2.9.20';
    $headers[] = 'Te: Trailers';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $result;
}
if(!empty($q)){
    $res=ahangify('https://ahangify.com/app-api/search',[
        'value'=>str_replace(' ','+',$q)
    ]);
    die($res);
}elseif (!empty($id) && $action=='track'){
    $res=ahangify('https://ahangify.com/app-api/tracks/'.$id);
    die($res);
}elseif (!empty($id) && $action=='dtrack'){
    $res=ahangify("https://ahangify.com/app-api/tracks/details",[
        'ids[]'=>$id
    ]);
    die($res);
}elseif (!empty($id) && $action=='artist'){
    $res=ahangify('https://ahangify.com/app-api/artists/'.$id);
    die($res);
}elseif (!empty($id) && $action=='album'){
    $res=ahangify('https://ahangify.com/app-api/albums/'.$id);
    die($res);
}elseif ($action=='newtrack'){
    $res=ahangify('https://ahangify.com/app-api/tracks');
    die($res);
}elseif ($action=='ttopweek'){
    $res=ahangify('https://ahangify.com/app-api/charts/tracks',[
        'week'=>''
    ]);
    die($res);
}elseif ($action=='atopweek'){
    $res=ahangify('https://ahangify.com/app-api/charts/artists',[
        'week'=>''
    ]);
    die($res);
}elseif (!empty($u)){
    preg_match('/^tracks\/([a-z0-9]+)\//',$u,$m);
    $res=ahangify("https://ahangify.com/app-api/tracks/$m[1]/file",[
        'url'=>$u
    ]);
    die($res);
}
