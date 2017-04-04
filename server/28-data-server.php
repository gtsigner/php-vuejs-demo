<?php
/**
 * Email:zhaojunlike@gmail.com
 * Date: 2017/2/5
 * Time: 20:07
 */
require 'HttpHelper.class.php';
header("Content-Type:application/json; charset=utf-8");

$name = @$_GET['name'];
$arr = array(
    'type' => 'json',
    'name' => $name,
    'token' => 'xggd'
);
$http_header = array(
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36',
    'Upgrade-Insecure-Requests' => '1',
    'Host' => 'api.dabai28.com',
);
$data = HttpHelper::http("http://api.dabai28.com/api28.php", $arr, "GET", $http_header);

$data = strval($data);
$data = str_replace("﻿<pre style=\"font-size:13px;\">", "", $data);
$data = str_replace("</pre>", "", $data);
$data = str_replace("}{", "},{", $data);
$data = str_replace("},]", "}]", $data);
$data = preg_replace("/[\n\t\r ]/", "", $data);

$data = "[{$data}]";
$data = json_decode($data, true);

if (!$data) {
    $json['code'] = 204;
} else {
    $json['code'] = 200;
}
$json['data'] = $data;
echo(json_encode($json));
exit();
