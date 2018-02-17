<?php
/**
 * @var Symfony\Bundle\FrameworkBundle\Templating\PhpEngine $view
 * @var Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $formHelper
 * @var Symfony\Component\Form\FormView $form
 * @var \App\Entity\Vacation $vacation
 */

$vacation  = $vacation ?? null;
$formHelper = $view['form'];
$new = (!$vacation ?? false);
?>
<?= $formHelper->start($form);?>
<div class="modal-header">
    <h5 class="modal-title"><?= $new ? 'Add': 'Modify'?> vacation</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-sm-3"><?= $formHelper->label($form['employee']) ?></div>
        <div class="col-sm-9">
            <p class="form-control-plaintext"><?= (string) $employee ?></p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3"><?= $formHelper->label($form['type']) ?></div>
        <div class="col-sm-9">
            <?= $formHelper->errors($form['type']) ?>
            <?= $formHelper->widget($form['type']) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <label class="col-form-label" for="form_startDate">Period</label>
        </div>
        <div class="col-sm-9">
            <div class="form-row">
                <div class="col">
                    <?= $formHelper->widget($form['startDate']) ?>
                </div>
                <div class="col">
                    <?= $formHelper->widget($form['endDate']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary"><?= $vacation ? 'Edit' : 'Add'?> vacation</button>
</div>
</form>

