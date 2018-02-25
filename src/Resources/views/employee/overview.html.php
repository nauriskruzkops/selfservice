<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Employee $employee
 * @var \App\Entity\CompanyEmployee $companyEmployee
 */
$view->extend('employee/layout.html.php');

$view['slots']->set('employee', $employee);
$companyEmployee = $employee->getCompanyRelation()->first();
?>

<?= sprintf(
    'Employee <strong>%s</strong> (%s) is member of <strong>%s</strong>.',
    $employee,
    $employee->getEmail(),
    $companyEmployee->getDepartment())?>