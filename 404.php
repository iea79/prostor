<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package frondendie
 */

get_header();
?>

	<main id="primary" class="main">

		<div class="container_center">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Такой страницы не существует.', 'frondendie' ); ?></h1>
					<a href="/" class="btn">Вернуться на главную</a>
					<h2>Или воспользуйтесь поиском по товарам</h2>
				</header><!-- .page-header -->

				<div class="page-content">
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div>
		<!-- begin searchLine -->
		<div id="searchLine" class="searchLine">
		    <!-- <div class="searchLine__bg">
		        <img src="" alt="">
		    </div> -->
		    <div class="container_center">
		        <?php
		        $btnColor = true;
		        require get_template_directory() . '/woocommerce/product-searchform.php';
		         ?>
		    </div>
		</div>
		<!-- end searchLine -->
	</main><!-- #main -->

<?php
get_footer();
