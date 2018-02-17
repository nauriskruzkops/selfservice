<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */
?><div class="row page-title" style="padding-top: 5px; padding-bottom: 5px; ">
    <div class="col-md-6 col-sm-12">
        <h4>
        <span style="margin-right: 10px; float: left">
            <i class="<?= $pageIcon ?? ''?>" style="display: inline-block"></i>
        </span>
            <?= $pageTitle ?? ''?>
        </h4>
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