<?php
/* @var $this SizingController */
/* @var $modelSizing Sizing */
/* @var $form TbActiveForm */
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'sizing-form',
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
<?php echo $form->errorSummary($modelSizing); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
                    <?php echo $form->dropDownListControlGroup($modelSizing, 'block_id', CHtml::listData( $modelSizing->getBlock() ,'id','name'),array('empty'=>'Select A Block', 'class' => 'input-xlarge select2-minw'))?>
                    <?php echo $form->dropDownListControlGroup($modelSizing, 'variety_id', CHtml::listData( $modelSizing->getVariety() ,'id','name'),array('empty'=>'Select A Variety', 'class' => 'input-xlarge select2-minw'))?>
                    <?php echo $form->textFieldControlGroup($modelSizing, 'date', array('class' => 'input-xlarge datepick', 'placeholder' => $modelSizing->getAttributeLabel('date'))); ?>
                    <?php echo $form->textFieldControlGroup($modelSizing, 'value', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('value'))); ?>
					<?php echo $form->dropDownListControlGroup($modelSizing, 'type', SimbHtml::getEnumItem($modelSizing,'type'))?>
                    <?php //echo $form->textFieldControlGroup($modelSizing, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('creator_id'))); ?>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelSizing->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>