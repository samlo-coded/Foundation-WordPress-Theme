<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$heading  = get_field( 'heading' );
$services = get_field( 'services' );

$block_id      = 'block-' . $block['id'];
$block_classes = 'fwp-block-services';

if ( ! empty( $block['className'] ) ) {
	$block_classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_classes ); ?>">

	<?php if ( $heading ) : ?>
		<h2 class="fwp-block-services__heading"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( $services ) : ?>
		<ul class="fwp-block-services__list">
			<?php foreach ( $services as $service ) : ?>
				<li class="fwp-block-services__item">

					<?php if ( ! empty( $service['icon'] ) ) : ?>
						<div class="fwp-block-services__icon" aria-hidden="true">
							<?php echo wp_get_attachment_image( $service['icon']['ID'], [ 48, 48 ] ); ?>
						</div>
					<?php endif; ?>

					<div class="fwp-block-services__content">
						<?php if ( ! empty( $service['title'] ) ) : ?>
							<h3 class="fwp-block-services__title"><?php echo esc_html( $service['title'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $service['description'] ) ) : ?>
							<p class="fwp-block-services__description"><?php echo esc_html( $service['description'] ); ?></p>
						<?php endif; ?>
					</div>

				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

</section>
