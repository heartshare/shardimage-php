<?php

include '../src/ShardImage/API.php';
include '../src/ShardImage/ShardImage.php';
include '../src/ShardImage/Restricted.php';

use ShardImage\Restricted;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'store':
        $time = time();
        $restricted = new Restricted(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $parameters = array(
            'restricted' => array(
                'cloud_id' => 2,
                'url' => 'https://www.youtube.com/watch?v=vgfLFLRXSdI'
            )
        );

        $data = $restricted->store($parameters);
        break;
}

return $data;
