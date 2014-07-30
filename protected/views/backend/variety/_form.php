<?php
/* @var $this VarietyController */
/* @var $modelVariety Variety */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'variety-form',
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

<?php echo $form->errorSummary($modelVariety); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6">
                            
                            <?php echo $form->textFieldControlGroup($modelVariety, 'name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('name'))); ?>
							<!--  
                            <?php //echo $form->textFieldControlGroup($modelVariety, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('creator_id'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelVariety, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('ordering'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelVariety, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('created_at'))); ?>

                            -->
                            </div>

                            <!-- 
                            <div class="span6">
                            
                            <?php //echo $form->textFieldControlGroup($modelVariety, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('updated_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelVariety, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('status'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelVariety, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('is_deleted'))); ?>

                            <?php //echo $form->textAreaControlGroup($modelVariety, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelVariety->getAttributeLabel('params'))); ?>

                            </div>  -->

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelVariety->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>