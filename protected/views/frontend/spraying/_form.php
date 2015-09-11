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
                    
                    	 <?php 
                    		if(Yii::app()->user->getState('role') == Users::USER_TYPE_GROWER){

                    			echo $form->dropDownListControlGroup($modelSpray, 'block_id', CHtml::listData($modelSpray->getBlockByAttributes(Yii::app()->user->id),'id','name','property.name'), array('class' => 'input-xxlarge', 'multiple' => 'multiple', 'style' => 'height: 120px'));
                    		
							}else{

                    			echo $form->dropDownListControlGroup($modelSpray, 'block_id', CHtml::listData($modelSpray->getBlock() ,'id','name','property.name'), array('class' => 'input-xxlarge'));
                    		}
                    	  ?>
                             
                          <?php echo $form->dropDownListControlGroup($modelSpray, 'chemical_id', CHtml::listData( $modelSpray->getChemical() ,'id','name'),array('class' => 'input-xxlarge'))?>
                    						
                          <?php echo $form->textFieldControlGroup($modelSpray, 'date', array('class' => 'input-xxlarge datepick', 'placeholder' => $modelSpray->getAttributeLabel('date'))); ?>

                          <?php echo $form->textFieldControlGroup($modelSpray, 'quantity', array('class' => 'spinner input-xxlarge', 'placeholder' => $modelSpray->getAttributeLabel('quantity'))); ?>
			  
            		</div>

            		<div class="span12">
            		 <div class="form-actions">
     					<?php echo TbHtml::submitButton($modelSpray->isNewRecord ? Yii::t('app', 'Add Spraying') : Yii::t('app', 'Save Changes'),array(
                            'color'=>'','class'=>'input-xxlarge btn btn-large',
                        )); ?>
                        </div>
    </div>
            </div>
   
</div><!-- search-form -->

<?php $this->endWidget(); ?>
