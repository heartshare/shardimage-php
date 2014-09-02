<?php

include '../src/ShardImage/API.php';
include '../src/ShardImage/ShardImage.php';
include '../src/ShardImage/Web.php';

use ShardImage\Web;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'index':
        $web = new Web(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $web->properties = [
            'frameborder' => 0,
        ];
        $data = $web->getFrame();
        break;

}
return $data;
