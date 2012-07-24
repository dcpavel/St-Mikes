<div class="search form">
    <?php
    echo $this->Form->create('Person');
    
    echo $this->Form->input(
            'Search',
            array(
                'label' => 'Search Name'
            )
        );
    echo $this->Form->input(
            'positionCategory',
            array(
                'empty' => 'All Groups'
            )
        );
    echo "&nbsp;";
    echo $this->Form->input(
            'position',
            array(
                'empty' => 'All Positions'
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
        $this->Paginator->sort('Person.status', 'Status'),
        $this->Paginator->sort('Person.full_name', 'Full Name'),
        'Position',
        'Group',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    debug($people);
    $cells = array();
    foreach ($people as $person) {
        $row = array();
        
        $id = $person['Person']['id'];
        
        $name = $person['Person']['full_name'];
        
        $image = 'Badge-tick.png';
        $title = "List $name";
        if ($person['Person']['status'] !== true) {
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
        $row[] = $person['Position'][0]['title'];
        $row[] = $person['Position'][0]['PositionCategory']['title'];
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit User',
                            'title' => 'Edit ' . $person['Person']['full_name']
                        )
                    ),
                array(
                    'controller' => 'people',
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
<?php
$this->Js->get('#PersonPositionCategory')->event(
        'change',
        $this->Js->request(
                array('controller' => 'positions', 'action' => 'get_positions', 'admin' => false),
                array(
                    'async' => true,
                    'update' => '#PersonPosition',
                    'dataExpression' => true,
                    'method' => 'post',
                    'data' => $this->Js->serializeForm(array(
                        'isForm' => true,
                        'inline' => true
                        )
                    )
                )
            )
    );
?>