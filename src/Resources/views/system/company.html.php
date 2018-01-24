<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 * @var \App\Entity\CompanyEmployee $employee
 */
$view->extend('layout/layout.html.php');

?>
<?= $view->render('layout/partial/page-title.html.php', ['pageTitle' => 'System : Company : '.$company->getTitle()])?>
<div class="row">
    <div class="col-md-6">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\System\\CompanyController::employees',['company' => $company])
        ) ?>
    </div>
</div>

