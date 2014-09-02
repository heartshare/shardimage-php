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
 * Manage images .
 * 
 * Listing images
 * Show image details
 * Delete image
 * 
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 * 
 * examples
 * 
 * Listing images:
 * 
 * $parameters = array(
 *      'take' => $take, // Number of  retrieved images (maximum 500 image can be retrieved)
 *      'skip' => $skip, // We give back images from this picture at the image list
 * );
 * 
 * $image = new Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $image->index($parameters);
 * $data // Details of stored images.
 * 
 * Show image details:
 * 
 * $parameters array(
 *      'image_id' => $image_id, // the image (md5) _id unique identification
 * );
 * 
 * $image = new Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $image->show($parameters);
 * $data // the image detailed details, or error message. 
 * 
 * Delete image:
 * 
 * $parameters = array(
 *      'image_id' => $image_id, // the image (md5) _id unique identification
 * );
 * 
 * $image = new Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * $data = $image->delete($parameters);
 * $data // response message of deleted status. 
 */
class Image extends ShardImage {

    const URI = '/api-image';
    const KEY = 'image_id';

    /**
     * List images.
     * @param array $parameters
     * @return boolean|array
     */
    public function index($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_GET, $parameters);
    }

    /**
     * Show image.
     * @param array $parameters
     * @return boolean|array
     */
    public function show($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_GET, $parameters);
    }

    /**
     * Delete image.
     * @param array $parameters
     * @return boolean|array
     */
    public function delete($parameters) {

        return $this->apiCall(API::REQUEST_TYPE_DELETE, $parameters);
        ;
    }

}
