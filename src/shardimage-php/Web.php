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

/**
 * Show simplified admin surface in iframe
 * 
 * example:
 * 
 * $frame->properties = [
 *      'border' => 0,
 * ];
 * $frame = new Web($api_key, $api_secret);
 * echo $frame->getFrame();
 */
class Web extends ShardImage {

    const URI = '/api-login';

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
        $properties = [
            'width="' . $this->width . '"',
            'height="' . $this->height . '"',
            'src="' . $this->_createURL(self::URI) . '"',
        ];

        foreach ($this->properties as $key => $value) {
            $properties[] = $key . '="' . $value . '"';
        }

        $attributes = [
            '{attributes}' => implode(' ', $properties),
        ];

        return $attributes;
    }

    /**
     * Returns the frame src url.
     * @param string $uri
     * @return string
     */
    private function _createURL($uri) {
        return API::BASE_URL . $uri . '/' . $this->api_key;
    }

}
