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
            echo $form->dropDownList($modelSizing, 'rowsPerPage', $modelSizing->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">   
            <?php echo $form->dropDownListControlGroup($modelSizing, 'block_id', CHtml::listData( $modelSizing->getBlock() ,'id','name'),array('empty'=>'Select A Block', 'class' => 'select2-minw'))?>
            <?php echo $form->dropDownListControlGroup($modelSizing, 'variety_id', CHtml::listData( $modelSizing->getVariety() ,'id','name'),array('empty'=>'Select A Variety', 'class' => 'select2-minw'))?>
            <?php echo $form->textFieldControlGroup($modelSizing, 'date', array('class' => 'input datepick', 'placeholder' => $modelSizing->getAttributeLabel('date'))); ?>
        </div>
        <div class="span6">
            <?php echo $form->textFieldControlGroup($modelSizing, 'value', array('class' => 'input', 'placeholder' => $modelSizing->getAttributeLabel('value'))); ?>
            <?php echo $form->dropDownListControlGroup($modelSizing, 'type', SimbHtml::getEnumItem($modelSizing,'type'),array('empty'=>'Select A Type', 'class' => 'select2-minw'))?>
        </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>