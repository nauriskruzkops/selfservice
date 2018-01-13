<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 */

$view->extend('layout/blocks/card.html.php');

?><table class="table table-bordered" role="grid">
    <thead>
    <tr>
        <th class="col-md-6">Full name</th>
        <th>Start date</th>
        <th>Position</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php if ($company->getEmployees()->count()): ?>
            <?php foreach ($company->getEmployees() ?? [] as $employee) :?>
                <tr>
                    <td><?= $employee->getEmployee()->getFullName()?></td>
                    <td><?= $employee->getStartDate()->format('d.m.Y')?></td>
                    <td><?= $employee->getPosition()?></td>
                    <td><a href="" class="btn btn-sm btn-default">Edit</a></td>
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
