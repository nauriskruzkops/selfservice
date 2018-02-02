<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */
$view->extend('layout/layout.html.php');
?>

<?= $view->render('system/layout/page-title.html.php', [
    'parentPage' => [
        'pageTitle' => 'System',
        'pageUrl' => $view['router']->path('system'),
    ],
    'pageTitle' => 'System settings',
    'pageIcon' => 'fa fa-cogs',
])?>

<div class="row">
    <div class="col-md-12">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\System\\CompanyController::list',[])
        ) ?>
    </div>
</div>

