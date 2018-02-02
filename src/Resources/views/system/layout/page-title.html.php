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
<div class="jumbotron bot-left">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="display-5">
                <span style="margin-right: 10px; float: left">
                    <i class="<?= $pageIcon ?? ''?>" style="display: block"></i>
                </span>
                <?= $pageTitle ?? ''?></h2>
        </div>
    </div>

    <div class="clearfix"></div>
</div>
<?= $view->render('layout/partial/flash-messages.html.php')?>
