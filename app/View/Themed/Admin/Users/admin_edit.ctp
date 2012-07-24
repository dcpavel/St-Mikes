<div class="back">
    <?php
    echo $this->Html->link(
            $this->Html->image(
                    'Arrow_left.png',
                    array(
                        'alt' => 'Return to Users',
                        'title' => 'Return to Users'
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
    
    $enable_class = 'enable active';
    $disable_class = 'disable';
    if (!empty($this->request->data['User']['status']) && !$this->request->data['User']['status']) {
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