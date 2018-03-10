<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 * @var \App\Entity\EmployeeDepartments $employee
 * @var Doctrine\ORM\Tools\Pagination\Paginator $employees
 */
$view->extend('layout/blocks/card.html.php');

?>
<table class="table table-sm table-hover" role="grid">
    <thead>
    <tr>
        <th>Full name</th>
        <th>Short</th>
        <th>Start date</th>
        <th>Department</th>
        <th>Access</th>
        <th><a href="<?= $view['router']->path('system_employee_add',['id'=>$company ? $company->getId() : 0]) ?>" class="btn btn-sm btn-primary">Add</a></th>
    </tr>
    </thead>
    <tbody>
        <?php if ($company->getEmployees()) :?>
            <?php foreach ($company->getEmployees() as $employee) : ?>
                <tr>
                    <td><?= $this->escape($employee->getFullName())?></td>
                    <td><?= $this->escape($employee->getShortTitle())?></td>
                    <td><?= $employee->getDepartment()->getStartDate()->format('d.m.Y')?></td>
                    <td><?= $this->escape($employee->getDepartment())?></td>
                    <td>
                        <?php if ($employee->getUser()) {;?>
                            <span class="small text-muted">
                                <?= implode(', ', $employee->getUser()->getRoles())?>
                            </span>
                        <?php }?>
                    </td>
                    <td><a href="<?= $view['router']->path('system_employee',['id'=>$employee->getId()]) ?>" class="btn btn-sm btn-default">Edit</a></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>

<nav class="pull-right">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
</nav>