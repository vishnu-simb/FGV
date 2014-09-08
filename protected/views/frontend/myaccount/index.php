<?php
/* @var $this MyAccountController */
/* @var $modelGrower Grower */
/* @var $form TbActiveForm */
?>

<?php
$this->breadcrumbs = array(
	Yii::t('app', 'My Account')
);
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
                'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate', 'enctype' => 'multipart/form-data',),
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
                <div class="span6">
                    <?php echo $form->textFieldControlGroup($modelGrower, 'username', array('disabled'=>true, 'class' => 'input-xlarge')); ?>
                    <?php echo $form->textFieldControlGroup($modelGrower, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('name'))); ?>
                    <?php echo $form->passwordFieldControlGroup($modelGrower, 'password', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('password'),'value'=>'')); ?>
                    <?php echo $form->passwordFieldControlGroup($modelGrower, '_repassword', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('_repassword'),'value'=>'')); ?>
                    <?php echo $form->textAreaControlGroup($modelGrower, 'email', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelGrower->getAttributeLabel('email'))); ?>
            		<?php echo $form->dropDownListControlGroup($modelGrower, 'reporting', SimbHtml::getEnumItem($modelGrower,'reporting'), array('class' => 'input-xlarge'))?>
                    <?php echo $form->fileFieldControlGroup($modelGrower, 'avatar', array('class' => 'input-xlarge'))?>
                    <?php if($modelGrower->avatar && file_exists(Yii::app()->basePath.'/../avatars/'.$modelGrower->avatar.'_27x27.jpg')): ?>
                    <div class="control-group">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <?php echo CHtml::image('/avatars/'.$modelGrower->avatar.'_27x27.jpg',"image"); ?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
            <div class="box-title" style="margin-top: 0;border-top: none;">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'Contact Details') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
                    <?php echo $form->textFieldControlGroup($modelGrower, 'contact_name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('contact_name'))); ?>
                    <?php echo $form->textFieldControlGroup($modelGrower, 'address', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('address'))); ?>
                    <?php echo $form->textFieldControlGroup($modelGrower, 'suburb', array('maxlength' => 50, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('suburb'))); ?>
                    <?php echo $form->textFieldControlGroup($modelGrower, 'postcode', array('maxlength' => 5, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('postcode'))); ?>
            		<?php echo $form->dropDownListControlGroup($modelGrower, 'state', SimbHtml::getEnumItem($modelGrower,'state'), array('class' => 'input-xlarge'))?>
                    <?php echo $form->textFieldControlGroup($modelGrower, 'phone', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('phone'))); ?>
                    <?php echo $form->textFieldControlGroup($modelGrower, 'mobile', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('mobile'))); ?>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton(Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>