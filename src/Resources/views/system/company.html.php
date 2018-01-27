<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 * @var \App\Entity\CompanyEmployee $employee
 */
$view->extend('layout/layout.html.php');


$formView = $form->createView();
$formHelper = $view['form'];
$request = $app->getRequest();

?>
<?= $view->render('layout/partial/page-title.html.php', ['pageTitle' => 'System : Company : '.$company->getTitle()])?>
<form class="" action="" method="post">
<div class="row">
    <div class="col-sm-2">
        <div class="text-center" style="font-size: 800%; color: #6c6c6c">
            <i class="fa fa-building-o" style="display: block"></i>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['title']) ?></div>
            <div class="col-sm-9">
                <?= $formHelper->errors($formView['title']) ?>
                <?= $formHelper->widget($formView['title']) ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['registrationNo']) ?></div>
            <div class="col-sm-9">
                <?= $formHelper->errors($formView['registrationNo']) ?>
                <?= $formHelper->widget($formView['registrationNo']) ?>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<hr>

<div class="row">
    <div class="col-md-4">
        <h4>Vocation settings</h4>
        <br>
        <div class="col-sm-12">
            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <a href="<?= $view['router']->path('system') ?>" class="btn btn-link">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <?php echo $view['actions']->render(
            new ControllerReference('App\\Controller\\System\\CompanyController::employees',['company' => $company])
        ) ?>
    </div>
</div>
</form>

