<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelSpray, 'rowsPerPage', $modelSpray->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelSpray, 'id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'chemical_id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('chemical_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'date', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('date'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'quantity', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('quantity'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelSpray, 'block_id', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('block_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('created_at'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelSpray, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('updated_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelSpray, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelSpray, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelSpray->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>