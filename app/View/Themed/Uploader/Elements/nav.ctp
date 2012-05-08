<nav class="no-js">
    <ul class="ribbon">
        <li class="purple">
            <?php
            echo $this->Html->link(
                    'Homilies and Sermons',
                    array(
                        'controller' => 'homilies',
                        'action' => 'index',
                        'uploader' => true
                    )
                );
            echo $this->Html->nestedList(array(
            ));
            ?>
        </li>
        <li class="red">
            <?php
            echo $this->Html->link(
                    'Newsletters',
                    array(
                        'controller' => 'newsletters',
                        'action' => 'index',
                        'uploader' => true
                    )
                );
            echo $this->Html->nestedList(array(
            ));
            ?>
        </li>
        <li class="blue">
            <?php
            echo $this->Html->link(
                    'Reports',
                    array(
                        'controller' => 'reports',
                        'action' => 'index',
                        'uploader' => true
                    )
                );
            echo $this->Html->nestedList(array(
            ));
            ?>
        </li>
        <li class="green">
            <?php
            echo $this->Html->link(
                    'Finances',
                    array(
                        'controller' => 'finances',
                        'action' => 'index',
                        'uploader' => true
                    ));
            echo $this->Html->nestedList(array(
            ));
            ?>
        </li>
    </ul>
</nav>