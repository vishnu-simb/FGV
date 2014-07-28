<?php
/* @var $this LocationController */
/* @var $modelLocation Location */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelLocation, 'rowsPerPage', $modelLocation->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelLocation, 'id', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelLocation, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelLocation, 'observation', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('observation'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelLocation, 'forcast', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('forcast'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelLocation, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelLocation, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelLocation, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelLocation, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('updated_at'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelLocation, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelLocation, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelLocation, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelLocation->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
