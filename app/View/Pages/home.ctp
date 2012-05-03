<?php
echo $this->Html->css(array('pages/home'));
?>
<div class="banner">
    <div>
        <img src="" alt="" class="back" />
        First
    </div>
    <div>
        <img src="" alt="" class="back" />
        Second
    </div>
    <div>
        <img src="" alt="" class="back" />
        Third
    </div>
</div>
<div class="view view-first">
    <img src="" alt="" />
    <br />blah
    <div class="mask">
        <h1>Faith</h1>
        <p></p>
    </div>
</div>
<div class="view view-first">
    <img src="" alt="" />
    <div class="mask">
        <h1>Family</h1>
        <p></p>
    </div>
</div>
<div class="view view-first">
    <img src="" alt="" />
    <div class="mask">
        <h1>Friends</h1>
        <p></p>
    </div>
</div><div class="view view-first">
    <img src="" alt="" />
    <div class="mask">
        <h1>Future</h1>
        <p></p>
    </div>
</div>
<?php
echo $this->Html->script(array('jquery.cycle.lite'));
?>
<script type="text/javascript">
    $(".banner").cycle({
        fx: 'fade',
        speed: 500,
        timeout: 2000,
        next: '.banner',
        pause: 1
    });
</script>