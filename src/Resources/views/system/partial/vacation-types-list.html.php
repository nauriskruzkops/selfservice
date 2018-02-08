<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\VacationType[]  $types
 */

$company = null;
if (count($types)) {
    $company = $types[0]->getCompany();
}

$view->extend('layout/blocks/card.html.php');

?><table class="table table-sm table-hover" role="grid">
    <thead>
        <tr>
            <th class="col-md-6">Title</th>
            <th>Leave days</th>
            <th>Paid %</th>
            <th style="width: 3%">
                <a href="<?= $view['router']->path('system_vacation_type_add',['id'=> $company ? $company->getId() : 0]) ?>" class="btn btn-sm btn-primary">Add</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if ($types): ?>
            <?php foreach ($types ?? [] as $type) :?>
                <tr>
                    <td><a href="<?= $view['router']->path('system_vacation_type_edit',['id'=>$type->getId()]) ?>"><?= $this->escape($type->getTitle())?></a></td>
                    <td><?= $this->escape($type->getDaysLeave())?></td>
                    <td><?= $this->escape($type->getPaidPercents())?></td>
                    <td><a href="<?= $view['router']->path('system_vacation_type_edit',['id'=>$type->getId()]) ?>" class="btn btn-sm btn-default">Edit</a></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>
