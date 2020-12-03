<?php
/* @var $this CropController */
/* @var $modelCrop CropMonitor */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>
<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    
    <?php echo $form->dropDownList($modelCrop, 'rowsPerPage', $modelCrop->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();")); ?>
    <?php echo $form->dropDownList($modelCrop, 'date_range', array('1'=>'From last month','2'=>'From last 3 month','3'=>'From last 6 month','4'=>'Show All'), array('class'=> 'posts-date-range', 'onchange' => "document.getElementById('".$form->id."').submit();"));?>
    <div class="clearfix"></div>
</div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">     
            <?php echo $form->dropDownListControlGroup($modelCrop, 'property', CHtml::listData( $modelCrop->getProperty() ,'id','name'),array('empty'=>'Select A Property', 'class' => 'select2-minw'))?>
            <?php echo $form->dropDownListControlGroup($modelCrop, 'grower', CHtml::listData( $modelCrop->getGrower() ,'id','name'),array('empty'=>'Select A Grower', 'class' => 'select2-minw'))?>
            <?php echo $form->textFieldControlGroup($modelCrop, 'date', array('class' => 'input datepick', 'placeholder' => $modelCrop->getAttributeLabel('date'))); ?>
            <?php echo $form->textAreaControlGroup($modelCrop, 'comment', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelCrop->getAttributeLabel('comment'))); ?>
        </div>	 
        <div class="span6">    
            <?php echo $form->dropDownListControlGroup($modelCrop, 'pest_id', CHtml::listData( $modelCrop->getPest() ,'id','name'),array('empty'=>'Select A Pest', 'class' => 'select2-minw'))?>
            <?php echo $form->dropDownListControlGroup($modelCrop, 'block', CHtml::listData( $modelCrop->getBlock() ,'id','name'),array('empty'=>'Select A Block', 'class' => 'select2-minw'))?>
          	<?php echo $form->dropDownListControlGroup($modelCrop, 'trap', CHtml::listData( $modelCrop->getTrap()->getData() ,'name','name'),array('empty'=>'Select A Trap', 'class' => 'select2-minw'))?>
            <?php echo $form->textFieldControlGroup($modelCrop, 'value', array('class' => 'input', 'placeholder' => $modelCrop->getAttributeLabel('value'))); ?>
        </div>
   </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>