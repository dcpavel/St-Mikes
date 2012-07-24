<div class="search form">
    <?php
    echo $this->Form->create('DocumentCategory');
    
    echo $this->Form->input('Search', array('label' => 'Search Title'));
    
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
        'Title',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($categories as $category) {
        $row = array();
        
        $id = $category['DocumentCategory']['id'];
        
        $image = 'Badge-tick.png';
        $title = 'Activate User';
        if ($category['DocumentCategory']['status'] !== true) {
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
                    'controller' => 'document_categories',
                    'action' => 'status',
                    'admin' => true,
                    $id
                )
            );
        
        $row[] = $category['DocumentCategory']['title'];
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit Newsletter',
                            'title' => 'Edit ' . $category['DocumentCategory']['title']
                        )
                    ),
                array(
                    'controller' => 'document_categories',
                    'action' => 'edit',
                    'admin' => true,
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
                    'alt' => 'Add Document Type',
                    'title' => 'Add Document Type'
                )
            ),
            array(
                'action' => 'edit',
                'admin' => true
            )
        );
    ?>
</div>