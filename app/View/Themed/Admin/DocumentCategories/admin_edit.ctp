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
    Return to Index
</div>
<div class="form">
    <?php
    echo $this->Session->flash();
    
    echo $this->Form->create('DocumentCategories', array('type' => 'file'));
    echo $this->Form->hidden('DocumentCategories.id');
    
    echo $this->Form->input('DocumentCategories.title');
    
    echo $this->Form->input(
            'status',
            array(
                'div' => true,
                'type' => 'radio',
                'options' => array(
                    1 => $this->Html->image('Badge-tick-gray.png'),
                    0 => $this->Html->image('Badge-multiply-gray.png')
                ),
                'default' => 1
            )
        );
    
    echo $this->Form->submit('Disquette.png');
    echo $this->Form->end();
    ?>
</div>