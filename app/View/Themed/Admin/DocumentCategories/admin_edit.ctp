<?php
$this->set('title_for_layout', 'Admin :: Edit Document Categories')
?>
<div class="back">
    <?php
    echo $this->Html->link(
            $this->Html->image(
                    'Arrow_left.png',
                    array(
                        'alt' => 'Return to Index',
                        'title' => 'Return to Index'
                    )
                ),
            array(
                'controller' => 'document_categories',
                'action' => 'index',
                'admin' => true
            )
        );
    ?>
</div>
<div class="form">
    <?php
    echo $this->Session->flash();
    
    echo $this->Form->create('DocumentCategory', array('type' => 'file'));
    echo $this->Form->hidden('DocumentCategory.id');
    
    echo $this->Form->input('DocumentCategory.title');
    
    $enable_class = 'enable active';
    $disable_class = 'disable';
    if (!empty($this->request->data['DocumentCategory']['status']) && !$this->request->data['DocumentCategory']['status']) {
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
echo $this->Html->script('form');
?>