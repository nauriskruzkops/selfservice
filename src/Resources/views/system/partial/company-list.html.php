<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 */

//$view->extend('layout/blocks/list.html.php');

?>
<div class="row">
    <?php if ($companies): ?>
        <?php foreach ($companies ?? [] as $company) :?>
            <div class="col-md-2">
                <div class="card card-info">
                    <div class="card-body text-center" style="font-size: 130%; height: 200px;">
                        <i class="fa fa-building-o"></i>
                        <p><?= $company->getTitle()?></p>
                    </div>
                    <div class="card-footer">
                        <a href="<?= $view['router']->path('system_company_edit',['id'=>$company->getId()]) ?>" class="btn btn-sm btn-default">Edit</a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <div class="col-md-2">
        <div class="card">
            <div class="card-body text-center" style="font-size: 130%; height: 200px;">
                <i class="fa fa-building-o" style="font-size: 200%"></i>
                <p> </p>
                <a href="<?= $view['router']->path('system_company_edit',['id'=>$company->getId()]) ?>" class="btn btn-sm btn-default">Add new</a>
            </div>
            <div class="card-footer">
                <a href="<?= $view['router']->path('system_company_add',[]) ?>" class="btn btn-sm btn-default">Add</a>
            </div>
        </div>
    </div>
</div>