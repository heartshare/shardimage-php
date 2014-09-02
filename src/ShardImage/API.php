<?php
/**
 * @link http://shardimage.com/
 * @copyright Copyright (c) 2014 ShardImage
 * @license https://github.com/shardimage/shardimage-php/blob/master/LICENCE.md
 */

namespace ShardImage;

include 'lib/cURL.php';

use ShardImage\lib\cURL;

/**
 * Implementation of connection.
 *
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 */
class API {

    const REQUEST_TYPE_GET = 1;
    const REQUEST_TYPE_POST = 2;
    const REQUEST_TYPE_PUT = 3;
    const REQUEST_TYPE_DELETE = 4;
    const REQUEST_TYPE_UPLOAD = 5;

    /**
     * Base url;
     */
    const BASE_URL = 'http://api.shardimage.local';

    /**
     * ping
     */
    const URI_PING = '';

    /**
     * list
     */
    const METHOD_INDEX = '/index';

    /**
     * create
     */
    const METHOD_STORE = '/store';

    /**
     * show
     */
    const METHOD_SHOW = '/show';

    /**
     * update
     */
    const METHOD_UPDATE = '/update';

    /**
     * delete
     */
    const METHOD_DELETE = '/delete';

    public $api_key;
    public $api_secret;

    /**
     * 
     * @param integer $request_type
     * @param string $uri
     * @param array $parameters
     * @param array $options
     * @return boolean|array
     */
    public function call($request_type, $uri, $parameters = array(), $options = array()) {

        $curl = new cURL;
        switch ($request_type) {
            case self::REQUEST_TYPE_GET:
                $curl->get();
                $uri .= '?' . http_build_query($parameters);
                break;
            case self::REQUEST_TYPE_POST:
                $parameters = http_build_query($parameters);
            case self::REQUEST_TYPE_UPLOAD:
                $curl->post($parameters);
                break;
            case self::REQUEST_TYPE_PUT:
                $curl->put(http_build_query($parameters));
                break;
            case self::REQUEST_TYPE_DELETE:
                $curl->delete();
                break;
        }

        $curl->setOpt($options);
        $curl->setOpt(cURL::CONNECTTIMEOUT, 3);
        $curl->setOpt(cURL::TIMEOUT, 60);
        $curl->setOpt(cURL::RETURNTRANSFER, true);
        $curl->setUserPass($this->api_key, $this->api_secret);

        $json = $curl->exec($this->_createURL($uri));
        $result = json_decode($json, true);

        return $result;
    }

    /**
     * 
     * @param string $uri
     * @return string
     */
    private function _createURL($uri) {
        return self::BASE_URL . $uri;
    }

}
