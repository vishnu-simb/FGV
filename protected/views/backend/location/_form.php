<?php
/* @var $this LocationController */
/* @var $modelLocation Location */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'location-form',
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

<?php echo $form->errorSummary($modelLocation); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6">
                            <?php echo $form->textFieldControlGroup($modelLocation, 'id', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelLocation, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('name'))); ?>

                            <?php echo $form->textFieldControlGroup($modelLocation, 'observation', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('observation'))); ?>

                            <?php echo $form->textFieldControlGroup($modelLocation, 'forcast', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('forcast'))); ?>
							<!-- 
                            <?php //echo $form->textFieldControlGroup($modelLocation, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('creator_id'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelLocation, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('ordering'))); ?>
							-->
							</div>
							<!-- 
                            <div class="span6">
                            
                            <?php //echo $form->textFieldControlGroup($modelLocation, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('created_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelLocation, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('updated_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelLocation, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('status'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelLocation, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('is_deleted'))); ?>

                            <?php //echo $form->textAreaControlGroup($modelLocation, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelLocation->getAttributeLabel('params'))); ?>
</div>-->

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelLocation->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>