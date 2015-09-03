<?php
/* @var $this PestController */
/* @var $modelPest Pest */
/* @var $form TbActiveForm */
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'pest-form',
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
<?php echo $form->errorSummary($modelPest); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
                    <?php echo $form->textFieldControlGroup($modelPest, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('name'))); ?>
                    <?php echo $form->textFieldControlGroup($modelPest, 'dd', array('class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('dd'))); ?>
    				<?php echo $form->dropDownListControlGroup($modelPest, 'calculate', array('yes'=>'Yes','no'=>'No'))?>
    				<?php echo $form->textFieldControlGroup($modelPest, 'color', array('maxlength' => 100, 'class' => 'input-medium colorpick', 'placeholder' => $modelPest->getAttributeLabel('color'))); ?>
				</div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelPest->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>