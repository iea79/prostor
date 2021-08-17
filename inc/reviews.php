<?php // параметры по умолчанию
    $posts = get_posts( array(
        'numberposts' => 15,
        'post_type'   => 'post',
        'offset'      => 0,
        'category'    => 1,
        'orderby'     => 'rand'
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
