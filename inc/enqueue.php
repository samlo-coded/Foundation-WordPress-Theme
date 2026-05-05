<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style(
		'foundation-wp-style',
		FOUNDATION_WP_URI . '/assets/css/main.css',
		[],
		FOUNDATION_WP_VERSION
	);

	wp_enqueue_script(
		'foundation-wp-main',
		FOUNDATION_WP_URI . '/assets/js/main.js',
		[],
		FOUNDATION_WP_VERSION,
		[ 'strategy' => 'defer' ]
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );

add_action( 'enqueue_block_editor_assets', function() {
	wp_enqueue_style(
		'foundation-wp-editor',
		FOUNDATION_WP_URI . '/assets/css/editor.css',
		[],
		FOUNDATION_WP_VERSION
	);
} );
