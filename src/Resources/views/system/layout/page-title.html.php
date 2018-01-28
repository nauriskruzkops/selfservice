<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */

?>
<?php echo $view['actions']->render(
    new ControllerReference('App\\Controller\\Layout\\NavigationController::breadcrumb', [
        'params' => [
            'parent' => $parentPage ?? null,
            'current' => $pageTitle,
        ]
    ])
) ?>
<div class="jumbotron">
    <div class="row">
        <div class="col-sm-2">
            <div class="text-center" style="font-size: 800%; color: #6c6c6c">
                <i class="<?= $pageIcon ?? ''?>" style="display: block"></i>
            </div>
        </div>
        <div class="col-sm-6">
            <h2 class="display-5"><?= $pageTitle ?? ''?></h2>
        </div>
    </div>

    <div class="clearfix"></div>
</div>
<?= $view->render('layout/partial/flash-messages.html.php')?>
