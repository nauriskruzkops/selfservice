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

$view['slots']->set('pageTitle', 'Employee : '.(!$new ? $this->escape($employee->getFullName()) : 'New'));
$view['slots']->set('pageIcon', 'fa fa-user-o');
$view['slots']->set('parentPageTitle', 'System');
$view['slots']->set('parentPageUrl', $view['router']->path('system'));

?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" data-toggle="pill" href="#baseData" role="tab" aria-controls="v-pills-home" aria-selected="true">Base info</a>
                    <?php if (!$new) :?>
                        <a class="nav-link" data-toggle="pill" href="#access" role="tab" aria-controls="v-pills-profile" aria-selected="false">Access</a>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-sm-12 col-md-10">
                <div class="white-box">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="baseData" role="tabpanel">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <?= $formHelper->start($form);?>
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
                                        <div class="form-group row">
                                            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['email']) ?></div>
                                            <div class="col-sm-9">
                                                <?= $formHelper->errors($formView['email']) ?>
                                                <?= $formHelper->widget($formView['email']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['company']) ?></div>
                                            <div class="col-sm-9">
                                                <?= $formHelper->errors($formView['company']) ?>
                                                <?= $formHelper->widget($formView['company']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['departments'][0]['department']) ?></div>
                                            <div class="col-sm-9">
                                                <?= $formHelper->errors($formView['departments'][0]['department']) ?>
                                                <?= $formHelper->widget($formView['departments'][0]['department']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['departments'][0]['manager']) ?></div>
                                            <div class="col-sm-9">
                                                <?= $formHelper->errors($formView['departments'][0]['manager']) ?>
                                                <?= $formHelper->widget($formView['departments'][0]['manager']) ?>
                                                <span class="small text-muted">By default (if empty) department manager</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['departments'][0]['startDate']) ?></div>
                                            <div class="col-sm-9">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <?= $formHelper->widget($form['departments'][0]['startDate']) ?>
                                                    </div>
                                                    <div class="col">
                                                        <?= $formHelper->widget($form['departments'][0]['endDate']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <a href="<?= $view['router']->path('system_company_edit',['id'=>$company ? $company->getId() : 0]) ?>" class="btn btn-link">Cancel</a>
                                            <input type="submit" class="btn btn-primary" value="Save">
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php if (!$new) :?>
                        <div class="tab-pane fade" id="access" role="tabpanel">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-12 col-lg-8">
                                        <?php echo $view['actions']->render(
                                            new ControllerReference('App\\Controller\\System\\UserController::editForm',['employee' => $employee])
                                        ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

