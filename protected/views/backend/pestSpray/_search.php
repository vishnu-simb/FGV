<?php
/* @var $this PestSprayController */
/* @var $modelPestSpray PestSpray */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>
<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelPestSpray, 'rowsPerPage', $modelPestSpray->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">    
			<?php echo $form->dropDownListControlGroup($modelPestSpray, 'pest_id', CHtml::listData( $modelPestSpray->getPest() ,'id','name'),array('empty' => 'Select A Pest', 'class' => 'select2-minw'))?>
			<?php echo $form->dropDownListControlGroup($modelPestSpray, 'grower_id', CHtml::listData( $modelPestSpray->getGrower() ,'id','name'),array('empty' => 'Select A Grower', 'class' => 'select2-minw'))?>
            <?php echo $form->textFieldControlGroup($modelPestSpray, 'number', array('class' => 'input', 'placeholder' => $modelPestSpray->getAttributeLabel('number'))); ?>
            <?php echo $form->textFieldControlGroup($modelPestSpray, 'dd', array('class' => 'input', 'placeholder' => $modelPestSpray->getAttributeLabel('dd'))); ?>
        </div>
        <div class="span6">  
            <?php echo $form->textFieldControlGroup($modelPestSpray, 'every', array('class' => 'input', 'placeholder' => $modelPestSpray->getAttributeLabel('every'))); ?>
            <?php echo $form->textFieldControlGroup($modelPestSpray, 'lowpop_dd', array('class' => 'input', 'placeholder' => $modelPestSpray->getAttributeLabel('lowpop_dd'))); ?>
            <?php echo $form->textFieldControlGroup($modelPestSpray, 'lowpop_every', array('class' => 'input', 'placeholder' => $modelPestSpray->getAttributeLabel('lowpop_every'))); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>