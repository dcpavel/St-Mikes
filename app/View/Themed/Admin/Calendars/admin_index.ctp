<?php
echo $this->Html->css(array('calendar'), null, array('inline' => false));
?>
<div class="title">
    <div class="previous">
        <?php
        $previous = clone $date;
        $previous->modify('-1 month');
        echo $this->Html->link(
                $this->Html->image(
                        'Arrow_left.png',
                        array(
                            'alt' => 'Previous Month',
                            'title' => $previous->format('F Y')
                        )
                    ),
                array(
                    'action' => 'index',
                    $previous->format('M-Y')
                )
            );
        ?>
    </div>
    <div class="current">
        <?php echo $date->format('F Y') ?>
    </div>
    <div class="next">
        <?php
        $next = clone $date;
        $next->modify('+1 month');
        echo $this->Html->link(
                $this->Html->image(
                        'Arrow_right.png',
                        array(
                            'alt' => 'Next Month',
                            'title' => $next->format('F Y')
                        )
                    ),
                array(
                    'action' => 'index',
                    $next->format('M-Y')
                )
            );
        ?>
    </div>
</div>
<div class="left form">
    <h1>
        Filter Calendar
    </h1>
    <?php
    echo $this->Form->create('Calendar', array('url' => $this->passedArgs));
    
    echo $this->Form->input(
            'Calendar.id',
            array(
                'options' => $calendars,
                'label' => 'Calendar'
            )
        );
    
    echo $this->Form->submit(
            'Arrow_right.png',
            array(
                'alt' => "Search",
                'class' => 'submit_button',
                'title' => 'Search'
            )
        );
    echo $this->Form->end();
    ?>
</div>
<div class="right form">
    <h1>
        Edit Calendars
    </h1>
    <?php
    echo $this->Form->create('Calendar', array('url' => array('action' => 'admin_edit_calendar')));
    
    echo $this->Form->input(
            'Calendar.id',
            array(
                'options' => $calendars,
                'label' => 'Calendar'
            )
        );
    
    echo $this->Form->submit(
            'Arrow_right.png',
            array(
                'alt' => "Edit",
                'class' => 'submit_button',
                'title' => 'Edit Calendar'
            )
        );
    echo $this->Form->end();
    
    echo $this->Html->link(
            $this->Html->image(
                    'Orb_plus.png',
                    array(
                        'class' => 'add_button',
                        'alt' => 'Add Calendar',
                        'title' => 'Add Calendar'
                    )
                ),
            array(
                'controller' => 'calendars',
                'action' => 'admin_edit_calendar'
            ),
            array(
                'escape' => false
            )
        );
    ?>
</div>
<div class="clear"></div>
<?php
$headers = array(
    'Sunday',
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday'
);

$table = $this->Html->tableHeaders($headers);

$first_day = $date->format('l');
$last_day = $date->format('t');

$cells = array();
$row = array();
$j = 0;
for ($i = 1; $i <= $last_day; $i++) {
    $current = new DateTime("$i {$date->format('F Y')}");
    $edit = array(
            'controller' => 'calendars',
            'action' => 'admin_edit_event',
        );
    $edit_new = array(
            'controller' => 'calendars',
            'action' => 'admin_edit_event',
            $current->format('Y-m-d')
        );
    $day_events = (!empty($events[$i])) ? $events[$i] : array();
    $link = $this->Html->calendarDay($i, $day_events, $edit, $edit_new);
    
    if ($i == 1) {
        foreach ($headers as $weekday) {
            if ($weekday == $first_day) {
                
                $row[] = $link;
                break;
            } else {
                $row[$j] = '';
                $j++;
            }
        }
    } else {
        $row[] = $link;
    }
    
    if (count($row) == count($headers)) {
        $cells[] = $row;
        $row = array();
    }
}
if (!empty($row)) {
    $cells[] = array_pad($row, count($headers), '');
}

$table .= $this->Html->tableCells($cells);

$table = $this->Html->tag('table', $table, array('class' => 'calendar'));

echo $this->Html->div('table', $table);
?>