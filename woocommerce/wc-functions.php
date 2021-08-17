<?php
// Корзина в шапке
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');
function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="cart__counter"></span>
    <?php
    $fragments['.cart__counter'] = ob_get_clean();
    return $fragments;
}


function woocommerce_breadcrumb( $args = array() ) {
	$args = wp_parse_args(
		$args,
		apply_filters(
			'woocommerce_breadcrumb_defaults',
			array(
				'delimiter'   => '',
				'wrap_before' => '<nav class="breadcrumb">',
				'wrap_after'  => '</nav>',
				'before'      => '<li>',
				'after'       => '</li>',
				'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
			)
		)
	);

	$breadcrumbs = new WC_Breadcrumb();

	if ( ! empty( $args['home'] ) ) {
		$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
	}

	$args['breadcrumb'] = $breadcrumbs->generate();

	/**
	 * WooCommerce Breadcrumb hook
	 *
	 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
	 */
	do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

	wc_get_template( 'global/breadcrumb.php', $args );
}

function frontendie_template_single_excerpt_cats() {
	global $post;
    if ( has_term( 'zapchasti', 'product_cat' ) ) {
        $cat = get_the_terms( $post->ID, 'product_cat' );
        $thumb = get_term_meta( $cat[0]->term_id, 'thumbnail_id', true );
        // var_dump($cat);
        // echo get_category_link($cat[0]->term_id);
        ?>
        <div class="productCat">
            <?php
            echo wp_get_attachment_image($thumb, 'full');
            ?>
            <a href="<?php echo get_category_link($cat[0]->term_id); ?>">Все запчасти <?php echo$cat[0]->name ?></a>
        </div>
        <?php
    }
}

function frontendie_template_single_atention_price() {
    if ( !has_term( 'zapchasti', 'product_cat' ) ) {
        ?>
        <p class="price-attention">Точная стоимость обсуждается по телефону</p>
        <?php
    }
}


/**
 * Override loop template and show quantities next to add to cart buttons
 */
add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );
function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cartForm" method="post" enctype="multipart/form-data">';
        if ( has_term( 'zapchasti', 'product_cat' ) ) {
            $html .= woocommerce_quantity_input( array(), $product, false );
        }
        if (WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) )) {
            $html .= '<button type="submit" class="btn btn_border_primary alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
        } else {
            $html .= '<button type="submit" class="btn btn_primary alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
        }
		$html .= '</form>';
	}
	return $html;
}

// меняем текст кнопки для страницы самого товара
add_filter( 'woocommerce_product_single_add_to_cart_text', 'frontendie_single_product_btn_text' );

function frontendie_single_product_btn_text( $text ) {

    if( WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( get_the_ID() ) ) ) {
		$text = 'В корзине';
	} else {
        if ( has_term( 'zapchasti', 'product_cat' ) ) {
            $text = 'Купить';
        } else {
            $text = 'Заказать';
        }
    }

	return $text;

}

// меняем текст кнопки для страниц каталога товаров, категорий товаров и т д
add_filter( 'woocommerce_product_add_to_cart_text', 'frontendie_product_btn_text', 20, 2 );

function frontendie_product_btn_text( $text, $product ) {

	if(
	   $product->is_type( 'simple' )
	   && $product->is_purchasable()
	   && $product->is_in_stock()
	) {

        if (WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) )) {
            $text = 'В корзине';
        } else {
            if ( has_term( 'zapchasti', 'product_cat' ) ) {
                $text = 'Купить';
            } else {
                $text = 'Заказать';
            }
        }


	}

	return $text;

}


/**
* Сорьтировка вукоммерс
*/

add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => __( 'по умолчанию', 'woocommerce' ),
		'price'      => __( 'по цене', 'woocommerce' ),
		'price-desc' => __( 'по цене', 'woocommerce' ),
        'popularity' => __( 'по популярности', 'woocommerce' ),
        // 'rating'     => __( 'Sort by average rating', 'woocommerce' ),
        'date'       => __( 'новинки', 'woocommerce' ),
    );

    return $sorting_options;
}

/**
 * Change number of related products output
 */
function woo_related_products_limit() {
	global $product;
	$args['posts_per_page'] = 6;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'frontendie_related_products_args', 65 );
  function frontendie_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

add_filter( 'woocommerce_product_tabs', 'frontendie_woo_remove_reviews_tab', 98);
function frontendie_woo_remove_reviews_tab($tabs) {
	unset($tabs['reviews']);
	unset( $tabs['description'] );
	return $tabs;
}

/**
 * Hook: woocommerce_single_product_summary.
 *
 * @hooked woocommerce_template_4single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

add_action('woocommerce_single_product_summary', 'frontendie_template_single_atention_price', 15);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 45);

add_action('woocommerce_single_product_summary', 'frontendie_template_single_excerpt_cats', 55);

/**
 * Update price in cart after change quantity
 */
add_action('woocommerce_before_calculate_totals', 'change_cart_item_quantities', 20, 1 );
function change_cart_item_quantities ( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    // HERE below define your specific products IDs
    $specific_ids = array(37, 51);
    $new_qty = 1; // New quantity

    // Checking cart items
    foreach( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product_id = $cart_item['data']->get_id();
        // Check for specific product IDs and change quantity
        if( in_array( $product_id, $specific_ids ) && $cart_item['quantity'] != $new_qty ){
            $cart->set_quantity( $cart_item_key, $new_qty ); // Change quantity
        }
    }
}

