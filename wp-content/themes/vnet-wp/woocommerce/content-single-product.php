<?php
/**
* The template for displaying product content in the single-product.php template
*
* This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see     https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce/Templates
* @version 3.6.0
*/

defined( 'ABSPATH' ) || exit;

global $product;

$attributes = $product->get_attributes();
$prod_info  = vnet_get_prod_info( $product );

/**
* Hook: woocommerce_before_single_product.
*
* @hooked wc_print_notices - 10
*/
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>


<div class="container-fluid intern single-prod-container">
	<div class="row single-prod-row">
		<div class="col-md-5 thumb">
			<a href="<?= $prod_info['img']; ?>" data-fancybox>
				<img src="<?= $prod_info['img']; ?>" alt="<?= $prod_info['name']; ?>">
			</a>
		</div>
		<div class="col-md-7 content">
			<h2 class="section-title size-xxm"><?= $prod_info['name']; ?></h2>
			<div class="desc">
				<?php

				if ( $prod_info['name'] ) {
					?>
					<div class="dec-row">
						Наименование: <span><?= $prod_info['name']; ?></span>
					</div>
					<?php
				}


				if ( $prod_info['acf_number'] ) {
					?>
					<div class="dec-row">
						Артикул: <span><?= $prod_info['acf_number']; ?></span>
					</div>
					<?php
				}


				if ( $prod_info['code'] ) {
					?>
					<div class="dec-row">
						Код товара: <span><?= $prod_info['code']; ?></span>
					</div>
					<?php
				}

				if ( isset ( $prod_info['in_stock'] ) ) {
					if ( $prod_info['in_stock'] ) {
						?>
						<div class="dec-row">
							На складе: <span><?= $prod_info['stock'] . ' ' . $prod_info['acf_units']; ?></span>
						</div>
						<?php
					} else {
						?>
						<div class="dec-row">
							Нет в наличии
						</div>
						<?php
					}
				}


				if ( $prod_info['acf_min_order'] ) {
					?>
					<div class="dec-row">
						Минимальный заказ: <span><?= $prod_info['acf_min_order'] . ' ' . $prod_info['acf_units']; ?></span>
					</div>
					<?php
				}

				if ( $prod_info['producer'] ) {
					?>
					<div class="dec-row">
						Производитель: <span><?= $prod_info['producer']; ?></span>
					</div>
					<?php
				}

				if ( $prod_info['acf_link_prod'] ) {
					?>
					<div class="dec-row">
						Сайт производителя: <a href="<?= $prod_info['acf_link_prod']; ?>" target="_blank"><span><?= $prod_info['acf_link_prod']; ?></span></a>
					</div>
					<?php
				}
				?>
				<div class="desc-row price-row">
					Цена: <span><?= $prod_info['price']; ?></span>
				</div>
			</div>
			<div class="quantity">
				<div class="input-num update-btn">
					<span class="minus">-</span>
					<input type="number" min="1" class="total-prod" value="1">
					<span class="plus">+</span>
				</div>
				<div class="btn-order">
					<a href="#" class="btn blue leave-request order-single-prod" data-id="<?= $product->get_id(); ?>" data-title="<?= $prod_info['name']; ?>" data-quantity="1">Оставить заявку</a>
				</div>
			</div>
		</div>
	</div>



	<div class="row specifications-container">
		<?php
		if ( isset ( $prod_info['attributes'] ) ) {
			?>
			<div class="col-md-12 specifications-col">
				<div class="specifications-table" id="specificationsTable">
					<table class="table specifications-table">
						<thead>
							<tr>
								<td colspan="2" class="title size-xm">Характеристики товара</td>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ( $prod_info['attributes'] as $attribute ) {
								$title = $attribute['name'];
								$value = $attribute['value'];
								if ( $value ) {
									?>
									<tr>
										<td width="220px"><?= $title; ?></td>
										<td>
											<?= $value; ?>
										</td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
					<?php
				}
				?>
			</div>

		</div>
		<?php

		if ( $prod_info['acf_doc_plat'] || $prod_info['acf_doc_prod'] ) {
			?>

			<div class="col-md-12 specifications-col">
				<table class="table specifications-table">
					<thead>
						<tr>
							<td colspan="2" class="title size-xm">Документация</td>
						</tr>
					</thead>
					<tbody>
						<tbody>
							<?php
							if ( $prod_info['acf_doc_prod'] ) {
								$link = $prod_info['acf_doc_prod'];
								if ( !strpos('http', $link ) ) {
									$link  = PLATAN_URL . $link;
								}
								?>
								<tr>
									<td width="220px">Производитель:</td>
									<td>
										<a href="<?= PLATAN_URL . $prod_info['acf_doc_prod']; ?>" target="_blank">Скачать</a>
									</td>
								</tr>
								<?php
							}

							if ( $prod_info['acf_doc_plat'] ) {
								$link = $prod_info['acf_doc_plat'];
								if ( !strpos('http', $link ) ) {
									$link  = PLATAN_URL . $link;
								}
								?>
								<tr>
									<td width="220px">Платан:</td>
									<td>
										<a href="<?= PLATAN_URL . $prod_info['acf_prod_plat']; ?>" target="_blank">Скачать</a>
									</td>
								</tr>
								<?php
							}
							?>
						</thead>
					</table>
				</div>
				<?php
			}

			?>
		</div>
	</div>
