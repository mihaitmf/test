<?php
/**
 * Created by PhpStorm.
 * User: mihai
 * Date: 13.09.2016
 * Time: 10:55
 */

$servers = [
    ['host' => 'localhost', 'port' => 11201],
    ['host' => 'localhost', 'port' => 11202],
    ['host' => 'localhost', 'port' => 11203],
    ['host' => 'localhost', 'port' => 11204],
];

$memcache = new Memcache();

foreach ($servers as $server) {
    $memcache->addServer($server['host'], $server['port']);
}

for ($i = 1; $i <= 10; $i++) {
    $readValue = $memcache->get("mykey_{$i}_97");
    echo $readValue . PHP_EOL;
}
