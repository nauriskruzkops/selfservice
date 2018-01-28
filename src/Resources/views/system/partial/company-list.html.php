<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 */

//$view->extend('layout/blocks/list.html.php');

?>

<table class="table table-hover" role="grid">
    <thead>
    <tr>
        <th class="col-md-6">Title</th>
        <th>Employees</th>
        <th> </th>
    </tr>
    </thead>
    <tbody>
    <?php if ($companies): ?>
        <?php foreach ($companies ?? [] as $company) :?>
            <tr>
                <td><a href="<?= $view['router']->path('system_company_edit',['id'=>$company->getId()]) ?>"><?= $company->getTitle()?></a></td>
                <td><?= $company->getEmployees()->count()?></td>
                <td><a href="<?= $view['router']->path('system_company_edit',['id'=>$company->getId()]) ?>" class="btn btn-sm btn-default">Edit</a></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    <tr>
        <td class="text-center" colspan="4">
            <a href="" class="btn btn-default">Add company</a>
        </td>
    </tr>
    </tbody>
</table>
