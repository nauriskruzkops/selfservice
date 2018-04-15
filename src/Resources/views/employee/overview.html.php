<?php

use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var GlobalVariables $app
 * @var PhpEngine $view
 * @var \App\Entity\Employee $employee
 * @var \App\Entity\EmployeeDepartments $companyEmployee
 */
$view->extend('employee/layout.html.php');

$view['slots']->set('employee', $employee);
$companyEmployee = $employee->getDepartments()->first();
?>

<div class="col-sm-12 col-md-6">
    <div class="row">
        <div class="col-md-3">Full name</div>
        <div class="col"><?=$view['object_url']->object($employee) ?></div>
    </div>
    <div class="row">
        <div class="col-md-3">Email</div>
        <div class="col"><?=$this->escape($employee->getEmail())?></div>
    </div>
    <div class="row">
        <div class="col-md-3">Departments</div>
        <div class="col"><?=$this->escape(implode(', ', $employee->getAllDepartment()['all']->toArray()))?></div>
    </div>
    <?php if ($employee->getManager()) {?>
        <div class="row">
            <div class="col-md-3">Manager</div>
            <div class="col">
                <?=$view['object_url']->object($employee->getManager()) ?>
                (<?=$employee->getManager()->getEmail()?>) from <?=$this->escape($employee->getManager()->getDepartment()->getDepartment()->getShortTitle())?>
            </div>
        </div>
    <?php }?>
</div>
