<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 * @var \App\Entity\CompanyEmployee $employee
 * @var Doctrine\ORM\Tools\Pagination\Paginator $employees
 */
$view->extend('layout/blocks/card.html.php');

?>
<table class="table table-sm table-hover" role="grid">
    <thead>
    <tr>
        <th class="col-md-6">Full name</th>
        <th>Start date</th>
        <th>Department</th>
        <th>Position</th>
        <th><a href="<?= $view['router']->path('system_employee_add',['id'=>$company ? $company->getId() : 0]) ?>" class="btn btn-sm btn-primary">Add</a></th>
    </tr>
    </thead>
    <tbody>
        <?php if ($company->getEmployees()->count()): ?>
            <?php foreach ($employees->getIterator() ?? [] as $employee) :?>
                <tr>
                    <td><?= $employee->getEmployee()->getFullName()?></td>
                    <td><?= $employee->getStartDate()->format('d.m.Y')?></td>
                    <td><?= $employee->getDepartment()?></td>
                    <td> </td>
                    <td><a href="<?= $view['router']->path('system_employee',['id'=>$employee->getEmployee()->getId()]) ?>" class="btn btn-sm btn-default">Edit</a></td>
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