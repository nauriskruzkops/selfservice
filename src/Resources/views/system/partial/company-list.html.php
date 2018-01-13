<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 */

$view->extend('layout/blocks/list.html.php');

?>
<?php foreach ($companies as $company):?>
    <li class="list-group-item justify-content-betwee">
        <a href="<?= $view['router']->path('system_company_edit',['id'=>$company->getId()]) ?>"><?= $company->getTitle()?></a>
        <span class="badge badge-default badge-pill"><?= $company->getEmployees()->count()?></span>
    </li>
<?php endforeach;?>
