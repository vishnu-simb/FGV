<?php
/* @var $this GrowerController */
/* @var $modelGrower Grower */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-form-ext">
    <div class="box-content nopadding">

                    <div class="span4">     
                    <?php echo $form->textField($modelGrower, 'name', array('class' => 'input-xxlarge', 'placeholder' => $modelGrower->getAttributeLabel('name'),'onchange' => "document.getElementById('".$form->id."').submit();")); ?>

            </div>
        
            </div>

</div><!-- search-form -->

<?php $this->endWidget(); ?>
