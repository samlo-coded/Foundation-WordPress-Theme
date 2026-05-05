<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$heading      = get_field( 'heading' );
$testimonials = get_field( 'testimonials' );

$block_id      = 'block-' . $block['id'];
$block_classes = 'fwp-block-testimonials';

if ( ! empty( $block['className'] ) ) {
	$block_classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_classes ); ?>">

	<?php if ( $heading ) : ?>
		<h2 class="fwp-block-testimonials__heading"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( $testimonials ) : ?>
		<div class="fwp-block-testimonials__grid">
			<?php foreach ( $testimonials as $item ) : ?>
				<blockquote class="fwp-block-testimonials__item">

					<?php if ( ! empty( $item['quote'] ) ) : ?>
						<p class="fwp-block-testimonials__quote"><?php echo esc_html( $item['quote'] ); ?></p>
					<?php endif; ?>

					<footer class="fwp-block-testimonials__footer">
						<?php if ( ! empty( $item['author'] ) ) : ?>
							<cite class="fwp-block-testimonials__author"><?php echo esc_html( $item['author'] ); ?></cite>
						<?php endif; ?>
						<?php if ( ! empty( $item['role'] ) ) : ?>
							<span class="fwp-block-testimonials__role"><?php echo esc_html( $item['role'] ); ?></span>
						<?php endif; ?>
					</footer>

				</blockquote>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</section>
