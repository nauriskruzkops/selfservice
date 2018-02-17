<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables $app
 * @var \App\Entity\VacationType $type
 */

$formView = $form;
$formHelper = $view['form'];
$request = $app->getRequest();

$new = (!$type || !$type->getId());

$view['slots']->set('pageTitle', 'Vacation / Leave type : '.(!$new ? $this->escape($type->getTitle()) : 'New'));
$view['slots']->set('pageIcon', 'fa fa-briefcase');
$view['slots']->set('parentPageTitle', 'System');
$view['slots']->set('parentPageUrl', $view['router']->path('system'));

$view->extend('layout/layout.html.php');
?>
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

            <div class="form-group row" style="display: none">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['company']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['company']) ?>
                    <?= $formHelper->widget($formView['company']) ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['daysLeave']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['daysLeave']) ?>
                    <?= $formHelper->widget($formView['daysLeave']) ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3 text-right"><?= $formHelper->label($formView['paidPercents']) ?></div>
                <div class="col-sm-9">
                    <?= $formHelper->errors($formView['paidPercents']) ?>
                    <?= $formHelper->widget($formView['paidPercents']) ?>
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

