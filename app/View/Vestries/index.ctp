<?php $this->set('title_for_layout', 'Vestry Listing'); ?>
<h1>
    Vestry Listing
</h1>
<hr />
<nav class="left list">
    <?php
    foreach ($members as $id => &$member) {
        $member = $this->Html->link(
                $member,
                array('controller' => 'vestries', 'action' => 'index', $id),
                array('class' => 'position', 'page' => $id)
            );
    }

    echo $this->Html->nestedList($members);
    ?>
</nav>
<div class="description right">
    <?php echo $this->element('Vestries/view'); ?>
</div>
<script type="text/javascript">
    $('.position').each(function () {
        var id = $(this).attr('page');
        $(this).click(function () {
            $.ajax({
                url: '/vestries/view/' + id,
                success: function (html) {
                    $('.description').html(html);
                }
            });
            return false;
        })
    })
</script>