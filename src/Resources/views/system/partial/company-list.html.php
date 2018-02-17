<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 */

?>
<div class="row">
    <?php if ($companies): ?>
        <?php foreach ($companies ?? [] as $company) :?>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                <div class="card bg-secondary">
                    <div class="card-body text-center" style="font-size: 130%; height: 200px;">
                        <i class="fa fa-building-o"></i>
                        <p><?= $this->escape($company->getTitle())?></p>
                    </div>
                    <div class="card-footer clearfix ">
                        <a href="<?= $view['router']->path('system_company_edit',['id'=>$company->getId()]) ?>">Edit</a>
                        <span class="float-right"><i class="fa fa-angle-right"></i></span>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <div class="col-md-2 col-sm-3 col-xs-6">
        <div class="card">
            <div class="card-body text-center" style="font-size: 130%; height: 200px;">
                <i class="fa fa-building-o"></i>
                <p> </p>
                <i class="fa fa-plus-square-o" style="font-size: 200%; color: #a8aaae"></i>
            </div>
            <div class="card-footer clearfix ">
                <a href="<?= $view['router']->path('system_company_add') ?>">Add</a>
                <span class="float-right"><i class="fa fa-angle-right"></i></span>
            </div>
        </div>
    </div>
</div>