<?php
/**
 * This file is part of the Toggl package
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @subpackage    Tinyrocket\Toggl\Adapter\AdapterInterface
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Adapter;

/**
 * Tinyrocket\Toggl\Adapter\AdapterInterface
 * 
 * Implementation class for HTTP Adaptber
 *
 * @author Antoine Corcy <contact@sbin.dk>
 */
interface AdapterInterface {

	/**
     * Get Request
     *
     * @param  string                               $url
     * @throws \RuntimeException|ExceptionInterface
     * @return string
     */
    public function get($url);

    /**
     * Delete Request
     *
     * @param  string                               $url
     * @param  array                                $headers (optional)
     * @throws \RuntimeException|ExceptionInterface
     */
    public function delete($url, array $headers = array());

    /**
     * Put Request
     *
     * @param  string                               $url
     * @param  array                                $headers (optional)
     * @param  string                               $content (optional)
     * @throws \RuntimeException|ExceptionInterface
     * @return string
     */
    public function put($url, array $headers = array(), $content = '');

    /**
     * Post Request
     *
     * @param  string                               $url
     * @param  array                                $headers (optional)
     * @param  string                               $content (optional)
     * @throws \RuntimeException|ExceptionInterface
     * @return string
     */
    public function post($url, array $headers = array(), $content = '');
}