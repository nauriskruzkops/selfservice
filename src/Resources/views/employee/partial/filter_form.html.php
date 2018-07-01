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

<div class="form-row">
    <div class="form-group mx-sm-1">
        <?= $formHelper->widget($form['search']) ?>
        <?= $formHelper->errors($form['search']) ?>
    </div>
    <div class="form-group mx-sm-1">
        <?= $formHelper->widget($form['department']) ?>
        <?= $formHelper->errors($form['department']) ?>
    </div>
    <div class="form-group mx-sm-1">
        <?= $formHelper->errors($form['type']) ?>
        <?= $formHelper->widget($form['type']) ?>
    </div>
    <div class="form-group mx-sm-1">
        <input class="btn btn-primary btn-sm" name="submit_search" value="search" type="submit">
    </div>
</div>

<?= $formHelper->end($form);?>

