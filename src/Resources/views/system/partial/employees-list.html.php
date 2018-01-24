<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 * @var \App\Entity\CompanyEmployee $employee
 */

$view->extend('layout/blocks/card.html.php');

?><table class="table table-bordered" role="grid">
    <thead>
    <tr>
        <th class="col-md-6">Full name</th>
        <th>Start date</th>
        <th>Department</th>
        <th>Position</th>
        <th> </th>
    </tr>
    </thead>
    <tbody>
        <?php if ($company->getEmployees()->count()): ?>
            <?php foreach ($company->getEmployees() ?? [] as $employee) :?>
                <tr>
                    <td><?= $employee->getEmployee()->getFullName()?></td>
                    <td><?= $employee->getStartDate()->format('d.m.Y')?></td>
                    <td><?= $employee->getDepartment()?></td>
                    <td><?= $employee->getPosition()?></td>
                    <td><a href="<?= $view['router']->path('system_employee',['id'=>$employee->getEmployee()->getId()]) ?>" class="btn btn-sm btn-default">Edit</a></td>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td class="text-center" colspan="4">
                    <a href="" class="btn btn-default">Add employee</a>
                </td>
            </tr>
        <?php endif;?>
    </tbody>
</table>
