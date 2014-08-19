<?php
/* @var $this PropertyController */
/* @var $modelProperty Property */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'property-form',
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

<?php echo $form->errorSummary($modelProperty); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6">
                            
                          	<?php echo $form->dropDownListControlGroup($modelProperty, 'grower_id', CHtml::listData( $modelProperty->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))?>
                          	
                            <?php echo $form->dropDownListControlGroup($modelProperty, 'location_id', CHtml::listData( $modelProperty->getLocation() ,'id','id'),array('empty'=>'Select A Location'))?>
                    
                           
                            <?php echo $form->textFieldControlGroup($modelProperty, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('name'))); ?>
							
                            <?php //echo $form->textFieldControlGroup($modelProperty, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('creator_id'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelProperty, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('ordering'))); ?>
</div>
							<!--  
                            <div class="span6"><?php //echo $form->textFieldControlGroup($modelProperty, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('created_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelProperty, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('updated_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelProperty, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('status'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelProperty, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('is_deleted'))); ?>

                            <?php //echo $form->textAreaControlGroup($modelProperty, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelProperty->getAttributeLabel('params'))); ?>
</div>-->

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelProperty->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>