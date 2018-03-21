<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Employee $employee
 * @var \App\Entity\EmployeeDepartments $companyEmployee
 */
$view->extend('employee/layout.html.php');

$view['slots']->set('employee', $employee);
$companyEmployee = $employee->getDepartments()->first();
?>


<?= sprintf(
    'Employee <strong>%s</strong> (%s) is member of <strong>%s</strong>.<br>
            Direct manager is <strong>%s</strong> (%s) from <strong>%s</strong>',
    $employee,
    $employee->getEmail(),
    implode(', ', $employee->getAllDepartment()['all']->toArray()),
    $employee->getManager(),
    $employee->getManager() ? $employee->getManager()->getEmail() : '<not>',
    $employee->getManager() ? $employee->getManager()->getDepartment() : '<not>'
);
?>