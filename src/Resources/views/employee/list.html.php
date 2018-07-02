<?php

use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var GlobalVariables $app
 * @var PhpEngine $view
 * @var \App\Entity\Employee $employee
 * @var \App\Entity\EmployeeDepartments $companyEmployee
 */
$view->extend('layout/layout.html.php');
?>

<div class="row">
    <div class="col">
        <h2>Employees</h2>
    </div>
    <div class="col">
        <div class="pull-right">
            <?= $view['actions']->render(
                new ControllerReference('App\\Controller\\Employee\\SearchController::filter',[
                    'request' => $app->getRequest()
                ])
            ) ?>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<hr>

<div id="employee_list_content">
    <?= $view['actions']->render(
        new ControllerReference('App\\Controller\\Employee\\SearchController::list',[
            'request' => $app->getRequest()
        ])
    ) ?>
</div>
