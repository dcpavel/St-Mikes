<div class="search form">
    <?php
    $no_search = array(
        'id', 'created', 'modified'
    );
    
    $searchFields = array_diff($scaffoldFields, $no_search);
    array_unshift($searchFields, 'all');
    
    $dropDownFields = array();
    foreach ($searchFields as $_key => $_field) {
        $isKey = false;
        
        if (!empty($associations['belongsTo'])) {
            foreach ($associations['belongsTo'] as $_alias => $_details) {
                if ($_field === $_details['foreignKey']) {
                    $isKey = true;
                    array_push($dropDownFields, $_details['foreignKey']);
                    break;
                }
            }
        }
        
        if ($isKey !== true) {
            $searchFields[$_field] = ucfirst($_field);
        }
        
        unset($searchFields[$_key]);
    }
    
    echo $this->Form->create();
    
    echo $this->Form->input('Search');
    echo $this->Form->input(
            'Type',
            array(
                'type' => 'radio',
                'options' => $searchFields,
                'default' => 'all'
            )
        );
    
    if (!empty($dropDownFields)) {
        foreach ($dropDownFields as $_field) {
            echo $this->Form->input($_field);
        }
    }
    
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
        'Date',
        'Title',
        'Filename',
        'Created',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($pluralVar as $tableRow) {
        $row = array();
        
        $id = $tableRow[$this->modelClass]['id'];
        
        $image = 'Badge-tick.png';
        $title = 'Activate User';
        if ($tableRow[$this->modelClass]['status'] !== true) {
            $image = 'Badge-multiply.png';
            $title = 'Dectivate Newsletter';
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
                    'action' => 'status',
                    'admin' => true,
                    $id
                )
            );
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit Newsletter',
                            'title' => 'Edit ' . $tableRow['Newsletter']['title']
                        )
                    ),
                array(
                    'controller' => 'newsletters',
                    'action' => 'edit',
                    'admin' => true,
                    $id
                )
            );
        
        array_push($cells, $row);
    }
    
    $table .= $this->Html->tableCells($cells);
    
    echo $this->Html->tag('table', $table);
    
    echo 'PAGINATION';
    
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
                'action' => 'edit',
                'admin' => true
            )
        );
    ?>
</div>