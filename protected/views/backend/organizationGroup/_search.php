<?php
/* @var $this OrganizationGroupController */
/* @var $modelOrganizationGroup OrganizationGroup */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelOrganizationGroup, 'rowsPerPage', $modelOrganizationGroup->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'code', array('maxlength' => 64, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('code'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'number', array('maxlength' => 16, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('number'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'display_name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('display_name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'contact', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('contact'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'address', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('address'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'address2', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('address2'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'address3', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('address3'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'city', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('city'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'state', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('state'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'country', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('country'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'country_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('country_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'phone', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('phone'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'fax', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('fax'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'postal_code', array('maxlength' => 16, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('postal_code'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'email', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('email'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'website', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('website'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'latitude', array('maxlength' => 32, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('latitude'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'longtitude', array('maxlength' => 32, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('longtitude'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'parent_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('parent_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'level', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('level'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'organization_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('organization_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'organization_level_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('organization_level_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'slug', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('slug'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('updated_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOrganizationGroup, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelOrganizationGroup, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelOrganizationGroup->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
