<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/layout.html.php');
?>
<?= $view->render('layout/partial/page-title.html.php', ['pageTitle' => $pageTitle ?? null])?>
<div class="row">
    <div class="col-md-6">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\System\\CompanyController::list',[])
        ) ?>
    </div>
</div>

