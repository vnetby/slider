<?php

if ( is_supplier_cat() ) {

	get_template_part( 'woocommerce/archive-product', 'tag' );

} else {

	the_page_header();


	$object  = get_queried_object();


	?>


	<?php


	if ( $object->parent ) {


		if ( is_cat_suppliers() ) {
			global $wp_query;

			$supplier = $wp_query->supplier;
			$cat_id   = $object->term_taxonomy_id;
			$tag_id   = $supplier->term_taxonomy_id;

			$prod_ids = get_products_supplier_cat( $tag_id, $cat_id );

			if ( $prod_ids ) {
				?>
				<section class="section loop-terms-section light-bg">
					<div class="container-fluid">
						<div class="row terms-row">
							<?php
							foreach ( $prod_ids as $prod_id ) {
								$prod  = get_post( $prod_id );
								$title = vnet_translate_str( $prod->post_title );
								$img   = get_the_post_thumbnail_url( $prod->ID, 'medium' );
								$def_img = false;
								if ( !$img ) {
									$def_img = true;
									$img     = SRC . 'img/red_bg.jpg';
								}
								$link  = get_permalink ( $prod->ID );

								?>
								<div class="col-xl-4 col-lg-6 col-md-6 supplier-prod-col">
									<div class="wrapper direction-hover like-link pointer" data-target=".next-link">
										<?php
										if ( $img ) {
											?>
											<div class="bg-img hover-bg hover-dir-el <?= $def_img ? 'def-img' : ''; ?>">
												<div class="img-lazy-load opacity" data-src="<?= $img; ?>" data-alt="<?= $title; ?>"></div>
											</div>
											<?php
										}
										?>
										<div class="content">
											<h3 class="prod-title"><?= $title; ?></h3>
											<a href="<?= $link; ?>" class="next-link"></a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</section>
				<?php
			} else {
				require ( THEME_PATH . 'woocommerce/not_found.php' );
			}

		} else {


			$suppliers = get_suppliers_by_cat ( $object->term_taxonomy_id );
			if ( $suppliers ) {
				?>
				<section class="section loop-terms-section light-bg">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="suppliers-block">
									<div class="suppliers-loop">
										<?php
										foreach ( $suppliers as &$term ) {
											$id   = $term->term_id;
											$name = $term->name;
											$desc = $term->description;
											$logo = get_supplier_logo( $id );
											$logo = $logo ? $logo['url'] : false;
											$link = vnet_add_to_link( $term->slug );
											$def_img = false;
											$img = get_field ( 'suplier_card_image', 'term_' . $id );
											if ( $img ) {
												$img = wp_get_attachment_image_src( $img, 'medium' );
												if ( $img ) {
													$img = $img[0];
												}
											}
											if ( !$img ) {
												$def_img = true;
												$img = SRC . 'img/red_bg.jpg';
											}

											$prods = get_products_supplier_cat( $term->term_taxonomy_id, $object->term_taxonomy_id );

											if ( $prods ) {
												if ( count ( $prods ) === 1 ) {
													$link = get_permalink( $prods[0] );
												}
											}

											?>
											<div class="suppliers-col">
												<div class="supplier-card direction-hover like-link pointer" data-target=".next-link">
													<div class="supplier-logo">
														<?php
														if ( $logo ) {
															?>
															<div class="img-lazy-load opacity" data-src="<?= $logo; ?>" data-alt="<?= $name ? $name : ''; ?>"></div>
															<?php
														}
														?>
													</div>
													<div class="supplier-content hover-dir-el">
														<?php
														if ( $img ) {
															?>
															<div class="img-bg <?= $def_img ? 'def-img' : ''; ?>">
																<div class="img-lazy-load opacity" data-src="<?= $img; ?>" data-alt="<?= $name; ?>"></div>
															</div>
															<?php
														}
														if ( $name ) {
															?>
															<h4 class="supplier-name"><?= $name; ?></h4>
															<?php
														}

														if ( $desc ) {
															?>
															<div class="supplier-desc"><?= $desc; ?></div>
															<?php
														}
														if ( $link ) {
															?>
															<a href="<?= $link; ?>" class="next-link"></a>
															<?php
														}
														?>
													</div>
												</div>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?php
			} else {
				require ( THEME_PATH . 'woocommerce/not_found.php' );
			}

		}


	} else {

		$cats = get_terms('product_cat', ['hide_empty' => HIDE_EMPTY, 'parent' => $object->term_id]);
		if ( $cats ) {
			?>
			<section class="section loop-terms-section light-bg">
				<div class="container-fluid">
					<div class="row terms-row">
						<?php
						foreach ( $cats as &$cat ) {
							$title   = $cat->name;
							$link    = vnet_add_to_link( $cat->slug );
							$img     = get_wc_term_img_url ( $cat->term_id );
							$def_img = false;
							if ( !$img ) {
								$def_img = true;
								$img     = SRC . 'img/red_bg.jpg';
							}
							?>
							<div class="col-xl-4 col-lg-6 col-md-6 supplier-prod-col">
								<div class="wrapper direction-hover like-link pointer" data-target=".next-link">
									<?php
									if ( $img ) {
										?>
										<div class="bg-img hover-bg hover-dir-el <?= $def_img ? 'def-img' : ''; ?>">
											<img src="<?= $img; ?>" alt="<?= $title; ?>">
										</div>
										<?php
									}
									?>
									<div class="content">
										<h3 class="prod-title"><?= $title; ?></h3>
										<a href="<?= $link; ?>" class="next-link"></a>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</section>
			<?php
		} else {
			require ( THEME_PATH . 'woocommerce/not_found.php' );
		}

	}

}
