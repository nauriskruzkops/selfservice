<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */
$view->extend('department/layout.html.php');

$view['slots']->set('department', $department ?? null);

?>
<?= $view['actions']->render(
    new ControllerReference('App\\Controller\\Calendar\\LayoutController::calendar', [
        'date' => new \DateTime('now'),
        'getEmployeesBy' => $department,
    ])
) ?>