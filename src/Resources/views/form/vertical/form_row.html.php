<div class="form-group">
    <div class="col-sm-3">
        <?php echo $view['form']->label($form, $label) ?>
    </div>
    <div class="col-sm-9">
        <?php echo $view['form']->errors($form) ?>
        <?php echo $view['form']->widget($form) ?>
    </div>
</div>