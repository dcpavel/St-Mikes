<?php
echo $this->Html->css(array('calendar'));
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
<div class="form">
    <h1>
        Select Calendar
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
    $view = array(
        'controller' => 'calendars',
        'action' => 'view',
        $current->format('Y-m-d')
    );
    $day_events = (!empty($events[$i])) ? $events[$i] : array();
    
    if ($i == 1) {
        foreach ($headers as $weekday) {
            if ($weekday == $first_day) {
                $row[] = $this->Html->calendarDay($i, $day_events, $view);
                break;
            } else {
                $row[$j] = '';
                $j++;
            }
        }
    } else {
        $row[] = $this->Html->calendarDay($i, $day_events, $view);;
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
