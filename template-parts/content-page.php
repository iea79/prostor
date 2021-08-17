<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frondendie
 */

if (is_front_page()) {
	require get_template_directory() . '/template-parts/content-home.php';
} else {
	?>

		<?php
		echo '<div class="container_center">';
		true_breadcrumbs();

		the_title( '<h1 class="title">', '</h1>' );

		echo "</div>";

		if (is_page(557) ) {
			echo '<div class="container_center">';
			?>
			<div class="productsPage__content">
				<div class="productsPage__body delivery textBox">
					<?php
					the_content();
					?>
				</div>
				<div class="productsPage__aside">
					<?php

						require get_template_directory() . '/inc/haveQuestion.php';

						require get_template_directory() . '/inc/actionBanner.php';

						require get_template_directory() . '/inc/instaBox.php';

					 ?>
				</div>
			</div>
			<?php
			echo "</div>";
		} elseif (is_page(574)) {
			// Review page
			echo '<div class="container_center">';
			?>
			<div class="productsPage__content">
				<div class="productsPage__body reviewPage textBox">
						<?php
						if (function_exists('user_submitted_posts')) user_submitted_posts();
						?>
						<div class="reviewPage__list">
							<?php // параметры по умолчанию
							$posts = get_posts( array(
								'numberposts' => -1,
								'post_type'   => 'post',
								'category'    => 1,
								'orderby'     => 'rand'
							));

							$rcount = 0;

							foreach( $posts as $post ){
								setup_postdata($post);
								$attach = get_attached_media( 'image', $post->ID );
								$hidden = '';
								if ($rcount > 1) {
									$hidden = 'hidden';
								}
								// формат вывода the_title() ...
								?>
								<div class="review__item <?php echo $hidden ?>">
									<div class="review__date"><?php the_time('d.m.Y'); ?></div>
									<div class="review__name"><?php  the_title(); ?></div>
									<div class="review__text"><?php echo get_the_content(); ?></div>
									<?php if (has_post_thumbnail()): ?>
										<div class="review__photo">
											<?php
											foreach ( $attach as $img ) {
												// var_dump( $img->guid);
												?>
												<div class="review__img">
													<?php // echo $img->ID ?>
													<a href="<?php echo $img->guid ?>" data-fancybox="" data-fancybox-group>
														<?php echo wp_get_attachment_image( $img->ID, array(60, 60) ) ?>
													</a>
												</div>
												<?php
											}
											?>
										</div>
									<?php endif; ?>
								</div>
								<?php
								$rcount++;
							}

							wp_reset_postdata(); // сброс
							?>
						</div>

						<button type="button" class="btn btn_primary reviewPage__more">Показать ещё</button>
					</div>
				<div class="productsPage__aside">
					<?php

					require get_template_directory() . '/inc/haveQuestion.php';

					require get_template_directory() . '/inc/actionBanner.php';

					require get_template_directory() . '/inc/instaBox.php';

					?>
				</div>
			</div>
			<?php
			echo "</div>";
		} elseif (is_page(568)) {
			$socials = SCF::get_option_meta( 'site-settings','socials');
			// print_r($socials[0]['socials_link']);


			setVideoLine(9);
			?>
			<!-- begin ourPhoto -->
			<section id="ourPhoto" class="ourPhoto">
				<div class="container_center">
					<div class="inlineHeader">
		                <h2 class="section__title">Наши <b>фотографии</h2>
		                <div class="inlineHeader__right">
		                    <a href="<?php echo $socials[1]['socials_link'] ?>" target="_blank" class="videoLine__channel">
		                        Ещё больше в нашем
		                        <span>
		                            <img src="<?php echo get_template_directory_uri() . '/img/instagram.svg' ?>" alt="">
		                        </span>
		                    </a>
		                </div>
		            </div>
					<div class="ourPhoto__list">

					</div>
				</div>
			</section>
			<!-- end ourPhoto -->
			<?php
		} else {
			echo '<div class="container_center">';
			?>
				<?php frondendie_post_thumbnail(); ?>

				<div class="page__content textBox">
					<?php
					the_content();
					?>
				</div><!-- .entry-content -->
			<?php
			echo "</div>";
		}
		?>
	</div>
	<?php

}
