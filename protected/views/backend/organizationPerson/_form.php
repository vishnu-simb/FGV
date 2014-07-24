<?php
/* @var $this OrganizationPersonController */
/* @var $modelOrganizationPerson OrganizationPerson */
/* @var $form TbActiveForm */
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'organization-person-form',
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

<?php echo $form->errorSummary($modelOrganizationPerson); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'player_biography_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('player_biography_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'code', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('code'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'first_name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('first_name'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'last_name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('last_name'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'slug', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('slug'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'old_member_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('old_member_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'gender_id', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('gender_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'date_of_birth', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('date_of_birth'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'nationality', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('nationality'))); ?>
</div>

                            <div class="span6"><?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'country', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('country'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'country_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('country_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('creator_id'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('ordering'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('created_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('updated_at'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('status'))); ?>

                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('is_deleted'))); ?>

                            <?php echo $form->textAreaControlGroup($modelOrganizationPerson, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('params'))); ?>
</div>

                            <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelOrganizationPerson->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>