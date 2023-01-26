<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Butchered URL Dropper
 * Plugin URI:        butchered-url-dropper
 * Description:       Dumps butchered, mutilated urls that attempt to load on Wordpress which would then be indexed inside Google Search Console.
 * Version:           1.0.0
 * Author:            WalrusSoup
 * Author URI:        https://jaysonlindsley.dev
 * License:           MIT
 * Text Domain:       butchered-url-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once plugin_dir_path( __FILE__ ) . 'src/UrlVerifier.php';
$urlVerifier = new UrlVerifier();
$urlVerifier->initialize();
