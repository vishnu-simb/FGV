<?php
/* @var $this TrapCheckController */
/* @var $modelTrapCheck TrapCheck */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    
    <?php echo $form->dropDownList($modelTrapCheck, 'rowsPerPage', $modelTrapCheck->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();")); ?>
    <?php echo $form->dropDownList($modelTrapCheck, 'date_range', array('1'=>'From last month','2'=>'From last 3 month','3'=>'From last 6 month','4'=>'Show All'), array('class'=> 'posts-date-range', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?>
</div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span4">     
            <?php echo $form->dropDownListControlGroup($modelTrapCheck, 'property', CHtml::listData( $modelTrapCheck->getPropertyByGrower() ,'id','name'),array('empty'=>'Select A Property'))?>
                 
            <?php echo $form->dropDownListControlGroup($modelTrapCheck, 'block', CHtml::listData( $modelTrapCheck->getBlockByProperty() ,'id','name'),array('empty'=>'Select A Block'))?>
          
          	<?php echo $form->dropDownListControlGroup($modelTrapCheck, 'trap', CHtml::listData( $modelTrapCheck->getTrapByBlock() ,'name','name'),array('empty'=>'Select A Trap'))?>
        </div>	 
        <div class="span4">       
			<?php echo $form->textFieldControlGroup($modelTrapCheck, 'date', array('class' => 'input-medium datepick', 'placeholder' => $modelTrapCheck->getAttributeLabel('date'))); ?>

            <?php echo $form->textFieldControlGroup($modelTrapCheck, 'value', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('value'))); ?>
			
			<?php echo $form->textAreaControlGroup($modelTrapCheck, 'comment', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelTrapCheck->getAttributeLabel('comment'))); ?>
		</div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
