<?php

/*
 * This file is part of the ShardImage API.
 *
 * (c) Lajos Molnar <lajos.molnar@shardimage.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ShardImage;

use ShardImage\ShardImage;
use ShardImage\API;

/**
 * Uploading files
 * 
 * example:
 * $parameters = [
 *      'restricted' => [
 *          'cloud_id' => $cloud_id,
 *          'url' => 'https://www.youtube.com/watch?v=vgfLFLRXSdI'
 *      ]
 * ];
 * $restricted = new New Restricted($api_key, $api_secret);
 * $data = $restricted->store($parameters);
 * $data // return message and data about the saved picture
 */
class Restricted extends ShardImage {

    const URI = '/api-restricted';

    /**
     * Kép feltöltése url-ről.
     * @param array $parameters
     * @return boolean
     */
    public function store($parameters) {
        $options = [];

        $result = $this->api->call(API::REQUEST_TYPE_POST, self::URI, $parameters, $options);
        return $result;
    }

}
