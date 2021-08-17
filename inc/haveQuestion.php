<?php
if ( has_term( 'zapchasti', 'product_cat' ) ) {
    ?>
    <div class="haveQuestion">
        <div class="haveQuestion__title">Остались вопросы?</div>
        <div class="haveQuestion__text">Свяжитесь с нами, и мы отвтеим на все интересющие вас вопросы</div>
        <button class="btn btn_contrast" data-toggle="modal" data-target="#sendQuestion">Задать вопрос</button>
    </div>


    <!-- begin Modal sendQuestion -->
    <div class="modal fade" id="sendQuestion">
        <div class="modal-dialog modal-dialog_sm">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal"></a>
                <div class="modal-title" id="myModalLabel">Задать вопрос о товаре</div>
                <div class="form">
                    <?php echo do_shortcode( '[contact-form-7 id="597" title="Задать вопрос о товаре"]' ); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal sendQuestion -->
    <?php
} else {
    ?>
    <div class="haveQuestion">
        <div class="haveQuestion__title">Требуется ремонт?</div>
        <div class="haveQuestion__text">Свяжитесь с нами, и мы обсудим все детали</div>
        <button class="btn btn_contrast" data-toggle="modal" data-target="#sendQuestion">Оставить заявку</button>
    </div>


    <!-- begin Modal sendQuestion -->
    <div class="modal fade" id="sendQuestion">
        <div class="modal-dialog modal-dialog_sm">
            <div class="modal-content">
                <a href="#" class="modal-close" data-dismiss="modal"></a>
                <div class="modal-title" id="myModalLabel">Оставить заявку на ремонт</div>
                <div class="form">
                    <?php echo do_shortcode( '[contact-form-7 id="596" title="Требуется ремонт?"]' ); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal sendQuestion -->
    <?php
}
