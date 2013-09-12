<?php

require '../vendor/autoload.php';

use mockingjay\Echonest;

// Create a client and pass an array of configuration data
$client = Echonest::factory(array(
    'api_key' => '****',
));

$result = $client->trackUpload(array(
	'url' => 'http://audio-dc6-t3-2.pandora.com/samples/8/2/3/1/028947681328-1-1-30sec-64kbps.mp3',
));

var_dump($result);
