<div class="search form">
    <?php
    echo $this->Form->create('User');
    
    echo $this->Form->input('Search');
    echo $this->Form->input(
            'Category',
            array(
                'type' => 'radio',
                'options' => array(
                    'all' => 'All',
                    'username' => 'Username',
                    'role' => 'Role'
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
        'Username',
        'Role',
        'Created',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($users as $user) {
        $row = array();
        
        $id = $user['User']['id'];
        
        $image = 'Badge-tick.png';
        $title = 'Activate User';
        if ($user['User']['status'] !== true) {
            $image = 'Badge-multiply.png';
            $title = 'Dectivate User';
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
        $row[] = $user['User']['username'];
        $row[] = $user['User']['role'];
        $row[] = date('H:i m-d-Y', strtotime($user['User']['created']));
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit User',
                            'title' => 'Edit ' . $user['User']['username']
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