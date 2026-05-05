<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'block_categories_all', function( $categories ) {
	return array_merge(
		[
			[
				'slug'  => 'foundation-blocks',
				'title' => __( 'Foundation Blocks', 'foundation-wp-theme' ),
				'icon'  => null,
			],
		],
		$categories
	);
} );

add_action( 'acf/init', function() {
	if ( ! function_exists( 'acf_register_block_type' ) ) return;

	$blocks = [
		[
			'name'        => 'hero',
			'title'       => __( 'Hero', 'foundation-wp-theme' ),
			'description' => __( 'Full width hero section.', 'foundation-wp-theme' ),
			'keywords'    => [ 'hero', 'banner', 'header' ],
		],
		[
			'name'        => 'work-grid',
			'title'       => __( 'Work Grid', 'foundation-wp-theme' ),
			'description' => __( 'Portfolio project grid with repeater.', 'foundation-wp-theme' ),
			'keywords'    => [ 'work', 'portfolio', 'grid' ],
		],
		[
			'name'        => 'testimonials',
			'title'       => __( 'Testimonials', 'foundation-wp-theme' ),
			'description' => __( 'Client testimonials with repeater.', 'foundation-wp-theme' ),
			'keywords'    => [ 'testimonials', 'reviews', 'clients' ],
		],
		[
			'name'        => 'services',
			'title'       => __( 'Services', 'foundation-wp-theme' ),
			'description' => __( 'Services list with repeater.', 'foundation-wp-theme' ),
			'keywords'    => [ 'services', 'offerings' ],
		],
	];

	foreach ( $blocks as $block ) {
		acf_register_block_type( [
			'name'            => $block['name'],
			'title'           => $block['title'],
			'description'     => $block['description'],
			'keywords'        => $block['keywords'],
			'category'        => 'foundation-blocks',
			'render_template' => FOUNDATION_WP_DIR . '/blocks/' . $block['name'] . '/' . $block['name'] . '.php',
			'enqueue_style'   => FOUNDATION_WP_URI . '/blocks/' . $block['name'] . '/' . $block['name'] . '.css',
			'supports'        => [
				'anchor' => true,
				'jsx'    => true,
				'align'  => false,
			],
		] );
	}
} );
