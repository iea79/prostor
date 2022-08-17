<!-- Begin brandsLine -->
<div class="brandsLine">
    <div class="container_center">
        <div class="brandsLine__content">
            <?php
            $prod_cat_args = array(
                'number'      => 6,
                'include' => '71,68,63,67,70,64',
                'orderby' => 'include',
                'order' => 'ASC',
                'exclude'     => 16,
                'taxonomy'    => 'product_cat',
                'hide_empty'  => true, // скрывать категории без товаров или нет
                'parent'      => 61, // id родительской категории
            );

            $woo_categories = get_categories( $prod_cat_args );

            // print_r($woo_categories);

            foreach ( $woo_categories as $woo_cat ) {
                echo '<a href="'.get_category_link($woo_cat->term_id).'" class="brandsLine__item">';
                $category_thumbnail_id = get_term_meta($woo_cat->term_id, 'thumbnail_id', true);
                $thumbnail_image_url = wp_get_attachment_url($category_thumbnail_id);
                echo '<img src="' . $thumbnail_image_url . '"/>';
                echo "</a>\n";
            }
            ?>
        </div>
        <div class="brandsLine__more">
            <a href="/shop/zapchasti">Все бренды</a>
        </div>
    </div>
</div>
<!-- End brandsLine -->
