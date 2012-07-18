<div class="back">
    <?php
    echo $this->Html->link(
            $this->Html->image(
                    'Arrow_left.png',
                    array(
                        'alt' => 'Return to People',
                        'title' => 'Return to People'
                    )
                ),
            array(
                'controller' => 'people',
                'action' => 'index',
                'admin' => true
            )
        );
    ?>
</div>
<div class="form user">
    <?php
    echo $this->Session->flash();
    
    echo $this->Form->create('Person');
    echo $this->Form->hidden('id');
    
    echo $this->Form->input('full_name');
    
    echo $this->Form->input(
            'positionCategory',
            array(
                'empty' => 'All Categories'
            )
        );
    
    echo $this->Form->input(
            'Position',
            array(
                'div' => array('id' => 'PersonPosition')
            )
        );
    
    echo $this->Form->input('description');
    
    echo $this->Form->input('phone');
    
    echo $this->Form->input('email');
    
    $enable_class = 'enable active';
    $disable_class = 'disable';
    if (!empty($this->request->data['Person']['status']) && !$this->request->data['Person']['status']) {
        $enable_class = 'enable';
        $disable_class = 'disable active';
    }
    
    echo $this->Form->input(
            'status',
            array(
                'div' => true,
                'type' => 'radio',
                'options' => array(
                    1 => $this->Html->image('Blank.png', array('class' => $enable_class)),
                    0 => $this->Html->image('Blank.png', array('class' => $disable_class))
                ),
                'default' => 1
            )
        );
    
    echo $this->Form->submit('Disquette.png');
    echo $this->Form->end();
    ?>
</div>
<?php
echo $this->Html->script('form');

$this->Js->get('#PersonPositionCategory')->event(
        'change',
        $this->Js->request(
                array('controller' => 'positions', 'action' => 'get_positions', 'admin' => false),
                array(
                    'async' => true,
                    'update' => '#PersonPosition',
                    'dataExpression' => true,
                    'method' => 'post',
                    'data' => $this->Js->serializeForm(array(
                        'isForm' => true,
                        'inline' => true
                        )
                    )
                )
            )
    );
?>