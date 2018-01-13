<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/layout.html.php');

?>
<div class="site-header">
    <h1>System settings</h1>
</div>

<div class="row">
    <div class="col-md-6">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\System\\CompanyController::list',[])
        ) ?>
    </div>
</div>

