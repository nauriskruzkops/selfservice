<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables $app
 * @var \App\Entity\Company $company
 * @var \App\Entity\Employee $employee
 */

$formView = $form;
$formHelper = $view['form'];
$request = $app->getRequest();


$view->extend('layout/layout.html.php');
?>
<?= $view->render('layout/partial/page-title.html.php', ['pageTitle' => 'System : Employee'])?>
<form action="<?= $view['router']->path('system_employee_edit',['id'=>$employee->getId()]) ?>" name="employee_form" method="post">
    <div class="row">
        <div class="col-sm-2">
            <div class="text-center" style="font-size: 800%; color: #6c6c6c">
                <i class="fa fa-user-o" style="display: block"></i>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['name']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['name']) ?>
                    <?= $formHelper->widget($formView['name']) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['surname']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['surname']) ?>
                    <?= $formHelper->widget($formView['surname']) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['personalId']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['personalId']) ?>
                    <?= $formHelper->widget($formView['personalId']) ?>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-6">
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['companyRelation'][0]['company']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['companyRelation'][0]['company']) ?>
                    <?= $formHelper->widget($formView['companyRelation'][0]['company']) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['companyRelation'][0]['department']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['companyRelation'][0]['department']) ?>
                    <?= $formHelper->widget($formView['companyRelation'][0]['department']) ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['companyRelation'][0]['startDate']) ?></div>
                <div class="col-sm-9">
                    <div class="form-row">
                        <div class="col">
                            <?= $formHelper->widget($form['companyRelation'][0]['startDate']) ?>
                        </div>
                        <div class="col">
                            <?= $formHelper->widget($form['companyRelation'][0]['endDate']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-right"></div>
                <div class="col-sm-9 text-right">
                    <a href="<?= $request->headers->get('referer') ?? '/'?>" class="btn btn-link">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </div>
        </div>
    </div>
</form>

