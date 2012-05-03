<?php
echo $this->Html->css(array('pepper-grinder/jquery-ui-1.8.17.custom', 'calendar'));
echo $this->Html->script(array('jquery-ui-1.8.17.custom.min'), array('inline' => false));
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
                'action' => 'index',
                'admin' => true
            )
        );
    ?>
</div>
<h1>
    Edit Calendar
</h1>
<div class="form calendar">
    <?php
    echo $this->Session->flash();
    
    $url = array_merge(
            $this->passedArgs,
            array(
                'controller' => 'calendars'
            )
        );
    echo $this->Form->create('CalendarEvent', array('url' => $url));
    
    echo $this->Form->input('title');
    echo $this->Form->hidden('id');
    
    echo $this->Form->input('calendar');
    
    echo $this->Form->input(
            'start_date',
            array(
                'class' => 'date',
                'type' => 'text'
            )
        );
    echo $this->Form->input(
            'start_time',
            array(
                'options' => $times,
                'default' => 1200
            )
        );
    
    echo $this->Form->input(
            'end_date',
            array(
                'class' => 'date',
                'type' => 'text'
            )
        );
    echo $this->Form->input(
            'end_time',
            array(
                'options' => $times,
                'default' => 1200
            )
        );
    
    echo $this->Form->input('repeat', array('options' => $repeat));
    
    echo $this->Form->input('description');
    
    echo $this->Form->input(
            'status',
            array(
                'div' => true,
                'type' => 'radio',
                'options' => array(
                    1 => 'active',
                    0 => 'inactive'
                ),
                'default' => 1
            )
        );
    
    echo $this->Form->submit('Disquette.png');
    echo $this->Form->end();
    ?>
</div>
<script type="text/javascript">
    $('input.date').datepicker({dateFormat: 'yy-mm-dd'});
</script>