<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'after_setup_theme', function() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	remove_theme_support( 'core-block-patterns' );

	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'foundation-wp-theme' ),
		'footer'  => __( 'Footer Menu', 'foundation-wp-theme' ),
	] );

	add_image_size( 'fwp-thumb', 800, 600, true );
	add_image_size( 'fwp-hero', 1600, 900, true );

	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
} );

wp_admin_css_color(
	'foundation-wp',
	__( 'Foundation WP', 'foundation-wp-theme' ),
	FOUNDATION_WP_URI . '/assets/css/admin-colors.css',
	[ '#0a0a0a', '#2563eb', '#64748b', '#f59e0b' ]
);

add_action( 'user_register', function( $user_id ) {
	update_user_meta( $user_id, 'admin_color', 'foundation-wp' );
} );

add_action( 'admin_init', function() {
	$user = wp_get_current_user();
	if ( $user->ID && ! get_user_meta( $user->ID, 'admin_color', true ) ) {
		update_user_meta( $user->ID, 'admin_color', 'foundation-wp' );
	}
} );
