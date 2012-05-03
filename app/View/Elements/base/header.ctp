<div class="logo">
    <div class="ribbon-wrapper">
        <div class="ribbon-front">
            <?php
            echo $this->Html->link(
                'Saint Michael and All Angels Parish Church',
                '/',
                array('class' => 'banner_link')
            );
            ?>
        </div>
        <div class="ribbon-edge-topleft"></div>
        <div class="ribbon-edge-topright"></div>
        <div class="ribbon-edge-bottomleft"></div>
        <div class="ribbon-edge-bottomright"></div>
        <div class="ribbon-back-left"></div>
        <div class="ribbon-back-right"></div>
    </div>
    <div class="ribbon-title">
        <div class="title-front">
            <?php
            echo $this->Html->link(
                $this->Html->image("episcopal-church-logo-horizontal-eng.png"),
                'http://ecusa.anglican.org/',
                array(
                    'target' => '_blank',
                    'class' => 'banner_link'
                )
            );
            ?>
        </div>
    </div>
</div>
<?php echo $this->element('nav'); ?>