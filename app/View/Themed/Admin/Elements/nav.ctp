<nav class="no-js">
    <ul class="ribbon">
        <li class="purple">
            <?php
            echo $this->Html->link(
                    'Users',
                    array(
                        'controller' => 'users',
                        'action' => 'index',
                        'admin' => true
                        )
                    );
            ?>
        </li>
        <li class="red">
            <?php
            echo $this->Html->link(
                    'Documents',
                    array(
                        'controller' => 'documents',
                        'action' => 'index',
                        'admin' => true
                    )
                );
            ?>
        </li>
        <li class="blue">
            <?php
            echo $this->Html->link(
                    'People',
                    array(
                        'controller' => 'people',
                        'action' => 'index',
                        'admin' => true
                    )
                );
            echo $this->Html->nestedList(array(
                $this->Html->link(
                        'Positions',
                        array(
                            'controller' => 'positions',
                            'action' => 'index',
                            'admin' => true
                        )
                    ),
                $this->Html->link(
                        'Groups',
                        array(
                            'controller' => 'position_categories',
                            'action' => 'index',
                            'admin' => true
                        )
                    )
            ));
            ?>
        </li>
        <li class="green">
            <?php
            echo $this->Html->link(
                    'Calendar',
                    array(
                        'controller' => 'calendars',
                        'action' => 'index',
                        'admin' => true
                    ));
            ?>
        </li>
    </ul>
</nav>