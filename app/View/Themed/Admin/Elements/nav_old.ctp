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
            echo $this->Html->nestedList(array(
                $this->Html->link(
                        'Clergy',
                        array(
                            'controller' => 'staff',
                            'action' => 'index',
                            'admin' => true
                            )
                        ), 
                $this->Html->link(
                        'Vestry', array(
                            'controller' => 'vestries',
                            'action' => 'index',
                            'admin' => true
                            )
                        )
            ));
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
            echo $this->Html->nestedList(array(
                $this->Html->link(
                        'Document Categories', array(
                            'controller' => 'document_categories',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Stewardship and Finances',
                        array(
                            'controller' => 'finances',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Homilies and Sermons',
                        array(
                            'controller' => 'sermons',
                            'action' => 'index'
                            )
                        ),
                $this->Html->link(
                        'Music',
                        array(
                            'controller' => 'choirs',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Christian Education',
                        array(
                            'controller' => 'lessons',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
            ));
            ?>
        </li>
        <li class="blue">
            <?php
            echo $this->Html->link(
                    'Ministries',
                    array(
                        'controller' => 'ministries',
                        'action' => 'index',
                        'admin' => true
                    )
                );
            echo $this->Html->nestedList(array(
                $this->Html->link(
                        'Opportunities to Participate',
                        array(
                            'controller' => 'opportunities',
                            'action' => 'index'
                            )
                        ),
                $this->Html->link(
                        'Communication',
                        array(
                            'controller' => 'libraries',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Buildings and Grounds',
                        array(
                            'controller' => 'grounds',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Evangelism',
                        array(
                            'controller' => 'evangalisms',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
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
            echo $this->Html->nestedList(array(
                $this->Html->link(
                        'Schedules',
                        array(
                            'controller' => 'services',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Special Holy Days',
                        array(
                            'controller' => 'holidays',
                            'action' => 'index'
                            )
                        ),
                $this->Html->link(
                        'Episcopal Links',
                        array(
                            'controller' => 'links',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Missions',
                        array(
                            'controller' => 'missions',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),
                $this->Html->link(
                        'Fellowship',
                        array(
                            'controller' => 'fellowships',
                            'action' => 'index',
                            'admin' => true
                            )
                        ),  
            ));
            ?>
        </li>
    </ul>
</nav>