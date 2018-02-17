<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/layout.html.php');

$view['slots']->set('pageTitle', 'System settings');
$view['slots']->set('pageIcon', 'fa fa-cogs');
$view['slots']->set('parentPageTitle', 'System');
$view['slots']->set('parentPageUrl', $view['router']->path('system'));

?><div class="row">
    <div class="col-md-12">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\System\\CompanyController::list',[])
        ) ?>
    </div>
</div>

