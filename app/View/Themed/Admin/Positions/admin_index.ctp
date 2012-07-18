<div class="search form">
    <?php
    echo $this->Form->create('Position');
    
    echo $this->Form->input(
            'Search',
            array(
                'label' => 'Search Title'
            )
        );
    
    echo $this->Form->input(
            'positionCategory',
            array(
                'empty' => 'All Groups',
                'label' => 'Group'
            )
        );
    
    echo $this->Form->submit(
            'Zoom.png',
            array(
                'alt' => "Search",
                'title' => 'Search'
            ));
    echo $this->Form->end();
    ?>
</div>
<div class="table">
    <?php
    echo $this->Session->flash();
    
    $headers = array(
        array('Status' => array('class' => 'status_column')),
        'Title',
        'Group',
        array('Edit' => array('class' => 'edit_column'))
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($positions as $position) {
        $row = array();
        
        $id = $position['Position']['id'];
        
        $class = 'enabled';
        $title = 'Deactivate Position';
        if ($position['Position']['status'] !== true) {
            $class = 'disabled';
            $title = 'Activate Position';
        }
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Blank.png',
                        array(
                            'title' => $title,
                            'alt' => $title,
                            'class' => $class
                        )
                    ),
                array(
                    'controller' => 'positions',
                    'action' => 'admin_status',
                    $id
                )
            );
        
        $row[] = $position['Position']['title'];
        $row[] = $position['PositionCategory']['title'];
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Blank.png',
                        array(
                            'alt' => 'Edit Position',
                            'title' => 'Edit ' . $position['Position']['title'],
                            'class' => 'edit'
                        )
                    ),
                array(
                    'controller' => 'positions',
                    'action' => 'admin_edit',
                    $id
                )
            );
        
        array_push($cells, $row);
    }
    
    $table .= $this->Html->tableCells($cells);
    
    echo $this->Html->tag('table', $table);
    
    echo $this->Html->link(
            $this->Html->image(
                'Orb_plus.png',
                array(
                    'class' => 'add_button',
                    'alt' => 'Add Position',
                    'title' => 'Add Position'
                )
            ),
            array(
                'action' => 'admin_edit'
            )
        );
    ?>
</div>