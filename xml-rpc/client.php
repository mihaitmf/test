<?php

$remoteMethodName = 'myRemoteMethodName';
$remoteMethodArguments = [123, 77, 'cocos', ['key' => 'val'], 3];

$xmlRequest = xmlrpc_encode_request($remoteMethodName, $remoteMethodArguments);

$url = 'http://test.dev/xml-rpc/server.php';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$xmlResponse = curl_exec($ch);

$responseDecoded = xmlrpc_decode($xmlResponse);

var_dump($responseDecoded);
var_dump($xmlResponse);
