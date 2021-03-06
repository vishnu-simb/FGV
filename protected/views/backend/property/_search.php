<?php
/* @var $this PropertyController */
/* @var $modelProperty Property */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>
<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelProperty, 'rowsPerPage', $modelProperty->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">
			<?php echo $form->dropDownListControlGroup($modelProperty, 'grower_id', CHtml::listData( $modelProperty->getGrower() ,'id','name'),array('empty'=>'Select A Grower', 'class' => 'select2-minw'))?>
            <?php echo $form->dropDownListControlGroup($modelProperty, 'location_id', CHtml::listData( $modelProperty->getLocation() ,'id','name'),array('empty'=>'Select A Location', 'class' => 'select2-minw'))?>
        </div>
        <div class="span6">
            <?php echo $form->dropDownListControlGroup($modelProperty, 'name',CHtml::listData( $modelProperty->findAll() ,'name','name'),array('empty'=>'Select A Property', 'class' => 'select2-minw')); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>