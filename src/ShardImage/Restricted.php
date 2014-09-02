<?php
/**
 * @link http://shardimage.com/
 * @copyright Copyright (c) 2014 ShardImage
 * @license https://github.com/shardimage/shardimage-php/blob/master/LICENCE.md
 */

namespace ShardImage;

use ShardImage\ShardImage;
use ShardImage\API;

/**
 * Uploading files
 * 
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 * 
 * example
 * $parameters = array(
 *      'restricted' => array(
 *          'cloud_id' => $cloud_id,
 *          'url' => 'https://www.youtube.com/watch?v=vgfLFLRXSdI'
 *      )
 * );
 * $restricted = new New Restricted(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $restricted->store($parameters);
 * $data // return message and data about the saved picture
 */
class Restricted extends ShardImage {

    const URI = '/api-restricted';
    const KEY = 'restricted_id';

    /**
     * Kép feltöltése url-ről.
     * @param array $parameters
     * @return boolean
     */
    public function store($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_POST, $parameters);
    }

}
