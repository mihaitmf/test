<?php


class MyService
{
    private $instanceField = 'hello';

    /**
     * The three parameters are sent like this and in this order when the xmlrpc_server_call_method function is called.
     *
     * @param $remoteMethodName
     * @param $params
     * @param $userData
     * @return array
     */
    public function sum($remoteMethodName, $params, $userData)
    {
        $sum = 0;
        $nonInts = [];
        foreach ($params as $param) {
            if (is_int($param)) {
                $sum += $param;
            } else {
                $nonInts[] = $param;
            }
        }

        return [
            'sum' => $sum,
            'nonInts' => $nonInts,
            'instanceField' => $this->instanceField,
            'defaultParamRemoteMethodName' => $remoteMethodName,
            'defaultParamUserDate' =>  $userData,
        ];
    }
}
