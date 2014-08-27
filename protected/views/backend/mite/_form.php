<?php
/* @var $this MiteController */
/* @var $modelMite Mite */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'mite-form',
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

<?php echo $form->errorSummary($modelMite); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6">
                            
                            <?php echo $form->textFieldControlGroup($modelMite, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('name'))); ?>
							
							<?php echo $form->dropDownListControlGroup($modelMite, 'type', SimbHtml::getEnumItem($modelMite,'type'),array('empty' => 'Select Mite Type'))?>
                            
                            <?php echo $form->textFieldControlGroup($modelMite, 'color', array('maxlength' => 100, 'class' => 'input-medium colorpick', 'placeholder' => $modelMite->getAttributeLabel('color'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelMite, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('creator_id'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelMite, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('ordering'))); ?>
</div>
							<!-- 
                            <div class="span6">
                            
                            <?php //echo $form->textFieldControlGroup($modelMite, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('created_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelMite, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('updated_at'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelMite, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('status'))); ?>

                            <?php //echo $form->textFieldControlGroup($modelMite, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('is_deleted'))); ?>

                            <?php //echo $form->textAreaControlGroup($modelMite, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelMite->getAttributeLabel('params'))); ?>
</div> -->

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelMite->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>