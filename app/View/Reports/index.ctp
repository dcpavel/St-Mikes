<?php
$this->Html->css(array('pages/reports'));
$this->set('title_for_layout', 'Minutes and Reports');
?>
<nav class="types">
    <ul>
        <li class="<?php echo ($type == 'minutes') ? 'selected' : null ?>">
            <?php
            echo $this->Html->link('Minutes', '');
            ?>
        </li>
        <li class="divider"></li>
        <li class="<?php echo ($type == 'reports') ? 'selected' : null ?>">
            <?php
            echo $this->Html->link('Reports', '');
            ?>
        </li>
    </ul>
</nav>
<nav class="left list">
    <?php
    if (!empty($documents)) {
        echo $this->Form->create('Report');

        echo $this->Form->input('document', array(
                'label' => ucfirst($type),
                'id' => 'documents'
            ));

        echo $this->Form->submit(
            'Arrow_right.png',
            array(
                'alt' => "Search",
                'class' => 'add_button',
                'title' => 'Search'
            ));
        echo $this->Form->end();
    }
    ?>
</nav>
<div class="description right">
    This page contains links to documents that require Adobe Reader, a free program.
    <br /><br />
    To install Adobe Reader, click the following link and follow the download instructions:
    <br /><br />
    <?php
    echo $this->Html->link(
            $this->Html->image('Adobe_reader.png'),
            'http://get.adobe.com/reader/',
            array(
                'target' => '_blank'
            )
        );
    ?>
    <br /><br />
    <p>
        <?php
        $download_class = 'hidden';
        if (is_numeric($id) && $id > 0) {
            $download_class = '';
        }
        echo $this->Html->link(
                'Download PDF File' . $this->Html->image('Arrow_down.png', array('width' => '20')),
                array('action' => 'download', $id),
                array(
                    'id' => 'download',
                    'class' => $download_class,
                    'target' => '_blank'
                )
            );
        ?>
    </p>
</div>
<div class="clear"></div>
<?php
$div = 'documents';
$content = '';
if (is_numeric($id) && $id > 0) {
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
} else {
    $div .= ' hidden';
}
echo $this->Html->div($div, $content);
?>