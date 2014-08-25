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

include 'lib/cURL.php';

use ShardImage\lib\cURL;

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

    public function __construct($api_key, $api_secret) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }

    /**
     * 
     * @param integer $request_type
     * @param string $uri
     * @param array $parameters
     * @param array $options
     * @return boolean|array
     */
    public function call($request_type, $uri, $parameters = [], $options = []) {

        $curl = new cURL;
        switch ($request_type) {
            case self::REQUEST_TYPE_GET:
                $curl->setOpt(cURL::GET, false);
                break;
            case self::REQUEST_TYPE_POST:
                $curl->setOpt(cURL::POST, true);
                $curl->setOpt(cURL::POSTFIELDS, http_build_query($parameters));
                break;
            case self::REQUEST_TYPE_PUT:
                $curl->setOpt(cURL::CUSTOMREQUEST, cURL::CUSTOMREQUEST_PUT);
                $curl->setOpt(cURL::POSTFIELDS, http_build_query($parameters));
                break;
            case self::REQUEST_TYPE_DELETE:
                $curl->setOpt(cURL::CUSTOMREQUEST, cURL::CUSTOMREQUEST_DELETE);
                break;
            case self::REQUEST_TYPE_UPLOAD:
                $curl->setOpt(cURL::POST, true);
                $curl->setOpt(cURL::POSTFIELDS, $parameters);
                break;
        }

        foreach ($options as $key => $value) {
            $curl->setOpt($key, $value);
        }

        $curl->setOpt(cURL::CONNECTTIMEOUT, 3);
        $curl->setOpt(cURL::TIMEOUT, 60);
        $curl->setOpt(cURL::RETURNTRANSFER, true);
        $curl->setOpt(cURL::USERPWD, $this->api_key . ':' . $this->api_secret);

        $json = $curl->exec($this->_createURL($uri));
//        file_put_contents('/work/log/api.log', $json . "\n\n\n\n\n\n\n\n\n\n\n\n", FILE_APPEND);
//        echo $json;exit;
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
