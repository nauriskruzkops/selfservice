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
$employee = $view['slots']->get('employee');
$new = (!$employee || !$employee->getId());

$view['slots']->set('pageTitle', 'Employee');
$view['slots']->set('pageIcon', 'fa fa-user-o');

$view->extend('layout/layout.html.php');

?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <div class="text-center p-md-4">
                    <i class="fa fa-user-circle-o fa-4x"></i>
                </div>
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" data-toggle="pill" href="#baseData" role="tab" aria-controls="v-pills-home" aria-selected="true">Base info</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="p-md-4">
                    <h1><span style="font-weight: 100; font-size: 90%">Hi, </span> <?= $this->escape($employee->getFullName())?></h1>
                </div>
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





