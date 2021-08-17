<!-- begin popularCats -->
<section id="popularCats" class="popularCats">
    <div class="container_center">
        <div class="inlineHeader">
            <h2 class="section__title"><?php echo SCF::get_option_meta( 'popular-cats', 'popularCats__title' ) ?></h2>
            <div class="inlineHeader__right desktop">
                <button class="slick-arrow slick-prev popularCats__prev"></button>
                <button class="slick-arrow slick-next popularCats__next"></button>
            </div>
        </div>
        <div class="popularCats__slider">
            <?php
                $popularCats = SCF::get_option_meta( 'popular-cats', 'popularCats' );

                // print_r($popularCats);

                foreach ($popularCats as $item) {
                    echo '
                    <div class="popularCats__item">
                        <a href="'.get_category_link($item['popularCats__link'][0]).'" class="popularCats__link">
                            <span class="popularCats__img">
                                '.wp_get_attachment_image($item['popularCats__img'], 'full').'
                            </span>
                            <span class="popularCats__name">'.$item['popularCats__name'].'</span>
                        </a>
                    </div>
                    ';
                };
            ?>
        </div>
        <div class="slidersArrow mobile">
            <button class="slick-arrow slick-prev popularCats__prev"></button>
            <button class="slick-arrow slick-next popularCats__next"></button>
        </div>
    </div>
</section>
<!-- end popularCats -->
