<div class="back">
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
                'controller' => 'users',
                'action' => 'index',
                'admin' => true
            )
        );
    ?>
</div>
<div class="form user">
    <?php
    echo $this->Session->flash();
    
    echo $this->Form->create('User');
    echo $this->Form->hidden('id');
    
    echo $this->Form->input('username');
    echo $this->Html->para('disclaimer', __('This is the name the user will use to log in'));
    
    echo $this->Form->input('password');
    echo $this->Html->para('disclaimer', __('Leave this field blank to leave the password unchanged'));
    
    echo $this->Form->input('role', array('options' => $roles));
    
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