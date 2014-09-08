<?php
/* @var $this TrapCheckController */
/* @var $modelTrapCheck TrapCheck */
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

<?php echo $form->errorSummary($modelTrapCheck); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6">
                            
                             <?php echo $form->dropDownListControlGroup($modelTrapCheck, 'trap_id', CHtml::listData( $modelTrapCheck->getTrap()->getData() ,'id','trap_name'),array('empty'=>'Select A Trap'))?>
                             
                            <?php echo $form->textFieldControlGroup($modelTrapCheck, 'date', array('class' => 'input-medium datepick', 'placeholder' => $modelTrapCheck->getAttributeLabel('date'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrapCheck, 'value', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('value'))); ?>

                            <?php echo $form->textAreaControlGroup($modelTrapCheck, 'comment', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelTrapCheck->getAttributeLabel('comment'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('creator_id'))); ?>
</div>
							<!--  
                            <div class="span6">
                            
                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('ordering'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('created_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('updated_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('status'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('is_deleted'))); ?>

                            <?php //echo $form->textAreaControlGroup($modelTrapCheck, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelTrapCheck->getAttributeLabel('params'))); ?>
</div>-->

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelTrapCheck->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>