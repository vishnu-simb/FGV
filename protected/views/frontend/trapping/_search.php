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
				    <?php echo $form->dropDownList($modelGrower,'username', CHtml::listData((Yii::app()->user->getState('role') === Users::USER_TYPE_ADMIN)?$modelGrower->findAll():$modelGrower->findAllByAttributes(array('id'=>Yii::app()->user->id)),'username','name'),array('class' => 'select2-me input-xxlarge','placeholder' => $modelGrower->getAttributeLabel('name'),'empty'=>'Please choose a grower','onchange' => "document.getElementById('".$form->id."').submit();"))?>
            </div>
        
            </div>

</div><!-- search-form -->

<?php $this->endWidget(); ?>
