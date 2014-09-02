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
 * Show simplified admin surface in iframe
 * 
 * @author Lajos Molnar <lajos.molnar@shardimage.com>
 * @since 1.0
 * 
 * example
 * 
 * $frame->properties = array(
 *      'border' => 0,
 * );
 * $frame = new Web(array('api_key' => $api_key, 'api_secret' => $api_secret));
 * echo $frame->getFrame();
 */
class Web extends ShardImage {

    const URI = '/api-login';
    const KEY = 'web_id';

    /**
     * The frame width in pixels or percentages.
     * @var string
     */
    public $width = '100%';

    /**
     * The frame height in pixels or percentages.
     * @var string
     */
    public $height = '950';

    /**
     * Other frame properties.
     * @var array
     */
    public $properties = [];

    /**
     * The frame content.
     * @var string
     */
    private $_frame = '<iframe {attributes}></iframe>';

    /**
     * 
     * @return string
     */
    public function getFrame() {
        return $this->_render();
    }

    /**
     * 
     * @return string
     */
    private function _render() {
        return strtr($this->_frame, $this->_getAttributes());
    }

    /**
     * Returns the frame properties of an associative array.
     * @return array
     */
    private function _getAttributes() {
        $properties = array(
            'width="' . $this->width . '"',
            'height="' . $this->height . '"',
            'src="' . $this->_createURL(self::URI) . '"',
        );

        foreach ($this->properties as $key => $value) {
            $properties[] = $key . '="' . $value . '"';
        }

        $attributes = array(
            '{attributes}' => implode(' ', $properties),
        );

        return $attributes;
    }

    /**
     * Returns the frame src url.
     * @param string $uri
     * @return string
     */
    private function _createURL($uri) {
        return API::BASE_URL . $uri . '/' . $this->api->api_key;
    }

}
