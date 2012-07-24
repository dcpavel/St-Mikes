<?php
$options = array(
    'multiple' => true
);

if (preg_match('|admin\/people$|', $referer)) {
    $options['empty'] = 'All Positions';
}
echo $this->Form->input('Position', $options);
?>