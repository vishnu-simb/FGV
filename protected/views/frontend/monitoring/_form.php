<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	       'id'=>'trapCheck-form',
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
<?php echo $form->errorSummary($modelMonitorCheck); ?>

<div class="search-form-ext">
    <div class="box-content nopadding">

                    <div class="span12">    
              
                    	  <?php echo $form->dropDownListControlGroup($modelMonitorCheck, 'monitor', CHtml::listData($modelMonitorCheck->getMite() ,'id','name'), array('class' => 'input-xxlarge','disabled '=>'true'))?>
    					  
                          <?php echo $form->textFieldControlGroup($modelMonitorCheck, 'date', array('class' => 'input-xxlarge', 'placeholder' => $modelMonitorCheck->getAttributeLabel('date'),'readonly'=>'true')); ?>

                          <?php echo $form->textFieldControlGroup($modelMonitorCheck, 'percentage', array('class' => 'spinner input-xxlarge', 'placeholder' => $modelMonitorCheck->getAttributeLabel('percentage'))); ?>
			  				
			  			  <?php echo $form->textFieldControlGroup($modelMonitorCheck, 'average_number', array('class' => 'spinner input-xxlarge', 'placeholder' => $modelMonitorCheck->getAttributeLabel('average_number'))); ?>
	
            		</div>

            		<div class="span12">
            		 <div class="form-actions">
     					<?php echo TbHtml::submitButton(Yii::t('app', 'Save Changes'),array(
                            'color'=>'','class'=>'input-xxlarge btn btn-large',
                        )); ?>
                        </div>
    </div>
            </div>
   
</div><!-- search-form -->

<?php $this->endWidget(); ?>
