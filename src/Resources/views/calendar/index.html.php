<?php

use Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper
 * @var Symfony\Component\Form\FormView $form
 */
$formHelper = $view['form'];

$view->extend('layout/layout.html.php');
?>

<h2>Calendar</h2>

<?= $view['actions']->render(
    new ControllerReference('App\\Controller\\Calendar\\LayoutController::calendar',[
            'date' => new \DateTime('now')
    ])
) ?>

<div class="col-md-6">
    <h3>Add vocation</h3>
    <?= $formHelper->start($form);?>
    <div class="form-group row">
        <div class="col-sm-3"><?=  $formHelper->label($form['type']) ?></div>
        <div class="col-sm-9">
            <?= $formHelper->errors($form['type']) ?>
            <?= $formHelper->widget($form['type']) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3"><?= $formHelper->label($form['employee']) ?></div>
        <div class="col-sm-9">
            <?= $formHelper->errors($form['employee']) ?>
            <?= $formHelper->widget($form['employee']) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <label class="col-form-label" for="form_startDate">Period</label>
        </div>
        <div class="col-sm-9">
            <div class="form-row">
                <div class="col">
                    <?= $formHelper->widget($form['startDate']) ?>
                </div>
                <div class="col">
                    <?= $formHelper->widget($form['endDate']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add vocation</button>
    </div>
    <?= $formHelper->end($form);?>
</div>
