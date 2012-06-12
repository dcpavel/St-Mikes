<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title_for_layout ?></title>
        <?php
        echo $this->fetch('meta');
        
        $google_key = Configure::read('GoogleApi.key');
        echo $this->Html->css(array('base'), null, array('inline' => true));
        echo $this->Html->script(array(
            'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',
            'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js',
            "http://maps.googleapis.com/maps/api/js?key=$google_key&sensor=false"
        ));
        ?>
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php echo $this->fetch('css'); ?>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <?php echo $this->element('Base/header'); ?>
            </header>
            <div id="content-wrapper">
                <div id="content">
                    <?php echo $this->fetch('content'); ?>
                </div>
                <footer>
                    <?php echo $this->element('Base/footer'); ?>
                </footer>
            </div>
        </div>
        <?php
        echo $this->element('sql_dump');
        echo $this->Js->writeBuffer();
        echo $this->fetch('script');
        ?>
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("<script src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'>"));
        </script>
        <script type="text/javascript">
            try {
            var pageTracker = _gat._getTracker("UA-9160527-1");
            pageTracker._trackPageview();
            } catch(err) {}
        </script>
    </body>
</html>
