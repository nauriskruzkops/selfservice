<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables $app
 * @var \App\Entity\Company $company
 * @var \App\Entity\Employee $employee
 * @var \App\Entity\CompanyDepartment $department
 */

$request = $app->getRequest();

$view['slots']->set('pageTitle', 'Department');
$view['slots']->set('pageIcon', 'fa fa-users');

$company = $view['slots']->get('company');
$employee = $view['slots']->get('employee');
$department = $view['slots']->get('department');

$view->extend('layout/layout.html.php');

$isNavPillActive = function($nav) use($request) {
    return ($nav == $request->attributes->get('_route'));
}

?><div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <div class="text-center p-md-4">
                    <i class="fa fa-users fa-4x"></i>
                </div>
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link <?= !$isNavPillActive('department') ?: 'active'?>" href="<?= $view['router']->path('department',['department_id' => $department->getId()])?>" role="tab" aria-selected="true">Base info</a>
                    <a class="nav-link <?= !$isNavPillActive('department_vacations') ?: 'active'?>" href="<?= $view['router']->path('department_vacations',['department_id' => $department->getId()])?>" role="tab" aria-selected="true">Vacations</a>
                </div>
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="p-md-4">
                            <h1><span style="font-weight: 100; font-size: 90%">Welcom to</span> <?= $this->escape($department->getTitle())?></h1>
                            <?php

                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4 d-flex flex-row justify-content-end">
                        <a href="/" class="align-self-center p-2"><i class="fa fa-cog fa-2x"></i></a>
                    </div>
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





