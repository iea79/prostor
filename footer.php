<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package frondendie
 */

$siteSettings = SCF::get_option_meta( 'site-settings' );


?>

	<footer id="colophon" class="footer">
		<div class="footer__content">
			<div class="footer__top">
				<div class="footer__contact">
					<a href="/" class="footer__logo">Pro-stor</a>
					<a href="tel: <?php echo $siteSettings['site_tel'] ?>"><?php echo $siteSettings['site_tel'] ?></a>
					<a href="mailto: <?php echo $siteSettings['site_email'] ?>"><?php echo $siteSettings['site_email'] ?></a>
					<div class="footer__address"><?php echo $siteSettings['site_address'] ?></div>
				</div>
				<div class="footer__nav">
					<?php
					wp_nav_menu( [
						'menu'            => 'menu-1',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						] );
					?>
				</div>
				<div class="footer__soc">
					<?php
					$socials = SCF::get_option_meta( 'site-settings','socials');

					foreach ($socials as $item) {
						$icon = 'icon_youtube';

						if ($item['socials_'] == 'Instagram') {
							$icon = 'icon_insta';
						}
						echo '
						<a href="'.$item['socials_link'].'" target="_blank">
							<i  class="'.$icon.'"></i>
							'.$item['socials_'].'
						</a>
						';
					};
					?>

				</div>
				<div class="footer__callback">
					<div class="form">
						<?php echo do_shortcode( '[contact-form-7 id="289" title="Обратный звонок"]' ); ?>
					</div>
					<div class="footer__policy">Нажимая кнопку «Перезвонить» вы соглашаетесь на <a href="#">обработку персональных данных</a> и с <a href="/privacy-policy">политикой конфиденциальности</a></div>
				</div>
			</div>
			<div class="footer__bottom">
				<div class="footer__copy">© Prostor59, 2018-2021</div>
				<div class="footer__privacy">
					<a href="/privacy-policy">Политика конфиденциальности </a>
					<a href="#">Cookies</a>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->

	<div class="searchPopup">
		<div class="searchPopup__overlay"></div>
		<div class="searchPopup__wrap">
			<div class="searchPopup__close">
				<i class="icon_plus"></i>
			</div>
			<div class="container_center">
				<?php
				$btnColor = false;
				require get_template_directory() . '/woocommerce/product-searchform.php';
				?>
			</div>
		</div>
	</div>

<?php wp_footer(); ?>

</body>
</html>
