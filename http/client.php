<?php

function getArrayRequestParams()
{
    return [
        'name' => 'cocos',
        'age' => 123,
        'key' => 'value'
    ];
}

function getRandomString()
{
    return 'mystring' . rand(0, 1000);
}

function getUrlEncodedStringWithRequestParams()
{
    $params = getArrayRequestParams() + ['my_new_key' => 'blabla'];
    return http_build_query($params);
}

function getJsonRequest()
{
    return '{"name": "cocos", "age": 123}';
}



//$httpMethod = 'POST';
$httpMethod = 'PUT';

$headers = [];
//$headers = ['Content-Type: multipart/form-data'];
//$headers = ['Content-Type: application/json'];

$requestBody = '';

// By default php curl sets the HTTP header Content-Type: application/x-www-form-urlencoded when a string is given to CURLOPT_POSTFIELDS
$requestBody = getUrlEncodedStringWithRequestParams();
//$requestBody = getRandomString();

// By default php curl sets the HTTP header Content-Type: multipart/form-data when an array is given to CURLOPT_POSTFIELDS
//$requestBody = getArrayRequestParams();

//$requestBody = getJsonRequest();



//define('SERVER_URL', 'http://test.dev/http/endpoint.php');
define('SERVER_URL', 'http://localhost:8000/ipn');

$handler = curl_init();
curl_setopt($handler, CURLOPT_URL, SERVER_URL);
curl_setopt($handler, CURLOPT_CUSTOMREQUEST, $httpMethod);
curl_setopt($handler, CURLOPT_POSTFIELDS, $requestBody);
curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handler, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($handler);
$errno = curl_errno($handler);
$errmsg = curl_error($handler);

var_dump($result, $errno, $errmsg);

