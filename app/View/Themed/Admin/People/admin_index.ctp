<div class="search form">
    <?php
    echo $this->Form->create('People');
    
    echo $this->Form->input('Search');
    echo $this->Form->input(
            'Category',
            array(
                'type' => 'radio',
                'options' => array(
                    'all' => 'All',
                    'full_name' => 'Name',
                    'position' => 'Position',
                    'group' => 'Group'
                ),
                'default' => 'all'
            )
        );
    
    echo $this->Form->submit(
            'Zoom.png',
            array(
                'alt' => "Search",
                'class' => 'add_button',
                'title' => 'Search'
            ));
    echo $this->Form->end();
    ?>
</div>
<div class="table">
    <?php
    echo $this->Session->flash();
    
    $headers = array(
        'Status',
        'Full Name',
        'Position',
        'Group',
        'Modified',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($people as $person) {
        $row = array();
        
        $id = $person['Person']['id'];
        
        $name = $person['Person']['full_name'];
        
        $image = 'Badge-tick.png';
        $title = "List $name";
        if ($person['User']['status'] !== true) {
            $image = 'Badge-multiply.png';
            $title = "Delist $name";
        }
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        $image,
                        array(
                            'title' => $title,
                            'alt' => $title
                        )
                    ),
                array(
                    'controller' => 'users',
                    'action' => 'admin_status',
                    $id
                )
            );
        $row[] = $name;
        $row[] = $person['Position']['title'];
        $row[] = $person['PositionCategory']['title'];
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit User',
                            'title' => 'Edit ' . $person['Person']['full_name']
                        )
                    ),
                array(
                    'controller' => 'users',
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
                    'alt' => 'Add User',
                    'title' => 'Add User'
                )
            ),
            array(
                'action' => 'admin_edit'
            )
        );
    ?>
</div>