<nav class="no-js">
    <ul class="ribbon">
        <li class="purple">
            <?php
            echo $this->Html->link('About Saint Michael & All Angels', array('controller' => 'newsletters', 'action' => 'index'));
            echo $this->Html->nestedList(array(
                $this->Html->link('Staff', array('controller' => 'staff', 'action' => 'index')), 
                $this->Html->link('Vestry', array('controller' => 'vestries', 'action' => 'index')),
                $this->Html->link('Newsletter', array('controller' => 'newsletters', 'action' => 'index')),
                $this->Html->link('Minutes and Reports', array('controller' => 'reports', 'action' => 'index')),
                $this->Html->link('Contact Us', '/pages/contact'),
                $this->Html->link('Welcome', '/pages/welcome')
            ));
            ?>
        </li>
        <li class="red">
            <?php
            echo $this->Html->link('Worship', array('controller' => 'services', 'action' => 'index'));
            echo $this->Html->nestedList(array(
                $this->Html->link('Music', array('controller' => 'choirs', 'action' => 'index')),
                $this->Html->link('Sunday Worship', array('controller' => 'services', 'action' => 'index', 'sunday')),
                $this->Html->link('Weekday Worship', array('controller' => 'services', 'action' => 'index')),
                $this->Html->link('Special Holy Days', array('controller' => 'holidays', 'action' => 'index')),
                $this->Html->link('Opportunities to Participate', array('controller' => 'opportunities', 'action' => 'index')),
                $this->Html->link('Homilies and Sermons', array('controller' => 'sermons', 'action' => 'index'))
            ));
            ?>
        </li>
        <li class="blue">
            <?php
            echo $this->Html->link('Ministries', array('controller' => 'ministries', 'action' => 'index'));
            echo $this->Html->nestedList(array(
                $this->Html->link('Christian Education', array('controller' => 'classes', 'action' => 'index')), 
                $this->Html->link('Missions', array('controller' => 'missions', 'action' => 'index')),
                $this->Html->link('Fellowship', array('controller' => 'fellowships', 'action' => 'index')),               
                $this->Html->link('Communication', array('controller' => 'libraries', 'action' => 'index')),
                $this->Html->link('Buildings and Grounds', array('controller' => 'grounds', 'action' => 'index')),
                $this->Html->link('Evangelism', array('controller' => 'evangalisms', 'action' => 'index')),
                $this->Html->link('Stewardship and Finances', array('controller' => 'finances', 'action' => 'index'))
            ));
            ?>
        </li>
        <li class="green">
            <?php
            echo $this->Html->link(
                    'Schedules and Links',
                    array(
                        'controller' => 'calendars',
                        'action' => 'index'
                    ));
            echo $this->Html->nestedList(array(
                $this->Html->link('Worship Schedules', array('controller' => 'services', 'action' => 'index')),
                $this->Html->link('Events', array('controller' => 'calendars', 'action' => 'index')),
                $this->Html->link('Episcopal Links', ''),
            ));
            ?>
        </li>
    </ul>
</nav>