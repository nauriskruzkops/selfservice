<input class="form-control" date-type="datepicker" type="text" <?php echo $view['form']->block($form, 'widget_attributes') ?><?php if (!empty($value) || is_numeric($value)): ?> value="<?php echo $view->escape($value) ?>"<?php endif ?> />
<script type="text/javascript">
    $(function () {
        $('input#<?= $id?>').datetimepicker({
            format: 'YYYY-MM-DD',
            showClear : true,
        });
    })
</script>