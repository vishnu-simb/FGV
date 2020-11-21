<?php
/* @var $this BlockController */
/* @var $modelBlock Block */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>
<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelBlock, 'rowsPerPage', $modelBlock->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">     
			<?php echo $form->dropDownListControlGroup($modelBlock, 'property_id', CHtml::listData( $modelBlock->getProperty() ,'id','name'),array('empty' => 'Select A Property', 'class' => 'select2-minw'))?>
			<?php echo $form->dropDownListControlGroup($modelBlock, 'location', CHtml::listData( $modelBlock->getLocation() ,'id','name'),array('empty' => 'Select A Location', 'class' => 'select2-minw'))?>
			<?php echo $form->textFieldControlGroup($modelBlock, 'tree_spacing', array('maxlength' => 11, 'class' => 'input', 'placeholder' => $modelBlock->getAttributeLabel('tree_spacing'))); ?>
			<?php echo $form->textFieldControlGroup($modelBlock, 'row_width', array('class' => 'input', 'placeholder' => $modelBlock->getAttributeLabel('row_width'))); ?>
        </div>  
        <div class="span6">     
			<?php echo $form->dropDownListControlGroup($modelBlock, 'grower', CHtml::listData( $modelBlock->getGrower() ,'id','name'),array('empty' => 'Select A Grower', 'class' => 'select2-minw'))?>
			<?php echo $form->dropDownListControlGroup($modelBlock, 'name', CHtml::listData( $modelBlock->findAll() ,'name','name'),array('empty' => 'Select A Block', 'class' => 'select2-minw'))?>
            <?php echo $form->dropDownListControlGroup($modelBlock, 'tree_variety', CHtml::listData($modelBlock->getVariety() ,'id','name','fruit_type.name'), array('empty' => 'Select A Variety', 'class' => 'select2-minw')); ?>
        </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>