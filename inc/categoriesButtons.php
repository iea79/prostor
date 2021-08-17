<?php
$allCats = get_terms([
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'parent' => 0,
    'exclude' => 16
]);
// var_dump($allCats);
?>
<div class="shopNav">
    <?php
        $i = 0;
        foreach ($allCats as $cat) {
            $btnClass = 'btn';
            if ($i == 1) {
                $btnClass = 'btn btn_border';
            }
            ?>
            <a href="<?php echo get_category_link($cat->term_id); ?>" class="<?php echo $btnClass ?>"><?php echo $cat->name ?></a>
            <?php
            $i++;
        }
    ?>
</div>
