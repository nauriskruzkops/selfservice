<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables $app
 */

$request = $app->getRequest();

/**
 * @var PhpEngine $view
 */
?><div class="row page-title">
    <div class="col-md-6 col-sm-12">
        <span class="breadcrumb-page-title" style="text-transform: uppercase">
            <span style="margin-right: 10px; float: left">
                <i class="<?= $pageIcon ?? ''?>" style="display: inline-block"></i>
            </span>
            <?= $pageTitle ?? ''?>
        </span>

        <?php if (strpos($request->attributes->get('_route'),'department') !== false) {?>
            <?= $view['actions']->render(
                new ControllerReference('App\\Controller\\Layout\\LayoutController::departmentsDropdown',[
                    'request' => $request,
                ])
            ) ?>
        <?php }?>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\Layout\\NavigationController::breadcrumb', [
                'params' => [
                    'parent' => $parentPage ?? null,
                    'current' => $pageTitle,
                ]
            ])
        ) ?>
    </div>
</div>
<?= $view->render('layout/partial/flash-messages.html.php')?>