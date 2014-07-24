<?php
/* @var $this OrganizationPersonController */
/* @var $modelOrganizationPerson OrganizationPerson */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelOrganizationPerson, 'rowsPerPage', $modelOrganizationPerson->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'player_biography_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('player_biography_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'code', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('code'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'first_name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('first_name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'last_name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('last_name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'slug', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('slug'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'old_member_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('old_member_id'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'gender_id', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('gender_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'date_of_birth', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('date_of_birth'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'nationality', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('nationality'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'country', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('country'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'country_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('country_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('ordering'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('updated_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationPerson, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelOrganizationPerson, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelOrganizationPerson->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
