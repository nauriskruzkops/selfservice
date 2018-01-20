<div class="form-group">
    <?php echo $view['form']->label($form, $label) ?>
    <?php echo $view['form']->errors($form) ?>
    <?php echo $view['form']->widget($form) ?>
</div>