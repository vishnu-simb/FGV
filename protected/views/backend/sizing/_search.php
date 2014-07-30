<?php
/* @var $this SizingController */
/* @var $modelSizing Sizing */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelSizing, 'rowsPerPage', $modelSizing->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelSizing, 'id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'block_id', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('block_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'variety_id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('variety_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'date', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('date'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'value', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('value'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelSizing, 'type', array('maxlength' => 6, 'class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('type'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('updated_at'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelSizing, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSizing, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelSizing->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelSizing, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelSizing->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>