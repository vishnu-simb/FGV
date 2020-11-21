<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'electronic-monitoring-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate'),
    // for enabling client validation
    'enableClientValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>
<?php echo $form->errorSummary($modelElectronic); ?>

<div class="search-form-ext">
    <div class="box-content nopadding">
        <div class="span12">
            <?php if (Yii::app()->user->getState('role') == Users::USER_TYPE_GROWER): ?>
                <?php echo $form->dropDownListControlGroup($modelElectronic, 'pest_id', CHtml::listData($modelElectronic->getPest(), 'id', 'name'), array('empty' => 'Select A Pest', 'class' => 'input-xlarge select2-minw')) ?>
                <?php echo $form->dropDownListControlGroup($modelElectronic, 'block_id', CHtml::listData($modelElectronic->getBlockByGrower(), 'id', 'block_name'), array('empty' => 'Select A Block', 'class' => 'input-xlarge select2-minw')) ?>
                <?php echo $form->dropDownListControlGroup($modelElectronic, 'trap_id', CHtml::listData($modelElectronic->getTrapByGrower(), 'id', 'trap_name'), array('empty' => 'Select A Trap', 'class' => 'input-xlarge select2-minw')) ?>
            <?php else: ?>
                <?php echo $form->dropDownListControlGroup($modelElectronic, 'pest_id', CHtml::listData($modelElectronic->getPest(), 'id', 'name'), array('empty' => 'Select A Pest', 'class' => 'input-xlarge select2-minw')) ?>
                <?php echo $form->dropDownListControlGroup($modelElectronic, 'block_id', CHtml::listData($modelElectronic->getBlock()->getData(), 'id', 'block_name'), array('empty' => 'Select A Block', 'class' => 'input-xlarge select2-minw')) ?>
                <?php echo $form->dropDownListControlGroup($modelElectronic, 'trap_id', CHtml::listData($modelElectronic->getTrap()->getData(), 'id', 'trap_name'), array('empty' => 'Select A Trap', 'class' => 'input-xlarge select2-minw')) ?>
            <?php endif; ?>
            <?php echo $form->textFieldControlGroup($modelElectronic, 'date', array('class' => 'input-xlarge datepick', 'placeholder' => $modelElectronic->getAttributeLabel('date'))); ?>
            <?php echo $form->textFieldControlGroup($modelElectronic, 'value', array('class' => 'input-xlarge', 'placeholder' => $modelElectronic->getAttributeLabel('value'))); ?>
            <?php echo $form->textAreaControlGroup($modelElectronic, 'comment', array('rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelElectronic->getAttributeLabel('comment'))); ?>
        </div>

        <div class="span12">
            <div class="form-actions">
                <?php echo TbHtml::submitButton(Yii::t('app', 'Save Changes'), array(
                    'color' => '', 'class' => 'input-xxlarge btn btn-large',
                )); ?>
            </div>
        </div>
    </div>

</div><!-- search-form -->

<?php $this->endWidget(); ?>
