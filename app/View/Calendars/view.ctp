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
                'action' => 'index'
            )
        );
    ?>
</div>
<div class="calendar">
    <h1>
        <?php echo $event['CalendarEvent']['title']; ?>
    </h1>
    <h2 class="date">
        <?php
        echo date('F j, Y', strtotime($date));
        ?>
    </h2>
    <h2 class="time">
        <?php
        $start_time = date('g:i A', strtotime($event['CalendarEvent']['start_time']));
        $end_time = date('g:i A', strtotime($event['CalendarEvent']['end_time']));
        echo "$start_time - $end_time";
        ?>
    </h2>
    <div class="location">
        <?php
        if (!empty($event['Location'])) {
            debug($event['Location']);
        }
        ?>
    </div>
    <div class="description">
        <?php echo $event['CalendarEvent']['description']; ?>
    </div>    
</div>
