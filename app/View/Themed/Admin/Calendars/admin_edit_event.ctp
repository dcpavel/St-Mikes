<?php
echo $this->Html->css(array('pepper-grinder/jquery-ui-1.8.21.custom', 'calendar', 'form'));
echo $this->Html->script(array('form'), array('inline' => false));
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
    
    echo $this->Form->input('calendar_id');
    
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
    
    $enable_class = 'enable active';
    $disable_class = 'disable';
    if (!empty($this->request->data['CalendarEvent']['status']) && !$this->request->data['CalendarEvent']['status']) {
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