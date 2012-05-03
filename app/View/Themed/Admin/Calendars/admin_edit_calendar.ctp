<?php
echo $this->Html->css(array('calendar'), null, array('inline' => false));
?>
<div class="back">
    <?php
    echo $this->Html->link(
            $this->Html->image(
                    'Arrow_left.png',
                    array(
                        'alt' => 'Return to Calendar',
                        'title' => 'Return to Calendar'
                    )
                ) . ' <span>Return to Calendar</span>',
            array(
                'controller' => 'calendars',
                'action' => 'admin_index'
            )
        );
    ?>
</div>
<h1>
    Edit Calendar
</h1>
<div class="form calendar">
    <?php
    echo $this->Form->create('Calendar', array('url' => $this->passedArgs));
    
    echo $this->Form->input('title');
    echo $this->Form->hidden('id');
    
    foreach ($colors as $i => $color) {
        $colors[$color] = $this->Html->div(
                "$color cal_label",
                '&#160;'
            );
        unset($colors[$i]);
    }
    echo $this->Form->input(
            'color',
            array(
                'options' => $colors,
                'type' => 'radio'
            )
        );
    
    echo $this->Form->input('description');
    
    echo $this->Form->input(
            'status',
            array(
                'div' => true,
                'type' => 'radio',
                'options' => array(
                    1 => $this->Html->image('Badge-tick.png'),
                    0 => $this->Html->image('Badge-multiply.png')
                )
            )
        );
    
    echo $this->Form->submit('Disquette.png');
    echo $this->Form->end();
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.radio input').hide().click(function() {
            $(this).siblings('label').removeClass('selected');
            $('label[for="' + this.id + '"]').addClass('selected');
        });
    });
</script>