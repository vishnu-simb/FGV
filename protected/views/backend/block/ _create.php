<?php
/* @var $this BlockController */
/* @var $modelBlock Block */
/* @var $form TbActiveForm */
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'block-form',
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
<?php echo $form->errorSummary($modelBlock); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
					<?php echo $form->dropDownListControlGroup($modelBlock, 'property_id', CHtml::listData( $modelBlock->getProperty() ,'id','name'),array('empty' => 'Select A Property'))?>
                    <?php echo $form->textFieldControlGroup($modelBlock, 'name', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('name'))); ?>
                    <?php echo $form->textFieldControlGroup($modelBlock, 'tree_spacing', array('maxlength' => 11, 'class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('tree_spacing'))); ?>
					<?php echo $form->textFieldControlGroup($modelBlock, 'tree_variety', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('tree_variety'))); ?>
                    <?php echo $form->textFieldControlGroup($modelBlock, 'row_width', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('row_width'))); ?>
					<?php echo $form->inlineRadioButtonListControlGroup($modelBlock,'_addTrap', array('yes'=>'Yes','no'=>'No'))?>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelBlock->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>