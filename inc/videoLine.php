<?php
function setVideoLine($countItems = "3") {
    $socials = SCF::get_option_meta( 'site-settings','socials');
    // print_r($socials[0]['socials_link']);

    ?>
    <!-- begin videoLine -->
    <section id="videoLine" class="videoLine">
        <div class="container_center">
            <div class="inlineHeader">
                <h2 class="section__title"><?php echo SCF::get_option_meta( 'ours-video', 'videoLine__title' ) ?></h2>
                <div class="inlineHeader__right desktop">
                    <a class="videoLine__channel" href="<?php echo $socials[0]['socials_link']; ?>" target="_blank">
                        Посмотрите все на канале
                        <span>
                            <img src="<?php echo get_template_directory_uri() . '/img/youtube.svg' ?>" alt="">
                        </span>
                    </a>
                </div>
            </div>
            <div class="videoLine__row">
                <?php
                $ourVideo = $popularCats = SCF::get_option_meta( 'ours-video', 'videoLine' );
                $totalItemInPage = 0;

                foreach ($ourVideo as $item) {
                    if ($totalItemInPage < $countItems) {
                        ?>
                        <div class="videoLine__item">
                            <div class="videoLine__video">
                                <div class="video__wrapper js-youtube" id="<?php echo $item['videoLine__id'] ?>">
                                    <?php echo wp_get_attachment_image($item['videoLine__preview'], 'full', false, array('class'=>"video__prev")) ?>
                                    <img src="<?php echo get_template_directory_uri() . '/img/play.svg' ?>" class="video__play" alt="">
                                </div>
                                <div class="videoLine__name"><?php echo $item['videoLine__name'] ?></div>
                            </div>
                        </div>
                        <?php
                    }
                    $totalItemInPage++;
                };
                ?>
            </div>
            <div class="slidersArrow mobile">
                <button class="slick-arrow slick-prev videoLine__prev"></button>
                <button class="slick-arrow slick-next videoLine__next"></button>
            </div>
            <div class="videoLine__bottom mobile">
                <a class="videoLine__channel" href="<?php echo $socials[0]['socials_link']; ?>" target="_blank">
                    Посмотрите все на канале
                    <span>
                        <img src="<?php echo get_template_directory_uri() . '/img/youtube.svg' ?>" alt="">
                    </span>
                </a>
            </div>
        </div>
    </section>
    <!-- end videoLine -->
    <?php
}
