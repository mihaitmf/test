<?php
/**
 * Created by PhpStorm.
 * User: mihai
 * Date: 12.09.2016
 * Time: 19:19
 */

$servers = [
    ['host' => 'localhost', 'port' => 11201],
    ['host' => 'localhost', 'port' => 11202],
//    ['host' => 'localhost', 'port' => 11203],
//    ['host' => 'localhost', 'port' => 11204],
];

$memcache = new Memcache();

foreach ($servers as $server) {
    $memcache->addServer($server['host'], $server['port']);
}

echo PHP_EOL . "Flushed memcache" . PHP_EOL . PHP_EOL;
$memcache->flush();

/**
 * Add a new id every time in the name of the key because otherwise memcache adds the keys with the same name
 * to the same server from the previous run.
 * For example if mykey3 was on server memcached1 and mykey7 was on server memcached2, even if we restart the
 * memcached containers, the next time we add the same key names they will be distributed to the same memcached server.
 */
$id = rand(0, 100);

for ($i = 1; $i <= 10; $i++) {
    sleep(rand(0, 1));

    $key = "mykey_{$i}_{$id}";
    $value = "cocos{$i}";

    $memcache->add($key, $value);

    $readValue = $memcache->get($key);
    echo "Added \"{$key} => {$readValue}\" to memcache" . PHP_EOL;
}

foreach ($servers as $server) {
    $serverStatus = $memcache->getServerStatus($server['host'], $server['port']);

    $message = "Server {$server['host']}:{$server['port']} is ";
    if ($serverStatus != 0) {
        $message .= 'UP';
    } else {
        $message .= 'DOWN';
    }

    echo PHP_EOL . $message . PHP_EOL;
}

echo PHP_EOL . "Equivalent of running the memcache command \"stats items\"" . PHP_EOL;
print_r($memcache->getExtendedStats('items'));

echo PHP_EOL . "Equivalent of running the memcache command \"stats cachedump 1 10\"" . PHP_EOL;
print_r($memcache->getExtendedStats('cachedump', 1, 10));