/* Изменяет символ валюты на буквы */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'RUB': $currency_symbol = 'руб.'; break;
     }
     return $currency_symbol;
}

/**
 * Checkout form
 **/
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20 );

// remove the action
// remove_action( 'woocommerce_checkout_shipping', 'evolve_woocommerce_checkout_shipping', 20 );

/**
 * Remove all possible fields
 **/
add_filter( 'woocommerce_checkout_fields', 'frontendie_remove_checkout_fields' );
function frontendie_remove_checkout_fields( $fields ) {

    // Billing fields
    unset( $fields['billing']['billing_company'] );
    // unset( $fields['billing']['billing_email'] );
    // unset( $fields['billing']['billing_phone'] );
    unset( $fields['billing']['billing_state'] );
    // unset( $fields['billing']['billing_first_name'] );
    unset( $fields['billing']['billing_last_name'] );
    unset( $fields['billing']['billing_country'] );
    unset( $fields['billing']['billing_address_1'] );
    unset( $fields['billing']['billing_address_2'] );
    unset( $fields['billing']['billing_city'] );
    unset( $fields['billing']['billing_postcode'] );

    // Shipping fields
    unset( $fields['shipping']['shipping_country'] );
    unset( $fields['shipping']['shipping_company'] );
    unset( $fields['shipping']['shipping_phone'] );
    unset( $fields['shipping']['shipping_state'] );
    unset( $fields['shipping']['shipping_first_name'] );
    unset( $fields['shipping']['shipping_last_name'] );
    // unset( $fields['shipping']['shipping_address_1'] );
    unset( $fields['shipping']['shipping_address_2'] );
    unset( $fields['shipping']['shipping_city'] );
    unset( $fields['shipping']['shipping_postcode'] );

    // Order fields
    // unset( $fields['order']['order_comments'] );

    return $fields;
}


add_filter( 'woocommerce_checkout_fields' , 'frontendie_rename_checkout_fields' );
// Change placeholder and label text
function frontendie_rename_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = 'ФИО';
    $fields['billing']['billing_first_name']['label'] = 'ФИО';

    $fields['billing']['billing_phone']['placeholder'] = '+7(987) 654-32-10';

    $fields['billing']['billing_email']['placeholder'] = 'mail@yandex.ru';
    $fields['billing']['billing_email']['label'] = 'Электронная почта';

    $fields['shipping']['shipping_address_1']['placeholder'] = '8 линия В.О., 54, 12';
    $fields['shipping']['shipping_address_1']['label'] = 'Адрес доставки';

    $fields['order']['order_comments']['required'] = false;
    $fields['order']['order_comments']['placeholder'] = 'позвоните перед оформлением заказа';
    $fields['order']['order_comments']['label'] = 'Комментарий';

    return $fields;
}

// add_filter( 'woocommerce_cart_needs_shipping', 'filter_function_disable_shipping' );
// function filter_function_disable_shipping( $needs_shipping ){
//     return false;
// }
add_filter( 'default_checkout_billing_country', 'change_default_checkout_country_and_state' );
add_filter( 'default_checkout_shipping_country', 'change_default_checkout_country_and_state' );
add_filter( 'default_checkout_billing_state', 'change_default_checkout_country_and_state' );
add_filter( 'default_checkout_shipping_state', 'change_default_checkout_country_and_state' );
function change_default_checkout_country_and_state( $default ) {
    return null;
}

add_action('woocommerce_after_checkout_shipping_form', 'frontendie_checkout_shipping_fields' );
function frontendie_checkout_shipping_fields() {
    if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) {
        ?>
        <p class="form-row form-row-wide update_totals_on_change">
            <label for="shipping_method">Способ доставки:</label>
            <span class="woocommerce-input-wrapper">
                <span class="woocommerce-shipping-methods">
                <?php
                wc_cart_totals_shipping_html();
                ?>
                </span>
            </span>
        </p>
        <?php
    }
}


add_action( 'woocommerce_after_checkout_shipping_form' , 'frontendie_checkout_payments_method_fields' );
function frontendie_checkout_payments_method_fields( $gateway ) {
    if (WC()->cart->needs_payment()) {
        $WC_Payment_Gateways = new WC_Payment_Gateways();
        $available_gateways = $WC_Payment_Gateways->get_available_payment_gateways();
        if ( ! empty( $available_gateways ) ) {
        ?>
            <p class="form-row form-row-wide update_totals_on_change">
            менеджер свяжется с вами, чтобы уточнить стоимость доставки и способ оплаты
            </p>
        <?php
        }
    }
}


// Скрыть товары с нулевой или пустой ценой на страницах архивов Woocommerce
add_filter( 'woocommerce_product_query_meta_query', 'shop_only_instock_products', 10, 2 );
function shop_only_instock_products( $meta_query, $query ) {
    // In frontend only
    if( is_admin() ) return $meta_query;

    $meta_query['relation'] = 'OR';

    $meta_query[] = array(
        'key'     => '_price',
        'value'   => '',
        'type'    => 'numeric',
        'compare' => '!='
    );
    $meta_query[] = array(
        'key'     => '_price',
        'value'   => 0,
        'type'    => 'numeric',
        'compare' => '!='
    );
    return $meta_query;
}


//The filters.. both are required.
add_filter('gettext', 'change_checkout_btn');
add_filter('ngettext', 'change_checkout_btn');

//function
function change_checkout_btn($checkout_btn){
  $checkout_btn= str_ireplace('Оформить заказ', 'перейти к оформлению', $checkout_btn);
  return $checkout_btn;
}
