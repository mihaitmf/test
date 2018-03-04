<?php

require_once 'MyService.php';

$xmlBodyOfHttpRequest = file_get_contents('php://input');

$xmlRpcServer = xmlrpc_server_create();

$remoteMethodName = 'myRemoteMethodName';
$internalServiceInstance = new MyService();
$callableForInternalMethod = [$internalServiceInstance, 'sum'];

xmlrpc_server_register_method($xmlRpcServer, $remoteMethodName, $callableForInternalMethod);

$internalServiceResponseAsXml = xmlrpc_server_call_method($xmlRpcServer, $xmlBodyOfHttpRequest, ['myUserData' => 'dummy data', 55]);

header('Content-Type: text/xml');
echo $internalServiceResponseAsXml;

xmlrpc_server_destroy($xmlRpcServer);
