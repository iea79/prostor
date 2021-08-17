<!-- begin aboutLine -->
<section id="aboutLine" class="aboutLine">
    <div class="container_center">
        <div class="aboutLine__content">
            <div class="aboutLine__descr">
                <h2 class="section__title"><b><?php echo SCF::get_option_meta( 'about-us', 'aboutLine__title' ) ?></b></h2>
                <div class="aboutLine__photo">
                    <?php echo wp_get_attachment_image(SCF::get_option_meta( 'about-us', 'aboutLine__photo' ), 'full') ?>
                </div>
                <div class="aboutLine__sub"><?php echo SCF::get_option_meta( 'about-us', 'aboutLine__descr' ) ?></div>
                <div class="aboutLine__subscribe">
                    <div class="aboutLine__label">Посетите наши каналы в социальных сетях</div>
                    <div class="aboutLine__btns">
                        <?php
                            $socials = SCF::get_option_meta( 'site-settings','socials');

                            foreach ($socials as $item) {
                                $icon = 'icon_youtube';

                                if ($item['socials_'] == 'Instagram') {
                                    $icon = 'icon_insta';
                                }
                                echo '
                                <a href="'.$item['socials_link'].'" class="btn">
                                    <i class="'.$icon.'"></i>
                                    '.$item['socials_'].'
                                </a>
                                ';
                            };
                        ?>
                    </div>
                </div>
                <?php
                $aboutLine__serts = SCF::get_option_meta( 'about-us', 'aboutLine__serts' );
                if (count($aboutLine__serts) > 0) {
                    ?>
                    <div class="aboutLine__serts">
                        <?php

                            foreach ($aboutLine__serts as $item) {
                                echo '
                                <a href="'.wp_get_attachment_url($item['aboutLine__serts_item'], 'full').'" data-fancybox="serts">
                                    '.wp_get_attachment_image($item['aboutLine__serts_item'], 'medium').'
                                </a>
                                ';
                            };
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- end aboutLine -->
