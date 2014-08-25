<?php

namespace Sample;

include '../src/shardimage-php/API.php';
include '../src/shardimage-php/ShardImage.php';
include '../src/shardimage-php/Upload.php';

use ShardImage\Upload;

$upload = new Upload($api_key, $api_secret);
$_FILES['image'] = [
    'tmp_name' => 'demo.jpg',
    'type' => 'image/jpg',
    'name' => 'demo.jpg',
];

$data = $upload->upload($_FILES['image'], 2);

return $data;
