<?php
/* @var $this UserController */
/* @var $modelUser User */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'user-form',
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

<?php echo $form->errorSummary($modelUser); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelUser, 'username', array('maxlength' => 32, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('username'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'email', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('email'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'display_name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('display_name'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'slug', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('slug'))); ?>

                            <?php echo $form->passwordFieldControlGroup($modelUser, 'password', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('password'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'salt', array('maxlength' => 8, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('salt'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'is_super_admin', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('is_super_admin'))); ?>
</div>

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelUser, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('creator_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('ordering'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('created_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('updated_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('status'))); ?>

                            <?php echo $form->textFieldControlGroup($modelUser, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('is_deleted'))); ?>

                            <?php echo $form->textAreaControlGroup($modelUser, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelUser->getAttributeLabel('params'))); ?>
</div>

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelUser->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>