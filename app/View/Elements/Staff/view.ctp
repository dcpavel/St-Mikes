<?php
if (!empty($detail['Staff']['picture'])){
    $picture = 'Staff/' . $detail['Staff']['picture']; 
    echo $this->Html->image($picture, array('class' => 'headshot left'));
}
?>
<h1>
    <?php echo $detail['Staff']['position'] ?>
</h1>
<h2>
    <?php echo $detail['Staff']['name'] ?>
</h2>
<p class="description">
    <?php echo $detail['Staff']['description'] ?>
</p>