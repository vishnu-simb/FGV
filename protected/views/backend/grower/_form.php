<?php
/* @var $this GrowerController */
/* @var $modelGrower Grower */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'grower-form',
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

<?php echo $form->errorSummary($modelGrower); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelGrower, 'grower_name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('grower_name'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'grower_username', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('grower_username'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'grower_password', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('grower_password'))); ?>

                            <?php echo $form->textAreaControlGroup($modelGrower, 'grower_email', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelGrower->getAttributeLabel('grower_email'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'grower_enabled', array('maxlength' => 3, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('grower_enabled'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'grower_reporting', array('maxlength' => 7, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('grower_reporting'))); ?>
</div>

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelGrower, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('creator_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('ordering'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('created_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('updated_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('status'))); ?>

                            <?php echo $form->textFieldControlGroup($modelGrower, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('is_deleted'))); ?>

                            <?php echo $form->textAreaControlGroup($modelGrower, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelGrower->getAttributeLabel('params'))); ?>
</div>

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelGrower->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>