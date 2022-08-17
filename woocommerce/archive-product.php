<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
		<?php

		if( is_product_category( 'zapchasti' ) ) {
			?>
			<h1 class="page__title">Каталог <b>запчастей</b></h1>

			<?php
		}
		elseif ( is_product_category( 'remont' ) ) {
			?>
			<h1 class="page__title">Каталог <b>услуг</b></h1>
			<?php
		} else {
			?>
			<h1 class="page__title"><?php woocommerce_page_title(); ?></h1>
			<?php
		}
		 ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );

	?>
</header>
<div class="productsPage__header">
	<div class="container_center">
		<?php
		$btnColor = false;
		require get_template_directory() . '/woocommerce/product-searchform.php';
		?>
	</div>
</div>
<?php
if ( woocommerce_product_loop() ) {

	?>
		<div class="productsPage__content">
			<div class="productsPage__body">
				<?php

				/**
				* Hook: woocommerce_before_shop_loop.
				*
				* @hooked woocommerce_output_all_notices - 10
				* @hooked woocommerce_result_count - 20
				* @hooked woocommerce_catalog_ordering - 30
				*/
				?>
				<div class="productsPage__sort">
					<?php
					do_action( 'woocommerce_before_shop_loop' );
					?>
				</div>
				<?php


				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();
						// get_price();

						/**
						* Hook: woocommerce_shop_loop.
						*/
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				/**
				* Hook: woocommerce_after_shop_loop.
				*
				* @hooked woocommerce_pagination - 10
				*/
				do_action( 'woocommerce_after_shop_loop' );

				?>
			</div>
			<div class="productsPage__aside">
				<?php // do_action( 'woocommerce_sidebar' ); ?>
				<?php
				if ( is_shop() ) {
					?>
						<!-- <div class="productsFilter"> -->
							<?php
								// echo do_shortcode( '[br_filter_single filter_id=299]' );
							?>
						<!-- </div> -->
					<?php
				}
				if (is_product_category()) {
					?>
						<!-- <div class="productsFilter"> -->
							<?php
							if( is_product_category( 'zapchasti' ) ) {
								// Запчасти
								// echo do_shortcode( '[br_filter_single filter_id=297]' );
							}
							if( is_product_category( 'remont' ) ) {
								// Запчасти
								// echo do_shortcode( '[br_filter_single filter_id=298]' );
							}
							?>
						<!-- </div> -->
					<?php
				}
				require get_template_directory() . '/inc/haveQuestion.php';

				require get_template_directory() . '/inc/actionBanner.php';

				require get_template_directory() . '/inc/instaBox.php';

				 ?>
			</div>
		</div>
	<?php
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

require get_template_directory() . '/inc/brandsLine.php';

?>
<div class="popularLine">
	<div class="container_center">
		<h2 class="section__title">Популярные <b>товары</b></h2>

		<?php
		$loop = new WP_Query( array(
			'post_type' => 'product',
			'posts_per_page' => 4,
			'orderby' => 'rand',
			'order' => 'DESC',
		));
		if ($loop) {
			?>
			<ul class="woocommerce popularProduct">
				<?php

					while ( $loop->have_posts() ): $loop->the_post(); ?>
						<?php
							// $img = the_post_thumbnail();
							// if (!$img) {
							// 	$img = wp_get_attachment_image(256, 'full');
							// }
						 ?>
						<li <?php post_class("product"); ?>>
							<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<span class="woocommerce-loop-product__img">
									<?php
									if (has_post_thumbnail()) {
										the_post_thumbnail(array(250, 240));
									} else {
										echo wp_get_attachment_image(256, 'full');
									}
									?>
								</span>
								<h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
								<?php woocommerce_template_loop_price(); ?>
							</a>
							<?php woocommerce_template_loop_add_to_cart(); ?>
						</li>
						<!-- <div <?php post_class("inloop-product"); ?>>
							<div class="row">
								<div class="col-sm-4">
									<?php the_post_thumbnail("thumbnail-215x300"); ?>
								</div>
								<div class="col-sm-8">
									<h4>
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h4>
									<?php the_content(); ?>
									<p class="price">
										<?php _e("Price:","examp"); ?>
										<?php woocommerce_template_loop_price(); ?>
									</p>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								</div>
							</div>
						</div> -->
				<?php endwhile; ?>
				</ul>
			<?php
		}
		 ?>


		<div class="slidersArrow mobile">
			<button class="slick-arrow slick-prev products__prev"></button>
			<button class="slick-arrow slick-next products__next"></button>
		</div>

	</div>
</div>
<?php


setVideoLine(3);

require get_template_directory() . '/inc/aboutLine.php';

get_footer( 'shop' );
