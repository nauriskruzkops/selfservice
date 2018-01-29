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
$new = (!$employee || !$employee->getId());

$view->extend('layout/layout.html.php');
?>
<?= $view->render('system/layout/page-title.html.php', [
    'parentPage' => [
        'pageTitle' => 'System',
        'pageUrl' => $view['router']->path('system'),
    ],
    'pageTitle' => 'Employee : '.($company ? $employee->getFullName() : 'New'),
    'pageIcon' => 'fa fa-user-o',
])?>

<?= $formHelper->start($form);?>
    <div class="row">
        <div class="offset-md-2 col-sm-6">
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
        <div class="offset-md-2 col-sm-6">
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
                    <a href="<?= $view['router']->path('system_company_edit',['id'=>$company ? $company->getId() : 0]) ?>" class="btn btn-link">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </div>
        </div>
    </div>
</form>

