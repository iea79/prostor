<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

if ($product->is_type("variable")) {
    $variations = $product->get_available_variations();
    $variationsId = wp_list_pluck($variations, "variation_id");

    if (count($variationsId) > 0) {
        ?>
        <div class="product-sample__container">
            <a href="?add-to-cart=<?=$product->get_id();?>&variation_id=<?=$variationsId[1];?>"
               data-quantity="1"
               class="button product_type_simple add_to_cart_button ajax_add_to_cart"
               rel="nofollow"?>
                Add sample to cart
            </a>
        </div>
        <?php
    }
}
?>
<style>
    .single-product div.product table.variations {
        display: none;
    }
    .related.products {
        display: none;
    }
    .woocommerce-variation-price {
        display: none;
    }
</style>
<div class="product_meta">

    <?php do_action( 'woocommerce_product_meta_start' ); ?>

    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <span class="sku_wrapper"><label><?php esc_html_e( 'SKU:', 'woocommerce' ); ?></label> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

    <?php endif; ?>

    <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
