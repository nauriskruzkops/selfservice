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
$view['slots']->set('pageTitle', 'Leave days overview');
$view['slots']->set('pageIcon', 'fa fa-building-o');

$view->extend('layout/layout.html.php');
?>

<h2>Calendar</h2>

<?= $view['actions']->render(
    new ControllerReference('App\\Controller\\Calendar\\LayoutController::calendar',[
            'date' => new \DateTime('now')
    ])
) ?>
