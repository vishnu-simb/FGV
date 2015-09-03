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
        <div class="span12">   
            <?php echo $form->textFieldControlGroup($modelMite, 'name', array('maxlength' => 100, 'class' => 'input', 'placeholder' => $modelMite->getAttributeLabel('name'))); ?>
            <?php echo $form->dropDownListControlGroup($modelMite, 'type', SimbHtml::getEnumItem($modelMite,'type'),array('empty' => 'Select Mite Type'))?>
        </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>