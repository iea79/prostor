<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package frondendie
 */
$siteSettings = SCF::get_option_meta( 'site-settings' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;500;600;700;800;900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<header id="masthead" class="header">

		<div class="header__content">

			<div class="menu__toggle"><span></span></div>

			<div class="header__logo">
				<?php
					the_custom_logo();
				?>
			</div>

			<nav id="site-navigation" class="nav">
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
				<div class="nav__footer mobile">
					<div class="nav__soc">
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
					<div class="nav__contact">
						<a href="tel: <?php echo $siteSettings['site_tel'] ?>"><?php echo $siteSettings['site_tel'] ?></a>
						<a href="mailto: <?php echo $siteSettings['site_email'] ?>"><?php echo $siteSettings['site_email'] ?></a>
						<div class="nav__address"><?php echo $siteSettings['site_address'] ?></div>
					</div>
					<div class="nav__callback">
						<div class="form">
							<?php echo do_shortcode( '[contact-form-7 id="289" title="Обратный звонок"]' ); ?>
						</div>
						<div class="nav__policy">Нажимая кнопку «Перезвонить» вы соглашаетесь на <a href="#">обработку персональных данных</a> и с <a href="/privacy-policy">политикой конфиденциальности</a></div>
					</div>
				</div>
			</nav>

			<div class="header__action">
				<div class="header__soc">
					<div class="soc">
						<i class="icon_zoom-slim searchPopup__open"></i>
					</div>
					<div class="soc">
						<?php
						$socials = SCF::get_option_meta( 'site-settings','socials');

						foreach ($socials as $item) {
							$icon = 'icon_youtube';

							if ($item['socials_'] == 'Instagram') {
								$icon = 'icon_insta';
							}
							echo '
							<a href="'.$item['socials_link'].'"  class="'.$icon.'" target="_blank"></a>
							';
						};
						?>
					</div>
				</div>
				<div class="header__cart">
					<?php
					global $woocommerce; ?>
					<a href="<?php echo wc_get_cart_url() ?>" class="cart">
						<span class="cart__btn">
							<span class="icon_cart"></span>
						</span>
						<?php if ($woocommerce->cart->cart_contents_count): ?>
							<span class="cart__counter"></span>
						<?php endif; ?>
					</a>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
