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
<?php echo $form->errorSummary($modelTrapCheck); ?>

<div class="search-form-ext">
    <div class="box-content nopadding">

                    <div class="span12">  
                      
                    	  <?php 
                            if (Yii::app()->user->getState('role') !== Users::USER_TYPE_GROWER)
                                echo $form->dropDownListControlGroup($modelTrapCheck, 'trap_id', CHtml::listData( $modelTrapCheck->getTrap()->getData() ,'id','trap_name'), array('class' => 'input-xxlarge select2-minw'));
                            else
                                echo $form->dropDownListControlGroup($modelTrapCheck, 'trap_id', CHtml::listData( $modelTrapCheck->getTrapByGrower() ,'id','name'), array('class' => 'input-xxlarge select2-minw'))
                          ?>
    					  
                          <?php echo $form->textFieldControlGroup($modelTrapCheck, 'date', array('class' => 'input-xxlarge datepick', 'placeholder' => $modelTrapCheck->getAttributeLabel('date'))); ?>

                          <?php echo $form->textFieldControlGroup($modelTrapCheck, 'value', array('class' => 'spinner input-xxlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('value'))); ?>
			  
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
