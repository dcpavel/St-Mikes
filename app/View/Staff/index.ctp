<?php $this->set('title_for_layout', 'Staff Listing'); ?>
<h1>
    Staff Listing
</h1>
<hr />
<nav class="left list">
    <?php
    foreach ($staff as $id => &$member) {
        $member = $this->Html->link(
                $member,
                array('controller' => 'staff', 'action' => 'index', $id),
                array('class' => 'position', 'page' => $id)
            );
    }

    echo $this->Html->nestedList($staff);
    ?>
</nav>
<div class="description right">
    <?php echo $this->element('Staff/view'); ?>
</div>
<script type="text/javascript">
    $('.position').each(function () {
        var id = $(this).attr('page');
        $(this).click(function () {
            $.ajax({
                url: '/staff/view/' + id,
                success: function (html) {
                    $('.description').html(html);
                }
            });
            return false;
        })
    })
</script>