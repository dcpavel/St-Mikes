<?php
if (!empty($detail['Vestry']['picture'])){
    $picture = 'Vestry/' . $detail['Vestry']['picture']; 
    echo $this->Html->image($picture, array('class' => 'headshot left'));
}
?>
<h1>
    <?php echo $detail['Vestry']['position'] ?>
</h1>
<h2>
    <?php echo $detail['Vestry']['name'] ?>
</h2>
<p class="description">
    <?php echo $detail['Vestry']['description'] ?>
</p>