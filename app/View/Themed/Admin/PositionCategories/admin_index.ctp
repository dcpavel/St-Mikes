<div class="search form">
    <?php
    echo $this->Form->create('PositionCategory');
    
    echo $this->Form->input(
            'Search',
            array(
                'label' => 'Search Title'
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
        array('Edit' => array('class' => 'edit_column'))
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($groups as $group) {
        $row = array();
        
        $id = $group['PositionCategory']['id'];
        
        $class = 'enabled';
        $title = 'Deactivate Group';
        if ($group['PositionCategory']['status'] !== true) {
            $class = 'disabled';
            $title = 'Activate Group';
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
                    'controller' => 'position_categories',
                    'action' => 'admin_status',
                    $id
                )
            );
        
        $row[] = $group['PositionCategory']['title'];
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Blank.png',
                        array(
                            'alt' => 'Edit Group',
                            'title' => 'Edit ' . $group['PositionCategory']['title'],
                            'class' => 'edit'
                        )
                    ),
                array(
                    'controller' => 'position_categories',
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
                    'alt' => 'Add Group',
                    'title' => 'Add Group'
                )
            ),
            array(
                'action' => 'admin_edit'
            )
        );
    ?>
</div>