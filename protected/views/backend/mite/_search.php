<?php
/* @var $this MiteController */
/* @var $modelMite Mite */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelMite, 'rowsPerPage', $modelMite->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">    <?php //echo $form->textFieldControlGroup($modelMite, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelMite, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('name'))); ?>

                                           <?php echo $form->dropDownListControlGroup($modelMite, 'type', SimbHtml::getEnumItem($modelMite,'type'),array('empty' => 'Select Mite Type'))?>
                           
                                            <?php //echo $form->textFieldControlGroup($modelMite, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('creator_id'))); ?>

            </div>
                    <div class="span4">     <?php //echo $form->textFieldControlGroup($modelMite, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelMite, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('created_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelMite, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('updated_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelMite, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('status'))); ?>

            </div>
                    <div class="span4">     <?php //echo $form->textFieldControlGroup($modelMite, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelMite->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelMite, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelMite->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
