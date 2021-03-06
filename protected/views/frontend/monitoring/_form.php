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
<?php echo $form->errorSummary($modelMonitor); ?>

<div class="search-form-ext">
    <div class="box-content nopadding">

                    <div class="span12"> 
                       
              			  <?php echo $form->dropDownListControlGroup($modelMonitor, 'block_id', CHtml::listData($modelMonitor->getGrowerBlock()->getData() ,'id','block_name'), array('class' => 'input-xxlarge select2-minw'))?>
    					  
                    	  <?php echo $form->dropDownListControlGroup($modelMonitor, 'mite_id', CHtml::listData($modelMonitor->getMite() ,'id','name'), array('class' => 'input-xxlarge select2-minw'))?>
    					  
                          <?php echo $form->textFieldControlGroup($modelMonitor, 'date', array('class' => 'input-xxlarge datepick', 'placeholder' => $modelMonitor->getAttributeLabel('date'))); ?>

                          <?php echo $form->textFieldControlGroup($modelMonitor, 'percent_li', array('class' => 'spinner input-xxlarge', 'placeholder' => $modelMonitor->getAttributeLabel('percentage'))); ?>
			  				
			  			  <?php echo $form->textFieldControlGroup($modelMonitor, 'average_li', array('class' => 'spinner input-xxlarge', 'placeholder' => $modelMonitor->getAttributeLabel('average_number'))); ?>
							
						  <?php echo $form->textFieldControlGroup($modelMonitor, 'no_days', array('class' => 'spinner input-xxlarge', 'placeholder' => $modelMonitor->getAttributeLabel('no_days'))); ?>
	
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
