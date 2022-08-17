<!-- Begin instaBox -->
<div id="instaBox" class="instaBox">
    <?php
        $insta_list = SCF::get_option_meta( 'ours-photo', 'insta_list');
        // var_dump($insta_list);

        foreach ($insta_list as $item) {
            ?>
            <a href="<?php echo $item['insta_link'] ?>" class="ourPhoto__item" target="_blank">
                <span class="ourPhoto__img"><?php echo wp_get_attachment_image($item[ 'insta_photo' ],'full') ?></span>
                <span class="ourPhoto__text"><?php echo $item['insta_text'] ?></span>
            </a>
            <?php
        };
    ?>
</div>
<!-- End instaBox -->
