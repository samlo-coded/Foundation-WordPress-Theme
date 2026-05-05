<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$heading    = get_field( 'heading' );
$subheading = get_field( 'subheading' );
$cta_text   = get_field( 'cta_text' );
$cta_url    = get_field( 'cta_url' );

$block_id      = 'block-' . $block['id'];
$block_classes = 'fwp-block-hero';

if ( ! empty( $block['className'] ) ) {
	$block_classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_classes ); ?>">

	<?php if ( $heading ) : ?>
		<h1 class="fwp-block-hero__heading"><?php echo esc_html( $heading ); ?></h1>
	<?php endif; ?>

	<?php if ( $subheading ) : ?>
		<p class="fwp-block-hero__subheading"><?php echo esc_html( $subheading ); ?></p>
	<?php endif; ?>

	<?php if ( $cta_text && $cta_url ) : ?>
		<div class="fwp-block-hero__cta">
			<a href="<?php echo esc_url( $cta_url ); ?>" class="fwp-block-hero__button">
				<?php echo esc_html( $cta_text ); ?>
			</a>
		</div>
	<?php endif; ?>

</section>
