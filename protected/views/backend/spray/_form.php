<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'spray-form',
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

<?php echo $form->errorSummary($modelSpray); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6">
                            
                            <?php echo $form->dropDownListControlGroup($modelSpray, 'chemical_id', CHtml::listData( $modelSpray->getChemical() ,'id','name'),array('empty'=>'Select A Chemical'))?>

                            <?php echo $form->textFieldControlGroup($modelSpray, 'date', array('class' => 'input-medium datepick', 'placeholder' => $modelSpray->getAttributeLabel('date'))); ?>

                            <?php echo $form->textFieldControlGroup($modelSpray, 'quantity', array('class' => 'ispinner nput-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('quantity'))); ?>

                            <?php echo $form->dropDownListControlGroup($modelSpray, 'block_id', CHtml::listData( $modelSpray->getBlock() ,'id','name'),array('empty'=>'Select A Block'))?>
                             
                            <?php //echo $form->textFieldControlGroup($modelSpray, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('creator_id'))); ?>
</div>
							<!-- 
                            <div class="span6"><?php //echo $form->textFieldControlGroup($modelSpray, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('ordering'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelSpray, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('created_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelSpray, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('updated_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelSpray, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('status'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelSpray, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('is_deleted'))); ?>

                            <?php //echo $form->textAreaControlGroup($modelSpray, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelSpray->getAttributeLabel('params'))); ?>
							 -->
                            </div>

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelSpray->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>