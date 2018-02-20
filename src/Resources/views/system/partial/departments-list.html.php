<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var Doctrine\ORM\Tools\Pagination\Paginator  $departments
 * @var \App\Entity\CompanyDepartment $department
 */

$company = null;
if ($departments->getIterator()->count()) {
    $company = $departments->getIterator()->current();
}

$view->extend('layout/blocks/card.html.php');

?><table class="table table-sm table-hover" role="grid">
    <thead>
        <tr>
            <th class="col-md-6">Title</th>
            <th class="col-md-6">Short</th>
            <th style="width: 3%">
                <a href="<?= $view['router']->path('system_department_add',['id'=> $company ? $company->getId() : 0]) ?>" class="btn btn-sm btn-primary">Add</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if ($departments): ?>
            <?php foreach ($departments ?? [] as $department) :?>
                <tr>
                    <td><a href="<?= $view['router']->path('system_department_edit',['id'=>$department->getId()]) ?>"><?= $this->escape($department->getTitle())?></a></td>
                    <td><a href="<?= $view['router']->path('system_department_edit',['id'=>$department->getId()]) ?>"><?= $this->escape($department->getShortTitle())?></a></td>
                    <td><a href="<?= $view['router']->path('system_department_edit',['id'=>$department->getId()]) ?>" class="btn btn-sm btn-default">Edit</a></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
