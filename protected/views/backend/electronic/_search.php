<?php
/* @var $this ElectronicController */
/* @var $modelElectronic ElectronicMonitor */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>
<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    
    <?php echo $form->dropDownList($modelElectronic, 'rowsPerPage', $modelElectronic->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();")); ?>
    <?php echo $form->dropDownList($modelElectronic, 'date_range', array('1'=>'From last month','2'=>'From last 3 month','3'=>'From last 6 month','4'=>'Show All'), array('class'=> 'posts-date-range', 'onchange' => "document.getElementById('".$form->id."').submit();"));?>
    <div class="clearfix"></div>
</div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">     
            <?php echo $form->dropDownListControlGroup($modelElectronic, 'property', CHtml::listData( $modelElectronic->getProperty() ,'id','name'),array('empty'=>'Select A Property', 'class' => 'select2-minw'))?>
            <?php echo $form->dropDownListControlGroup($modelElectronic, 'grower', CHtml::listData( $modelElectronic->getGrower() ,'id','name'),array('empty'=>'Select A Grower', 'class' => 'select2-minw'))?>
            <?php echo $form->textFieldControlGroup($modelElectronic, 'date', array('class' => 'input datepick', 'placeholder' => $modelElectronic->getAttributeLabel('date'))); ?>
            <?php echo $form->textAreaControlGroup($modelElectronic, 'comment', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelElectronic->getAttributeLabel('comment'))); ?>
        </div>	 
        <div class="span6">    
            <?php echo $form->dropDownListControlGroup($modelElectronic, 'pest_id', CHtml::listData( $modelElectronic->getPest() ,'id','name'),array('empty'=>'Select A Pest', 'class' => 'select2-minw'))?>
            <?php echo $form->dropDownListControlGroup($modelElectronic, 'block', CHtml::listData( $modelElectronic->getBlock() ,'id','name'),array('empty'=>'Select A Block', 'class' => 'select2-minw'))?>
          	<?php echo $form->dropDownListControlGroup($modelElectronic, 'trap', CHtml::listData( $modelElectronic->getTrap()->getData() ,'name','name'),array('empty'=>'Select A Trap', 'class' => 'select2-minw'))?>
            <?php echo $form->textFieldControlGroup($modelElectronic, 'value', array('class' => 'input', 'placeholder' => $modelElectronic->getAttributeLabel('value'))); ?>
        </div>
   </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>