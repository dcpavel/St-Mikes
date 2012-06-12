<?php
    echo $this->Html->link(
            $this->Html->image(
                    'Arrow_left.png',
                    array(
                        'alt' => 'Return to Calendar',
                        'title' => 'Return to Calendar'
                    )
                ),
            array(
                'controller' => 'vestries',
                'action' => 'index',
                'admin' => true
            )
        );
    ?>
<div class="edit form">
    <?php
    echo $this->Session->flash();
    
    echo $this->Form->create('Vestry', array('type' => 'file'));
    echo $this->Form->hidden('id');
    
    echo $this->Form->input('position', array('label' => 'Position'));
    echo $this->Form->input('name');
    
    if (!empty($this->data['Vestry']['picture'])) {
        echo $this->Html->image(
                'Staff/' . $this->data['Vestry']['picture'],
                array(
                    'class' => 'headshot'
                )
            );
    }
    echo $this->Form->input('file', array('type' => 'file', 'label' => 'Picture'));
    
    echo $this->Form->input('description');
    
    echo $this->Form->input('phone');
    
    echo $this->Form->input('email', array('type' => 'email'));
    
    echo $this->Form->input(
            'status',
            array(
                'div' => true,
                'type' => 'radio',
                'options' => array(
                    1 => $this->Html->image('Badge-tick.png'),
                    0 => $this->Html->image('Badge-multiply.png')
                ),
                'default' => 1
            )
        );
    
    echo $this->Form->submit('Disquette.png');
    echo $this->Form->end();
    ?>
</div>