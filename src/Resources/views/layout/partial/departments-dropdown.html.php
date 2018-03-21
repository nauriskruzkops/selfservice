<?php

use App\Entity\CompanyDepartment;
use App\Entity\EmployeeDepartments;
use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var GlobalVariables $app
 * @var RequestHelper $request
 * @var array $parent
 * @var EmployeeDepartments $current
 * @var EmployeeDepartments[] $departments
 */

$request = $app->getRequest();
$current = $current ?? '';

?>
<a class="dropdown-toggle align-self-center" id="departmentDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 2px; font-size: 18px">
    : <strong><?= $current->getShortTitle()?></strong>
</a>
<div class="dropdown-menu" aria-labelledby="departmentDropdown">
    <?php foreach ($departments as $department) :?>
        <a class="dropdown-item" href="<?= $view['router']->path('department',['department_id' => $department->getDepartment()->getId()]) ?>">
            <strong><?= $this->escape($department->getTitle())?></strong>
            <div class="dropdown-message small"><?= $this->escape($department->getCompany())?></div>
        </a>
    <?php endforeach;?>

    <div class="dropdown-divider"></div>
    <a class="dropdown-item small" href="#">Close</a>
</div>



