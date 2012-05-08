<div class="search form">
    <?php
    echo $this->Form->create('Newsletter');
    
    echo $this->Form->input('Search');
    echo $this->Form->input(
            'Category',
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
        'Date',
        'Title',
        'Filename',
        'Created',
        'Edit'
    );
    
    $table = $this->Html->tableHeaders($headers);
    
    $cells = array();
    foreach ($newsletters as $newsletter) {
        $row = array();
        
        $id = $newsletter['Newsletter']['id'];
        
        $row[] = date('F d, Y', strtotime($newsletter['Newsletter']['date']));
        $row[] = $newsletter['Newsletter']['title'];
        $row[] = $newsletter['Newsletter']['file'];
        $row[] = date('H:i m-d-Y', strtotime($newsletter['Newsletter']['created']));
        $row[] = $this->Html->link(
                $this->Html->image(
                        'Pencil.png',
                        array(
                            'alt' => 'Edit Newsletter',
                            'title' => 'Edit ' . $newsletter['Newsletter']['title']
                        )
                    ),
                array(
                    'controller' => 'newsletters',
                    'action' => 'edit',
                    'uploader' => true,
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
                'action' => 'edit',
                'uploader' => true
            )
        );
    ?>
</div>