<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 */

$view->extend('layout/base.html.php');

$pageTitle = $view['slots']->get('pageTitle');
$pageIcon = $view['slots']->get('pageIcon');
$parentPageTitle = $view['slots']->get('parentPageTitle');
$parentPageUrl = $view['slots']->get('parentPageUrl');

?>
<nav id="mainTopNav" class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
    <a class="navbar-brand" href="\">Self-service panel</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-user-circle fa-lg"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div id="side-wrapper">
    <?php echo $view['actions']->render(
        new ControllerReference('App\\Controller\\Layout\\NavigationController::navigation', ['_parent' => $app->getRequest()])
    ) ?>
</div>

<div id="content-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?= $view->render('layout/partial/page-title.html.php', [
                    'parentPage' => [
                        'pageTitle' => $parentPageTitle ?? null,
                        'pageUrl' => $parentPageUrl,
                    ],
                    'pageTitle' => $pageTitle ?? '',
                    'pageIcon' => $pageIcon ?? '',
                ])?>

                <?php $view['slots']->output('_content') ?>
            </div>
        </div>
        </div>
    </div>

    <footer class="fixed-bottom bg-dark">
        <div class="container-fluid" style="padding: 5px 0;">
            <div class="text-center text-muted">
                <small> Copyright © Crocolab Self-service 2017</small>
            </div>
        </div>
    </footer>
</div>


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= $view['router']->path('logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>



