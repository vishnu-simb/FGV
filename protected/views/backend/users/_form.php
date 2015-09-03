<?php
/* @var $this UsersController */
/* @var $modelUsers Users */
/* @var $form TbActiveForm */
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'users-form',
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
<?php echo $form->errorSummary($modelUsers); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
                    <?php echo $form->textFieldControlGroup($modelUsers, 'username', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('username'))); ?>
                    <?php echo $form->passwordFieldControlGroup($modelUsers, 'password', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('password'),'value'=>'')); ?>
                    <?php echo $form->passwordFieldControlGroup($modelUsers, '_repassword', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('_repassword'),'value'=>'')); ?>
                    <?php echo $form->dropDownListControlGroup($modelUsers, 'type', SimbHtml::getEnumItem($modelUsers,'type'))?>
				</div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelUsers->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>