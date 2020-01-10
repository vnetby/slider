<?php
/**
* The template for displaying product content within loops
*
* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

$name  = $product->get_name();
$id    = $product->get_id();
$link  = get_permalink( $id );
$img   = vnet_get_prod_img( $id );
$price = $product->get_price(  );

$price = $price ? $price . ' ' . wc_get_currency_symbol() : 'договорная';

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-xs-12 prod-loop-card has-bookmark" data-id="<?= $id; ?>">
	<div class="">
		<div class="thumb">
			<img src="<?= $img; ?>" alt="<?= $name; ?>">
			<a href="#" class="add-markbook" title="добавить в закладки" data-id="<?= $id; ?>"></a>
			<a href="<?= get_bookmarks_page(); ?>" class="in-bookmark-ico open-bookmarks" title="товар в закладках" data-id="<?= $id; ?>"></a>
		</div>
		<h3 class="title size-xs"><?= $name; ?></h3>
	</div>
	<div class="">
		<div class="price-row">
			Цена: <span><?= $price; ?></span>
		</div>
		<div class="btn-col">
			<a href="<?= $link; ?>" class="btn light">Подробнее</a>
			<a href="#" class="btn blue leave-request order-single-prod" data-id="<?= $id; ?>" data-title="<?= $name; ?>" data-quantity="1" data-link="<?= urlencode( $link ); ?>">Оставить заявку</a>
		</div>
	</div>
</div>
