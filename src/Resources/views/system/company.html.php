<?php

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company $company
 * @var \App\Entity\EmployeeDepartments $employee
 */
$view->extend('layout/layout.html.php');

$formView = $form->createView();
$formHelper = $view['form'];
$request = $app->getRequest();
$new = (!$company || !$company->getId());


$view['slots']->set('pageTitle', 'Company : '.( !$new ? $this->escape($company->getTitle()) : 'New'));
$view['slots']->set('pageIcon', 'fa fa-building-o');
$view['slots']->set('parentPageTitle', 'System');
$view['slots']->set('parentPageUrl', 'system');

?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" data-toggle="pill" href="#baseData" role="tab" aria-controls="v-pills-home" aria-selected="true">Base info</a>
                    <?php if (!$new) :?>
                        <a class="nav-link" data-toggle="pill" href="#vacation-types" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vacation types</a>
                        <a class="nav-link" data-toggle="pill" href="#employees" role="tab" aria-controls="v-pills-messages" aria-selected="false">Employees</a>
                        <a class="nav-link" data-toggle="pill" href="#departments" role="tab" aria-controls="v-pills-messages" aria-selected="false">Departments</a>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="white-box">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="baseData" role="tabpanel">
                            <?= $formHelper->start($formView);?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <?= $formHelper->label($formView['title']) ?>
                                        <?= $formHelper->widget($formView['title']) ?>
                                        <?= $formHelper->errors($formView['title']) ?>
                                    </div>
                                    <div class="form-group">
                                        <?= $formHelper->label($formView['registrationNo']) ?>
                                        <?= $formHelper->widget($formView['registrationNo']) ?>
                                        <?= $formHelper->errors($formView['registrationNo']) ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <?= $formHelper->label($formView['parent']) ?>
                                        <?= $formHelper->widget($formView['parent']) ?>
                                        <?= $formHelper->errors($formView['parent']) ?>
                                    </div>
                                    <?php echo $view['actions']->render(
                                        new ControllerReference('App\\Controller\\System\\SettingsController::globalList',['company' => $company])
                                    ) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group text-right">
                                        <a href="<?= $view['router']->path('system') ?>" class="btn btn-link">Cancel</a>
                                        <input type="submit" class="btn btn-danger" value="<?= $new ? 'Create' : 'Save' ?>">
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                            <?= $formHelper->end($formView);?>

                            <?php if (!$new) :?>
                            <div class="row">
                                <div class="col">
                                    <?php echo $view['actions']->render(
                                        new ControllerReference('App\\Controller\\System\\VacationTypeController::list',['company' => $company])
                                    ) ?>
                                </div>
                                <div class="col">
                                    <?php echo $view['actions']->render(
                                        new ControllerReference('App\\Controller\\System\\DepartmentController::list',['company' => $company])
                                    ) ?>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                        <?php if (!$new) :?>
                            <div class="tab-pane fade" id="vacation-types" role="tabpanel">
                                <?php echo $view['actions']->render(
                                    new ControllerReference('App\\Controller\\System\\VacationTypeController::list',['company' => $company])
                                ) ?>
                            </div>

                            <div class="tab-pane fade" id="employees" data-block="employees" role="tabpanel">
                                <?php echo $view['actions']->render(
                                    new ControllerReference('App\\Controller\\System\\CompanyController::employees',['company' => $company])
                                ) ?>
                            </div>

                            <div class="tab-pane fade" id="departments" role="tabpanel">
                                <?php echo $view['actions']->render(
                                    new ControllerReference('App\\Controller\\System\\DepartmentController::list',['company' => $company])
                                ) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


