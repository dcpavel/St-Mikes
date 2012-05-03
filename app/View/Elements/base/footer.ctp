<div id="map">
    <noscript>
        <?php
        $static_map = sprintf(
            'http://maps.googleapis.com/maps/api/staticmap?center=%s&zoom=%d&size=%s&markers=%s&sensor=false',
            '33.609,-117.859',
            15,
            '200x150',
            '|33.609,-117.859'
        );
        echo $this->Html->image($static_map);
        echo $this->Html->link(
            'Get Directions',
            sprintf('http://maps.google.com/maps?daddr=3233+Pacific+View+Drive+Corona+del+Mar,+CA+92625'),
            array('target' => '_blank')
        );
        ?>
    </noscript>
    <div id="map_canvas"></div>
</div>
<div id="address" class="vcard">
    <div class="adr">
        <h1>Our Address</h1>
        <div class="fn org">Saint Michael's and All Angels</div>
        <div class="street-address">3233 Pacific View Drive</div>
        <span class="locality">Corona del Mar</span>,
        <span class="region" title="California">CA</span>
        <span class="postal-code">92625</span>
    </div>
    <span class="tel">(949) 644-0463</span>
</div>
<div class="misc">
    <div class="social">
        <?php
        echo $this->Html->link(
                $this->Html->image('Facebook.png', array(
                    'width' => 48
                )),
                'http://www.facebook.com/SMAACDM',
                array(
                    'target' => '_blank'
                )
            );
        echo $this->Html->link(
                $this->Html->image('Episcopal-shield.png', array(
                    'height' => 48
                )),
                'http://ecusa.anglican.org',
                array(
                    'target' => '_blank'
                )        
            );
        ?>
    </div>
    <div class="disclaimer">
        
    </div>
</div>
<nav>
    <ul>
        <li>
            About Us
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    'Contact Us',
                    array(
                        'controller' => 'pages',
                        'action' => 'contact'
                    )
                );
            ?>
        </li>
        <li>
            <?php
            if ($this->Session->check('Auth.User')) {
                echo $this->Html->link(
                        'Logout',
                        array(
                            'controller' => 'users',
                            'action' => 'logout',
                            'admin' => false
                        )
                    );
            } else {
                echo $this->Html->link(
                        'Login',
                        array(
                            'controller' => 'users',
                            'action' => 'login'
                        )
                    );
            }
            ?>
        </li>
    </ul>
</nav>