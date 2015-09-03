<?php
/* @var $this MonitoringController */
/* @var $modelMiteMonitor MiteMonitor */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>
<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelMiteMonitor, 'rowsPerPage', $modelMiteMonitor->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">      
            <?php echo $form->dropDownListControlGroup($modelMiteMonitor, 'mite_id', CHtml::listData( $modelMiteMonitor->getMite() ,'id','name'),array('empty'=>'Select A Mite'))?>
			<?php echo $form->dropDownListControlGroup($modelMiteMonitor, 'block_id', CHtml::listData( $modelMiteMonitor->getBlock() ,'id','name'),array('empty'=>'Select A Block'))?>
            <?php echo $form->textFieldControlGroup($modelMiteMonitor, 'date', array('class' => 'input', 'placeholder' => $modelMiteMonitor->getAttributeLabel('date'))); ?>
        </div>
        <div class="span6">      
            <?php echo $form->textFieldControlGroup($modelMiteMonitor, 'percent_li', array('class' => 'input', 'placeholder' => $modelMiteMonitor->getAttributeLabel('percent_li'))); ?>
	        <?php echo $form->textFieldControlGroup($modelMiteMonitor, 'no_days', array('class' => 'input', 'placeholder' => $modelMiteMonitor->getAttributeLabel('no_days'))); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>