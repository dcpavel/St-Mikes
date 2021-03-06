<div class="search form">
    <?php
    echo $this->Form->create('Document');
    
    echo $this->Form->input('Search');
    echo $this->Form->input(
            'Category',
            array(
                'label' => 'Type',
                'empty' => 'All Types'
            )
        );
    echo $this->Form->input(
            'Filter',
            array(
                'type' => 'radio',
                'options' => array(
                    'all' => 'All',
                    'date' => 'Date',
                    'title' => 'Title',
                    'filename' => 'Filename'
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
        'Date',
        'Title',
        'Filename',
        'Type',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($documents as $document) {
        $row = array();
        
        $id = $document['Document']['id'];
        
        $image = 'Badge-tick.png';
        $title = 'Activate User';
        if ($document['Document']['status'] !== true) {
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
                    'controller' => 'documents',
                    'action' => 'status',
                    'admin' => true,
                    $id
                )
            );
        $row[] = date('F d, Y', strtotime($document['Document']['date']));
        $row[] = $document['Document']['title'];
        $row[] = $document['Document']['file'];
        
        $row[] = $document['DocumentCategory']['title'];
        
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit Document',
                            'title' => 'Edit ' . $document['Document']['title']
                        )
                    ),
                array(
                    'controller' => 'documents',
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
                    'alt' => 'Add Document',
                    'title' => 'Add Document'
                )
            ),
            array(
                'action' => 'edit',
                'admin' => true
            )
        );
    ?>
</div>