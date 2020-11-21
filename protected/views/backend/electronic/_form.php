<?php
/* @var $this ElectronicController */
/* @var $modelElectronic ElectronicMonitor */
/* @var $form TbActiveForm */
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'trap-check-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate'),
                // for enabling client validation
                'enableClientValidation' => true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
<?php echo $form->errorSummary($modelElectronic); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
                    <?php echo $form->dropDownListControlGroup($modelElectronic, 'pest_id', CHtml::listData( $modelElectronic->getPest() ,'id','name'),array('empty'=>'Select A Pest', 'class' => 'input-xlarge select2-minw'))?>
                    <?php echo $form->dropDownListControlGroup($modelElectronic, 'block_id', CHtml::listData( $modelElectronic->getBlock()->getData() ,'id','block_name'),array('empty'=>'Select A Block', 'class' => 'input-xlarge select2-minw'))?>
                    <?php echo $form->dropDownListControlGroup($modelElectronic, 'trap_id', CHtml::listData( $modelElectronic->getTrap()->getData() ,'id','trap_name'),array('empty'=>'Select A Trap', 'class' => 'input-xlarge select2-minw'))?>
                    <?php echo $form->textFieldControlGroup($modelElectronic, 'date', array('class' => 'input-xlarge datepick', 'placeholder' => $modelElectronic->getAttributeLabel('date'))); ?>
                    <?php echo $form->textFieldControlGroup($modelElectronic, 'value', array('class' => 'input-xlarge', 'placeholder' => $modelElectronic->getAttributeLabel('value'))); ?>
                    <?php echo $form->textAreaControlGroup($modelElectronic, 'comment', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelElectronic->getAttributeLabel('comment'))); ?>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelElectronic->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>