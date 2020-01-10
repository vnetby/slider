<?php
/**
* The Template for displaying all single products
*
* This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see 	    https://docs.woocommerce.com/document/template-structure/
* @package 	WooCommerce/Templates
* @version     1.6.4
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );

global $post;

the_page_header();

$img   = get_the_post_thumbnail_url( $post->ID, 'large' );
$title = vnet_translate_str( $post->post_title );
$desc  = get_field( 'prod_shirt_desc', $post->ID );

$term  = wp_get_post_terms( $post->ID, 'product_tag' );

if ( $term ) {
	$term = $term[0];
}

if ( !$img ) {
	$img = SRC . 'img/noimage.png';
}


$advantages  = get_field_group ( 'prod_advantages', $post->ID );
$application = get_field_group( 'prod_application_area', $post->ID );
$text_info   = get_field_group ( 'prod_text_info', $post->ID );
$tecnical    = get_field_group ( 'tecnical_spcifications', $post->ID );



?>


<div class="prod-info-wrap">

	<div class="container-fluid prod-info-block light-bg">
		<div class="row info-row">
			<div class="col-md-6 img-col" data-aos="fade-right">
				<div class="img-lazy-load opacity" data-src="<?= $img; ?>" data-alt="<?= $title; ?>"></div>
			</div>
			<div class="col-md-6 desc-col" data-aos="fade-left">
				<?php
				if ( $title ) {
					?>
					<h2 class="prod-title"><?= $title; ?></h2>
					<?php
				}
				?>
				<div class="company-row">
					<span><?= vnet_translate('company'); ?>:</span>
					<a href="<?= get_term_link( $term->term_id, 'product_tag' ); ?>"><?= $term->name; ?></a>
				</div>

				<?php
				if ( $desc ){
					?>
					<div class="desc">
						<?= $desc; ?>
					</div>
					<?php
				}
				?>
				<div class="btn-row">
					<a href="#requestModal" class="btn red open-modal-btn"><?= vnet_translate('request_now'); ?></a>
				</div>
			</div>
		</div>

		<?php
		if ( $advantages ) {
			if ( isset ( $advantages['advantages'] ) ) {
				if ( count ( $advantages['advantages'] ) ) {
					$title = isset ( $advantages['title'] ) ? $advantages['title'] : false;
					$advantages = $advantages['advantages'];
					?>
					<div class="row advantages-row">
						<div class="col-md-12 avantages-col">
							<?php
							if ( $title ) {
								?>
								<h3 class="row-title"><?= $title; ?></h3>
								<?php
							}
							?>
							<ul class="advantages-list count-cols-3">
								<?php
								foreach ( $advantages as $adv ) {
									?>
									<li class="advntage-item"><?= $adv['advantage']; ?></li>
									<?php
								}
								?>
							</ul>
						</div>
					</div>
					<?php
				}
			}
		}
		?>
	</div>






	<div class="container-fluid prod-tecnical-block">
		<?php
		if ( $application ) {
			$title = isset ( $application['title'] ) ? $application['title'] : false;
			$desc  = isset ( $application['desc'] ) ? $application['desc']   : false;
			?>
			<div class="row application-row over-hidden">
				<div class="col-md-12 application-col">
					<div class="application-container" data-aos="fade-up">
						<?php
						if ( $title ) {
							?>
							<h3 class="row-title"><?= $title; ?></h3>
							<?php
						}
						if ( $desc ) {
							?>
							<div class="desc">
								<?= $desc; ?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}

		if ( $tecnical ) {
			if ( isset ( $tecnical['specification'] ) ) {
				if ( $tecnical['specification'] ) {
					$title = isset ( $tecnical['title'] ) ? $tecnical['title'] : false;
					?>
					<div class="row tecnical-row">
						<div class="col-md-12 tecnical-col">
							<?php
							if ( $title ) {
								?>
								<h3 class="row-title"><?= $title; ?></h3>
								<?php
							}
							?>
							<div class="tecnical-table" id="tecnicalTable" data-drag="true">
								<?= $tecnical['specification']; ?>
							</div>
							<div class="overflow-arrows slider-nav" data-target="#tecnicalTable" data-step="100">
								<button class="nav-btn prev"></button>
								<span class="div-btns"></span>
								<button class="nav-btn next"></button>
							</div>
						</div>
					</div>
					<?php
				}
			}
		}

		if ( $text_info ) {
			if ( isset ( $text_info['info'] ) ) {
				if ( $text_info['info'] ) {
					?>
					<div class="row text-info-row">
						<div class="col-md-12 text-info-col">
							<?php
							foreach ( $text_info['info'] as &$info ) {
								$title = isset ( $info['title'] ) ? $info['title'] : false;
								$desc  = isset ( $info['desc'] ) ? $info['desc']   : false;
								if ( $title || $desc ) {
									?>
									<div class="text-info-block">
										<?php
										if ( $title ) {
											?>
											<h4 class="text-title"><?= $title; ?></h4>
											<?php
										}

										if ( $desc ) {
											?>
											<div class="text-desc">
												<?= $desc; ?>
											</div>
											<?php
										}
										?>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
					<?php
				}
			}
		}
		?>

	</div>


</div>
<?php

the_page_template();

// the_block('contact_form');


get_footer( 'shop' );
