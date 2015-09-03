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
            echo $form->dropDownList($modelSpray, 'rowsPerPage', $modelSpray->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">    
			<?php echo $form->dropDownListControlGroup($modelSpray, 'chemical_id', CHtml::listData( $modelSpray->getChemical() ,'id','name'),array('empty'=>'Select A Chemical'))?>
			<?php echo $form->dropDownListControlGroup($modelSpray, 'property', CHtml::listData( $modelSpray->getProperty() ,'id','name'),array('empty'=>'Select A Property'))?>
			<?php echo $form->textFieldControlGroup($modelSpray, 'date', array('class' => 'input datepick', 'placeholder' => $modelSpray->getAttributeLabel('date'))); ?>
        </div>	
        <div class="span6">    
            <?php echo $form->textFieldControlGroup($modelSpray, 'quantity', array('class' => 'input', 'placeholder' => $modelSpray->getAttributeLabel('quantity'))); ?>   
            <?php echo $form->dropDownListControlGroup($modelSpray, 'grower', CHtml::listData( $modelSpray->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))?>
			<?php echo $form->dropDownListControlGroup($modelSpray, 'block_id', CHtml::listData( $modelSpray->getBlock() ,'id','name'),array('empty'=>'Select A Block'))?>
        </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>