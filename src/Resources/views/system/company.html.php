<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 * @var \App\Entity\CompanyEmployees $employee
 */
$view->extend('layout/layout.html.php');

?><div class="site-header">
    <h1>System : Company : <?= $company->getTitle()?></h1>
    <hr>
</div>

<div class="row">
    <div class="col-md-6">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\System\\CompanyController::employees',['company' => $company])
        ) ?>
    </div>
</div>

