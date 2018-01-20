<?php
if (!empty(array_filter($value))) {
    $now = new \DateTime(implode('-', array_values($value)));
} else {
    $value = (new \DateTime('now'))->format('Y-m-d');
}

?>
<input class="form-control" type="text" <?php echo $view['form']->block($form, 'widget_attributes') ?><?php if (!empty($value) || is_numeric($value)): ?> value="<?php echo $view->escape($value) ?>"<?php endif ?> />