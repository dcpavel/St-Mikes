<?php
$url = urlencode($file);
$content = $this->Html->tag(
        'iframe',
        '',
        array(
            'src' => "http://docs.google.com/viewer?url=$url&embedded=true",
            'width' => '100%',
            'height' => '100%'
        )
    );

echo $content;
?>
