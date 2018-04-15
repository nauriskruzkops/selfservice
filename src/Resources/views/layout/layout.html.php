<?php

use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var GlobalVariables $app
 * @var PhpEngine $view
 */

$view['slots']->set('department', $department ?? null);

$view->extend('layout/base.html.php');

$pageTitle = $view['slots']->get('pageTitle');
$pageIcon = $view['slots']->get('pageIcon');
$parentPageTitle = $view['slots']->get('parentPageTitle');
$parentPageUrl = $view['slots']->get('parentPageUrl');

?>
<nav id="mainTopNav" class="navbar navbar-expand-lg navbar-light bg-primary fixed-top align-middle">
    <a class="navbar-brand text-dark" href="\" style="padding-left: 30px">
        <span class="text-dark">Crocolab</span> <strong class="text-dark">HRMS</strong>
        <span class="align-middle text-dark" style="font-weight: normal; font-size: 10px;"> | Human resource management system </span>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-right" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><?=$app->getUser()->getEmployee()?></a>
            </li>
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
        </ul>
    </div>
</nav>

<div id="side-wrapper">
    <?php echo $view['actions']->render(
        new ControllerReference('App\\Controller\\Layout\\NavigationController::navigation', ['_parent' => $app->getRequest()])
    ); ?>
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
                <small> Copyright © Crocolab Human resource management system 2018</small>
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



