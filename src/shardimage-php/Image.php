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
 * Képek kezelésének megvalósítása.
 */
class Image extends ShardImage {

    const URI = '/image';

    /**
     * List images.
     * @param array $parameters
     * @return boolean|array
     */
    public function index($parameters) {
        $options = [];

        $result = $this->api->call(API::REQUEST_TYPE_GET, self::URI, $parameters, $options);
        return $result;
    }

    /**
     * Save new image.
     * @param array $parameters
     * @return boolean|array
     */
    public function store($parameters) {
        $options = [];

        $result = $this->api->call(API::REQUEST_TYPE_POST, self::URI, $parameters, $options);
        return $result;
    }

    /**
     * Show image.
     * @param array $parameters
     * @return boolean|array
     */
    public function show($parameters) {
        $options = [];

        $result = $this->api->call(API::REQUEST_TYPE_GET, self::URI, $parameters, $options);
        return $result;
    }

    /**
     * Update image.
     * @param array $parameters
     * @return boolean|array
     */
    public function update($parameters) {
        $options = [];

        $result = $this->api->call(API::REQUEST_TYPE_PUT, self::URI, $parameters, $options);
        return $result;
    }

    /**
     * Delete image.
     * @param array $parameters
     * @return boolean|array
     */
    public function delete($parameters) {
        $options = [
            CURLOPT_CUSTOMREQUEST => \ShardImage\lib\cURL::CUSTOMREQUEST_DELETE,
        ];

        $result = $this->api->call(API::REQUEST_TYPE_GET, self::URI, $parameters, $options);
        return $result;
    }

}
