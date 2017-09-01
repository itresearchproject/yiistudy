#!/usr/bin/env php
<?php
if(!extension_loaded("openssl")) {
    exit('没有开启openssl 扩展');
}
$params = getparams();
$root = str_replace('\\', '/', __DIR__);
$envs = require("$root/environments/index.php");
$envNames = array_keys($envs);

$envName = null;

if(empty($params['argv'])) {

}

function getparams() {
    $_SERVER['argv'] = [1,2,3];
    $rawParams = [];
    if(isset($_SERVER['argv'])) {
        $rawParams = $_SERVER['argv'];
        array_shift($rawParams);
    }

    $params = [];
    foreach ($rawParams as $param) {
        if (preg_match('/^--(\w+)(=(.*))?$/', $param, $matches)) {
            $name = $matches[1];
            $params[$name] = isset($matches[3]) ? $matches[3] : true;
        } else {
            $params[] = $param;
        }
    }
    return $params;
}
