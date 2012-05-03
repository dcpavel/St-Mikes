<?php $this->set('title_for_layout', 'For the Love of Mike Newsletters'); ?>
<h1>
    For the Love of Mike Newsletters
</h1>
<hr />
<nav class="left list">
    <label>
        Current Month
    </label>
    <br />
    <?php
    $link_id = key($newsletters);
    $label = array_shift($newsletters);
    echo $this->Html->link(
            $label . '<br />' . $this->Html->image('Arrow_right.png', array('width' => 30)),
            array($link_id),
            array('id' => 'current', 'page' => $link_id)
        );
    ?>
    <br /><br />
    <?php
    if (!empty($newsletters)) {
        echo $this->Form->create('Newsletter');

        echo $this->Form->input('newsletter', array(
                'label' => 'All Months',
                'id' => 'previous'
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
$div = 'newsletter';
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
<script type="text/javascript">
    $('#current').click(function () {
        var id = $(this).attr('page');
        $('#download').attr('href', '/newsletters/download/' + id);
        $('#download').show();
        
        $.ajax({
            url: '/newsletters/view/' + id,
            success: function (data) {
                $('.newsletter').html(data);
                $('.newsletter').show();
            }
        });
        return false;
    });
    
    $('#submit').hide();
    
    $('#previous').change(function () {
        var id = $(this).val();
        $('#download').attr('href', '/newsletters/download/' + id);
        $('#download').show();
        
        $.ajax({
            url: '/newsletters/view/' + id,
            success: function (data) {
                $('.newsletter').html(data);
            }
        });
    });
</script>