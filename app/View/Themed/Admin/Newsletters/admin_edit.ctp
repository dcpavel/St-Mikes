<?php
echo $this->Html->css(array('pepper-grinder/jquery-ui-1.8.17.custom'));
?>
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
                'controller' => 'newsletters',
                'action' => 'index',
                'admin' => true
            )
        );
    ?>
</div>
<div class="form">
    <?php
    echo $this->Session->flash();
    
    echo $this->Form->create('Newsletter', array('type' => 'file'));
    echo $this->Form->hidden('Newsletter.id');
    
    echo $this->Form->input('Newsletter.date', array('type' => 'text', 'class' => 'date'));
    
    echo $this->Form->input('Newsletter.title');
    
    if (!empty($this->request->data['Newsletter']['file'])) {
        echo $this->request->data['Newsletter']['file'];
    }
    echo $this->Form->input('Newsletter.filename', array('type' => 'file'));
    
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
<script type="text/javascript">
    $('input.date').datepicker({dateFormat: 'yy-mm-dd'});
</script>