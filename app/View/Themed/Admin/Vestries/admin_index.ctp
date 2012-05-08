<div class="search form">
    <?php
    echo $this->Form->create('Vestry');
    
    echo $this->Form->input('Search');
    echo $this->Form->input(
            'Category',
            array(
                'type' => 'radio',
                'options' => array(
                    'all' => 'All',
                    'position' => 'Position',
                    'name' => 'Name',
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
    $headers = array(
        'Status',
        'Position',
        'Name',
        'Created',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($members as $member) {
        $row = array();
        
        $id = $member['Vestry']['id'];
        
        $image = 'Badge-tick.png';
        $title = 'Activate Position';
        if ($member['Vestry']['status'] != true) {
            $image = 'Badge-multiply.png';
            $title = 'Deactivate Position';
        }
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        $image,
                        array(
                            'alt' => $title,
                            'title' => $title
                        )
                    ),
                array(
                    'controller' => 'vestries',
                    'action' => 'status',
                    'admin' => true,
                    $id
                    )
            );
        $row[] = $member['Vestry']['position'];
        $row[] = $member['Vestry']['name'];
        $row[] = date('H:i m-d-Y', strtotime($member['Vestry']['created']));
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit Position',
                            'title' => 'Edit ' . $member['Vestry']['position']
                        )
                    ),
                array(
                    'controller' => 'vestries',
                    'action' => 'edit',
                    'admin' => true,
                    $id)
            );
        
        array_push($cells, $row);
    }
    
    $table .= $this->Html->tableCells($cells);
    
    echo $this->Html->tag('table', $table);
    
    echo $this->Html->link(
            $this->Html->image(
                    'Orb_plus.png',
                    array(
                        'alt' => 'Add Position',
                        'title' => 'Add Position',
                        'class' => 'add_button'
                    )
                ),
            array(
                'controller' => 'vestries',
                'action' => 'edit',
                'admin' => true
                )
        );
    ?>
</div>