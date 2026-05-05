<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', function() {
	register_block_pattern_category(
		'foundation-patterns',
		[ 'label' => __( 'Foundation Patterns', 'foundation-wp-theme' ) ]
	);
} );
