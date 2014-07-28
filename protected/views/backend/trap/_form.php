<?php
/* @var $this TrapController */
/* @var $modelTrap Trap */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'trap-form',
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

<?php echo $form->errorSummary($modelTrap); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelTrap, 'pest_id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('pest_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrap, 'block_id', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('block_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrap, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('name'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrap, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('creator_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrap, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('ordering'))); ?>
</div>

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelTrap, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('created_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrap, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('updated_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrap, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('status'))); ?>

                            <?php echo $form->textFieldControlGroup($modelTrap, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('is_deleted'))); ?>

                            <?php echo $form->textAreaControlGroup($modelTrap, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelTrap->getAttributeLabel('params'))); ?>
</div>

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelTrap->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>