<nav class="no-js">
    <ul class="ribbon">
        <li class="purple">
            <?php
            echo $this->Html->link('Users', array(
                    'controller' => 'users',
                    'action' => 'index',
                    'admin' => true
                ));
            echo $this->Html->nestedList(array(
                $this->Html->link('Staff', array(
                        'controller' => 'staff',
                        'action' => 'index',
                        'admin' => true
                    )),
            ));
            ?>
        </li>
        <li class="red">
            <?php
            echo $this->Html->link('Newsletter', array(
                    'controller' => 'newsletters',
                    'action' => 'index',
                    'admin' => true
                ));
            echo $this->Html->nestedList(array(
                
            ));
            ?>
        </li>
        <li class="blue">
            <?php
            echo $this->Html->link('Charities', '');
            echo $this->Html->nestedList(array(
                
            ));
            ?>
        </li>
        <li class="green">
            <?php
            echo $this->Html->link('Calendar', array(
                    'controller' => 'calendars',
                    'action' => 'index',
                    'admin' => true
                ));
            echo $this->Html->nestedList(array(
                
            ));
            ?>
        </li>
    </ul>
</nav>