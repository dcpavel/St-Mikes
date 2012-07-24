<?php
echo $this->Html->css(array('calendar', 'form'), null, array('inline' => false));
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
                ),
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
                'type' => 'radio',
                'div' => 'radio colors'
            )
        );
    
    echo $this->Form->input('description');
    
    $enable_class = 'enable active';
    $disable_class = 'disable';
    if (!empty($this->request->data['Calendar']['status']) && !$this->request->data['Calendar']['status']) {
        $enable_class = 'enable';
        $disable_class = 'disable active';
    }
    
    echo $this->Form->input(
            'status',
            array(
                'div' => true,
                'type' => 'radio',
                'options' => array(
                    1 => $this->Html->image(
                            'Blank.png',
                            array(
                                'class' => $enable_class,
                                'title' => 'Active',
                                'alt' => 'Active'
                            )
                        ),
                    0 => $this->Html->image(
                            'Blank.png',
                            array(
                                'class' => $disable_class,
                                'title' => 'Inactive',
                                'alt' => 'Inactive'
                            )
                        )
                ),
                'default' => 1
            )
        );
    
    echo $this->Form->submit(
            'Disquette.png',
            array(
                'title' => 'Save',
                'alt' => 'Save'
            )
        );
    echo $this->Form->end();
    ?>
</div>
<?php
echo $this->Html->script(array('form'));
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.colors input').hide().click(function() {
            $(this).siblings('label').removeClass('selected');
            $('label[for="' + this.id + '"]').addClass('selected');
        });
    });
</script>