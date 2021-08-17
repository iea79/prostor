<!-- begin mainScreen -->
<section id="mainScreen" class="mainScreen">
    <div class="mainSlider">
        <?php
            $mainSlider = SCF::get('mainSlider');
            $imgIndex = 0;

            foreach ($mainSlider as $item) {
                echo '
                <div class="mainSlider__item" data-slide-img="'.$imgIndex.'">
                    <img src="'.wp_get_attachment_url($item['mainSlider__img']).'" alt="">
                </div>
                ';
                $imgIndex++;
            };
        ?>
    </div>
    <div class="container_center">
        <div class="mainScreen__content">
            <h1 class="mainScreen__title"><?php echo SCF::get( 'mainScreen__title' ); ?></h1>
            <div class="mainScreen__text"><?php echo SCF::get( 'mainScreen__text' ); ?></div>
            <div class="mainScreen__action">
                <?php
                    $mainScreen__action = SCF::get('mainScreen__action');

                    // print_r($mainScreen__action);

                    foreach ($mainScreen__action as $item) {
                        echo '
                        <a href="'.get_category_link($item['mainScreen__action_link'][0]).'" class="btn '.$item['mainScreen__action_color'].'">'.$item['mainScreen__action_text'].'</a>
                        ';
                    };
                ?>
            </div>
        </div>
        <div class="mainScreen__search">
            <?php
            $btnColor = false;
            require get_template_directory() . '/woocommerce/product-searchform.php';
             ?>
        </div>
    </div>
</section>
<!-- end mainScreen -->

<?php

require get_template_directory() . '/inc/brandsLine.php';

require get_template_directory() . '/inc/popularCats.php';

setVideoLine(3);

 ?>



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

<?php

require get_template_directory() . '/inc/aboutLine.php';

 ?>

<!-- begin review -->
<section id="review" class="review">
    <div class="container_center">
        <div class="inlineHeader">
            <h2 class="section__title"><b>Отзывы</b> наших любимых клиентов</h2>
            <div class="inlineHeader__right desktop">
                <button class="slick-arrow slick-prev review__prev"></button>
                <button class="slick-arrow slick-next review__next"></button>
            </div>
        </div>
        <div class="review__slider">
            <?php // параметры по умолчанию
                $posts = get_posts( array(
                    'numberposts' => 15,
                    'post_type'   => 'post',
                    'category'    => 1,
                ));

                foreach( $posts as $post ){
                    setup_postdata($post);
                    $attach = get_attached_media( 'image', $post->ID );
                    // формат вывода the_title() ...
                    ?>
                    <div class="review__item">
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
                }

                wp_reset_postdata(); // сброс
            ?>
        </div>
        <div class="slidersArrow mobile">
            <button class="slick-arrow slick-prev review__prev"></button>
            <button class="slick-arrow slick-next review__next"></button>
        </div>
    </div>
</section>
<!-- end review -->
