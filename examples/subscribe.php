<?php

require_once __DIR__ . "/../vendor/autoload.php";

$client_id = "phpMQTT-subscriber"; // make sure this is unique for connecting to sever - you could use uniqid()

$socket = new \PhpMqqt\Mqtt\Socket\Socket();
$subscribe = new \PhpMqqt\Mqtt\Subscribe\Subscribe($socket, '123456');

$subscribe->subscribeTopics(new \PhpMqqt\Mqtt\Subscribe\Topic('test', 0, function (\PhpMqqt\Mqtt\Subscribe\Topic $topic, string $message) {
    var_dump($topic->name(), $message);
}));

//or
function callback(\PhpMqqt\Mqtt\Subscribe\Topic $topic, string $message)
{
    var_dump($topic->name(), $message);
    return false;//if this any callable function return false, the loop end
}

//almost all methods can be chained.
$subscribe->topic(new \PhpMqqt\Mqtt\Subscribe\Topic('test/test', '0', callback))
    ->topic(new \PhpMqqt\Mqtt\Subscribe\Topic('test/test2', '0', callback));


$subscribe->listen();