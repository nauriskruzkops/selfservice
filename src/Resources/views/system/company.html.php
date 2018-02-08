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
$new = (!$company || !$company->getId());


?>
<?= $view->render('system/layout/page-title.html.php', [
        'parentPage' => [
            'pageTitle' => 'System',
            'pageUrl' => $view['router']->path('system'),
        ],
        'pageTitle' => 'Company : '.( !$new ? $this->escape($company->getTitle()) : 'New'),
        'pageIcon' => 'fa fa-building-o',
])?>

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
                <div class="">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="baseData" role="tabpanel">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p> </p>
                                        <div class="col-sm-8">
                                            <?= $formHelper->start($formView);?>
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
                                                <div class="form-group row">
                                                    <div class="col-sm-3 text-right"><?= $formHelper->label($formView['parent']) ?></div>
                                                    <div class="col-sm-9">
                                                        <?= $formHelper->errors($formView['parent']) ?>
                                                        <?= $formHelper->widget($formView['parent']) ?>
                                                    </div>
                                                </div>

                                                <?php echo $view['actions']->render(
                                                    new ControllerReference('App\\Controller\\System\\SettingsController::globalList',['company' => $company])
                                                ) ?>

                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 text-right">
                                                            <a href="<?= $view['router']->path('system') ?>" class="btn btn-link">Cancel</a>
                                                            <input type="submit" class="btn btn-primary" value="Save">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?= $formHelper->end($formView);?>
                                        </div>

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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (!$new) :?>
                            <div class="tab-pane fade" id="vacation-types" role="tabpanel">
                                <?php echo $view['actions']->render(
                                    new ControllerReference('App\\Controller\\System\\VacationTypeController::list',['company' => $company])
                                ) ?>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-right">
                                            <a href="<?= $view['router']->path('system') ?>" class="btn btn-link">Cancel</a>
                                            <input type="submit" class="btn btn-primary" value="Save">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="employees" role="tabpanel">
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


