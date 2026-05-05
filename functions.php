<?php
/**
 * Foundation WP base functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'FOUNDATION_WP_VERSION', '1.0.0' );
define( 'FOUNDATION_WP_DIR', get_template_directory() );
define( 'FOUNDATION_WP_URI', get_template_directory_uri() );

require_once FOUNDATION_WP_DIR . '/inc/setup.php';
require_once FOUNDATION_WP_DIR . '/inc/enqueue.php';
require_once FOUNDATION_WP_DIR . '/inc/blocks.php';
require_once FOUNDATION_WP_DIR . '/inc/patterns.php';