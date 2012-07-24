<?php
echo $this->Html->css(array('pepper-grinder/jquery-ui-1.8.21.custom'));
?>
<div class="back">
    <?php
    echo $this->Html->link(
            $this->Html->image(
                    'Arrow_left.png',
                    array(
                        'alt' => 'Return to Documents',
                        'title' => 'Return to Documents'
                    )
                ),
            array(
                'controller' => 'documents',
                'action' => 'index',
                'admin' => true
            )
        );
    ?>
</div>
<div class="form">
    <?php
    echo $this->Session->flash();
    
    echo $this->Form->create('Document', array('type' => 'file'));
    echo $this->Form->hidden('Document.id');
    
    echo $this->Form->input(
            'Document.date',
            array(
                'type' => 'text',
                'class' => 'date'
            )
        );
    
    echo $this->Form->input('Document.title');
    
    echo $this->Form->input(
            'document_category_id',
            array(
                'label' => 'Type'
            )
        );
    
    echo $this->Html->div('clear', '&nbsp;');
    
    if (!empty($this->request->data['Document']['file'])) {
        echo $this->request->data['Document']['file'];
    }
    echo $this->Form->input('Document.filename', array('type' => 'file'));
    
    $enable_class = 'enable active';
    $disable_class = 'disable';
    if (!empty($this->request->data['Document']['status']) && !$this->request->data['Document']['status']) {
        $enable_class = 'enable';
        $disable_class = 'disable active';
    }
    
    echo $this->Form->input(
            'status',
            array(
                'div' => true,
                'type' => 'radio',
                'options' => array(
                    1 => $this->Html->image(
                            'Blank.png',
                            array(
                                'class' => $enable_class,
                                'title' => 'Active',
                                'alt' => 'Active'
                            )
                        ),
                    0 => $this->Html->image(
                            'Blank.png',
                            array(
                                'class' => $disable_class,
                                'title' => 'Inactive',
                                'alt' => 'Inactive'
                            )
                        )
                ),
                'default' => 1
            )
        );
    
    echo $this->Form->submit(
            'Disquette.png',
            array(
                'title' => 'Save',
                'alt' => 'Save'
            )
        );
    
    echo $this->Form->end();
    ?>
</div>
<?php
echo $this->Html->script(array('form'));
?>