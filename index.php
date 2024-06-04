<?php
/**
 * Plugin Name:        	BrightLocal - Local Image Proxy
 * Description:         (DISABLE ON THE PRODUCTION SERVER) If there are missing images in your WordPress site, this plugin will redirect them to the live server.
 * Author:              Ash Whiting for BrightLocal
 * Author URI:          https://brightlocal.com
 * Text Domain:         bl-local-rankflux
 * Version:             1.0.0
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * GitHub Plugin URI: 	https://github.com/asha23/wp-local-image-finder
 * Primary Branch: main
 * Release Asset: true
 *
 */

add_action('template_redirect', 'image_proxy_template_redirect', 99);

function image_proxy_template_redirect()
{
    $live_server = 'https://brightlocal.com'; // Replace with your live server URL
    $request_uri = $_SERVER['REQUEST_URI'];
    $uploads_regex = '/^\/wp-content\/uploads\/(\d+)\/(\d+)\/(.*)$/';

    if (preg_match($uploads_regex, $request_uri, $matches)) {
        $local_file_path = ABSPATH . 'wp-content' . $request_uri;

        if (!file_exists($local_file_path)) {

            $image_url = "{$live_server}{$request_uri}";

            wp_redirect($image_url, 301);
            exit;
        }
    }
}