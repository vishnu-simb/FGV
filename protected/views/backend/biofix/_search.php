<?php
/* @var $this BiofixController */
/* @var $modelBiofix Biofix */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelBiofix, 'rowsPerPage', $modelBiofix->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelBiofix, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'pest_id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('pest_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'block_id', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('block_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'second_cohort', array('maxlength' => 3, 'class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('second_cohort'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelBiofix, 'date', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('date'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('created_at'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelBiofix, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('updated_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelBiofix, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelBiofix, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelBiofix->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
