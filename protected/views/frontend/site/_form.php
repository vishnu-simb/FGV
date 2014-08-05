<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	       'id'=>'spray-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
           'enableAjaxValidation'=>false,
           'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate'),
            // for enabling client validation
           'enableClientValidation' => false,
           'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
)); ?>

<div class="search-form-ext">
    <div class="box-content nopadding">

                    <div class="span12">
                    	 <div style="float:left;">
                     	  <?php echo $form->dropDownList($modelBlock, 'id', CHtml::listData( $modelBlock->findAll() ,'id','name','property.name'), array('class' => 'input-xxlarge'))?>

                    	  <?php echo $form->dropDownList($modelGrower, 'id', CHtml::listData( $modelGrower->findAll() ,'id','name'), array('class' => 'input-xlarge'))?>
                          </div>
                       
            		</div>

            </div>
   
</div><!-- search-form -->

<?php $this->endWidget(); ?>
