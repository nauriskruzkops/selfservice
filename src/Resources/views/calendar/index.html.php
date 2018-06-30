<?php

use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var GlobalVariables $app
 * @var PhpEngine|array $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper
 * @var Symfony\Component\Form\FormView $form
 */
$formHelper = $view['form'];
$view['slots']->set('pageTitle', 'Leave days overview');
$view['slots']->set('pageIcon', 'fa fa-building-o');

$view->extend('layout/layout.html.php');
$startDate = $startDate ?? new \DateTime('now');
$employees = $employees ?? null;
?>

<h2>Calendar</h2>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <?= $view['actions']->render(
            new ControllerReference('App\\Controller\\Employee\\SearchController::filter',[
                    'request' => $app->getRequest()
            ])
        ) ?>
    </div>
</div>

<hr>

<?= $view['actions']->render(
    new ControllerReference('App\\Controller\\Calendar\\LayoutController::calendar',[
            'startDate' => $startDate,
            'employees' => $employees
    ])
) ?>
