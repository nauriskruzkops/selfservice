<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 * @var \App\Entity\Employee[] $employee
 */
$formView = $form;
$formHelper = $view['form'];
$request = $app->getRequest();
$new = (!$employee || !$employee->getId());

?>
<?= $formHelper->start($form);?>
<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['username']) ?></div>
            <div class="col-sm-9">
                <?= $formHelper->errors($formView['username']) ?>
                <?= $formHelper->widget($formView['username']) ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['password']) ?></div>
            <div class="col-sm-9">
                <?= $formHelper->errors($formView['password']) ?>
                <?= $formHelper->widget($formView['password']) ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['roles']) ?></div>
            <div class="col-sm-9">
                <?= $formHelper->errors($formView['roles']) ?>
                <?= $formHelper->widget($formView['roles']) ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3 text-right"><?= $formHelper->label($formView['active']) ?></div>
            <div class="col-sm-9">
                <?= $formHelper->widget($formView['active']) ?>
                <?= $formHelper->label($formView['active']) ?>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="<?= $view['router']->path('system_company_edit',['id'=>$company ? $company->getId() : 0]) ?>" class="btn btn-link">Cancel</a>
        <input type="submit" class="btn btn-primary" value="Save">
    </div>
</div>
</form>