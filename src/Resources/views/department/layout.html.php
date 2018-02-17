<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables $app
 * @var \App\Entity\Company $company
 * @var \App\Entity\Employee $employee
 */

$request = $app->getRequest();

$view['slots']->set('pageTitle', 'Department');
$view['slots']->set('pageIcon', 'fa fa-users');

$view->extend('layout/layout.html.php');

?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <div class="text-center p-md-5">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" data-toggle="pill" href="#baseData" role="tab" aria-controls="v-pills-home" aria-selected="true">Base info</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="white-box">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="baseData" role="tabpanel">
                            <?php $view['slots']->output('_content') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





