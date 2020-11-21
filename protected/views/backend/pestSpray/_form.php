<?php
/* @var $this PestSprayController */
/* @var $modelPestSpray PestSpray */
/* @var $form TbActiveForm */
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'pest-spray-form',
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
<?php echo $form->errorSummary($modelPestSpray); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
					<?php echo $form->dropDownListControlGroup($modelPestSpray, 'pest_id', CHtml::listData( $modelPestSpray->getPest() ,'id','name'),array('empty' => 'Select A Pest', 'class' => 'input-xlarge select2-minw'))?>
                    <?php echo $form->textFieldControlGroup($modelPestSpray, 'number', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('number'))); ?>
					<?php echo $form->dropDownListControlGroup($modelPestSpray, 'grower_id', CHtml::listData( $modelPestSpray->getGrower() ,'id','name'),array('empty' => 'Select A Grower', 'class' => 'input-xlarge select2-minw'))?>
                    <?php echo $form->textFieldControlGroup($modelPestSpray, 'dd', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('dd'))); ?>
                    <?php echo $form->textFieldControlGroup($modelPestSpray, 'every', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('every'))); ?>
                    <?php echo $form->textFieldControlGroup($modelPestSpray, 'lowpop_dd', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('lowpop_dd'))); ?>
                    <?php echo $form->textFieldControlGroup($modelPestSpray, 'lowpop_every', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('lowpop_every'))); ?>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelPestSpray->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>