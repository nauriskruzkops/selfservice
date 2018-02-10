<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables $app
 * @var \App\Entity\CompanyDepartment $department
 */

$formView = $form;
$formHelper = $view['form'];
$request = $app->getRequest();

$new = (!$department || !$department->getId());

$view->extend('layout/layout.html.php');
?>
<?= $view->render('system/layout/page-title.html.php', [
    'parentPage' => [
        'pageTitle' => 'System',
        'pageUrl' => $view['router']->path('system'),
    ],
    'pageTitle' => 'Department : '.(!$new ? $this->escape($department->getTitle()) : 'New'),
    'pageIcon' => 'fa fa-briefcase',
])?>

<?= $formHelper->start($form);?>
    <div class="row">
        <div class="offset-md-2 col-sm-6">
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['title']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['title']) ?>
                    <?= $formHelper->widget($formView['title']) ?>
                </div>
            </div>
        </div>
        <div class="offset-md-2 col-sm-6">
            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['company']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['company']) ?>
                    <?= $formHelper->widget($formView['company']) ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['manager']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['manager']) ?>
                    <?= $formHelper->widget($formView['manager']) ?>
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

