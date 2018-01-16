<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/layout.html.php');

?>

<h2>Calendar</h2>

<?php echo $view['actions']->render(
    new ControllerReference('App\\Controller\\Calendar\\LayoutController::calendar',[
            'date' => new \DateTime('now')
    ])
) ?>

<?= $view['form']->start($form) ?>

<?= $view['form']->end($form) ?>
