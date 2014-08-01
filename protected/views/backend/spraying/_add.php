<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'post',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate'),
		// for enabling client validation
		'enableClientValidation' => true,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<?php echo $form->errorSummary($modelSpray); ?>
<div class="search-form-ext">
    <div class="box-content nopadding">

                    <div class="span4">    
                    <select name="block">
					    
                          <?php echo $form->dropDownListControlGroup($modelSpray,'block_id', CHtml::listData($modelSpray->getBlock(),'id','name','property.name'))?>
                         
                          <?php echo $form->dropDownListControlGroup($modelSpray, 'chemical_id', CHtml::listData( $modelSpray->getChemical() ,'id','name'))?>
                    						
                          <?php echo $form->textFieldControlGroup($modelSpray, 'date', array('class' => 'input-medium datepick', 'placeholder' => $modelSpray->getAttributeLabel('date'))); ?>

                          <?php echo $form->textFieldControlGroup($modelSpray, 'quantity', array('class' => 'input-xlarge', 'placeholder' => $modelSpray->getAttributeLabel('quantity'))); ?>
			  
            		</div>
            </div>dropDownList
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Add Spraying'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
