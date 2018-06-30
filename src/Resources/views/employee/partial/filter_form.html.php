<?php
/**
 * @var Symfony\Bundle\FrameworkBundle\Templating\PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper
 * @var Symfony\Component\Form\FormView $form
 */

$form  = $form ?? null;
$formHelper = $view['form'];
?>
<?= $formHelper->start($form);?>
<div class="form-row align-items-center">
    <div class="col-sm-3 my-1">
        <div class="form-group">
            <?= $formHelper->widget($form['department']) ?>
            <?= $formHelper->errors($form['department']) ?>
        </div>
    </div>
    <div class="col-sm-3 my-1">
        <div class="form-group">
            <?= $formHelper->errors($form['type']) ?>
            <?= $formHelper->widget($form['type']) ?>
        </div>
    </div>
    <div class="col-sm-3 my-1">
        <div class="form-group">
            <input class="btn btn-primary" name="search" value="search" type="submit">
        </div>
    </div>
</div>
<?= $formHelper->end($form);?>

