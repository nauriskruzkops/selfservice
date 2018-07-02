<?php
/**
 * @var Symfony\Bundle\FrameworkBundle\Templating\PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper
 * @var Symfony\Component\Form\FormView $form
 * @var \App\Entity\EmployeeDepartments[] $employees
 */

$form  = $form ?? null;
$formHelper = $view['form'];
?>
<div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Full name</th>
                <th scope="col">Email</th>
                <th scope="col">Department</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee) :?>
                <tr scope="row">
                    <td><?= $employee->getEmployee()->getShortTitle()?></td>
                    <td><?= $employee->getEmployee()?></td>
                    <td><?= $employee->getEmployee()->getEmail()?></td>
                    <td><?= $employee?></td>
                    <td></td>
                </tr>
            <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <td>.</td>
            </tr>
        </tfoot>
    </table>
</div>