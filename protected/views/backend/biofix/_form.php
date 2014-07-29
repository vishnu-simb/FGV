<?php
/* @var $this BiofixController */
/* @var $modelBiofix Biofix */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'biofix-form',
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

<?php echo $form->errorSummary($modelBiofix); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelBiofix, 'pest_id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('pest_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'block_id', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('block_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'second_cohort', array('maxlength' => 3, 'class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('second_cohort'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'date', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('date'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('creator_id'))); ?>
</div>

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelBiofix, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('ordering'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('created_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('updated_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('status'))); ?>

                            <?php echo $form->textFieldControlGroup($modelBiofix, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('is_deleted'))); ?>

                            <?php echo $form->textAreaControlGroup($modelBiofix, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelBiofix->getAttributeLabel('params'))); ?>
</div>

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelBiofix->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>