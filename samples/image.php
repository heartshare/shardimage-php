<?php

include '../src/ShardImage/API.php';
include '../src/ShardImage/ShardImage.php';
include '../src/ShardImage/Upload.php';
include '../src/ShardImage/Image.php';

use ShardImage\Image;
use ShardImage\Upload;

$action = empty($_GET['action']) ? 'index' : $_GET['action'];

$data = '';
switch ($action) {
    default:
    case 'index':
        $parameters = array(
            'take' => 5,
            'skip' => 1
        );
        $image = new Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $image->index($parameters);
        break;
    case 'upload':
        $upload = new Upload(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $parameters = array(
            'file' => $_FILES['image'] = array(
                'tmp_name' => 'demo.jpg',
                'type' => 'image/jpg',
                'name' => 'demo.jpg',
            ),
            'parameters' => array(
                'cloud_id' => 2
            ),
        );
        ;
        $data = $upload->upload($parameters);
        break;
    case 'show':
        $parameters = array(
            'image_id' => '102255d0d1aafe12c7dda03737b9d8d4',
        );
        $image = new Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $image->show($parameters);
        break;
    case 'delete':
        $parameters = array(
            'image_id' => 17
            );
        $image = new Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
        $data = $image->delete($parameters);
        break;
}

return $data;
