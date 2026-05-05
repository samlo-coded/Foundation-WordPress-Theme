<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$heading  = get_field( 'heading' );
$projects = get_field( 'projects' );

$block_id      = 'block-' . $block['id'];
$block_classes = 'fwp-block-work-grid';

if ( ! empty( $block['className'] ) ) {
	$block_classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$block_classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_classes ); ?>">

	<?php if ( $heading ) : ?>
		<h2 class="fwp-block-work-grid__heading"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( $projects ) : ?>
		<div class="fwp-block-work-grid__grid">
			<?php foreach ( $projects as $project ) : ?>
				<article class="fwp-block-work-grid__item">

					<?php if ( ! empty( $project['image'] ) ) : ?>
						<div class="fwp-block-work-grid__image">
							<?php echo wp_get_attachment_image( $project['image']['ID'], 'fwp-thumb', false, [ 'loading' => 'lazy' ] ); ?>
						</div>
					<?php endif; ?>

					<div class="fwp-block-work-grid__content">
						<?php if ( ! empty( $project['title'] ) ) : ?>
							<h3 class="fwp-block-work-grid__title">
								<?php if ( ! empty( $project['url'] ) ) : ?>
									<a href="<?php echo esc_url( $project['url'] ); ?>"><?php echo esc_html( $project['title'] ); ?></a>
								<?php else : ?>
									<?php echo esc_html( $project['title'] ); ?>
								<?php endif; ?>
							</h3>
						<?php endif; ?>

						<?php if ( ! empty( $project['description'] ) ) : ?>
							<p class="fwp-block-work-grid__description"><?php echo esc_html( $project['description'] ); ?></p>
						<?php endif; ?>
					</div>

				</article>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</section>
