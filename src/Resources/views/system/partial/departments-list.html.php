<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 * @var \App\Entity\CompanyDepartment[] $departments
 */

?>
<table class="table table-hover" role="grid">
    <thead>
        <tr>
            <th class="col-md-6">Title</th>
            <th></th>
            <th style="width: 3%"><a href="./" class="btn btn-sm btn-primary">Add</a></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($departments): ?>
            <?php foreach ($departments ?? [] as $department) :?>
                <tr>
                    <td><a href="<?= $view['router']->path('system_department_edit',['id'=>$department->getId()]) ?>"><?= $department->getTitle()?></a></td>
                    <td>...</td>
                    <td><a href="<?= $view['router']->path('system_department_edit',['id'=>$department->getId()]) ?>" class="btn btn-sm btn-default">Edit</a></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
