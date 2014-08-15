<?php
/* @var $this TrapCheckController */
/* @var $modelTrapCheck TrapCheck */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelTrapCheck, 'rowsPerPage', $modelTrapCheck->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            echo $form->dropDownList($modelTrapCheck, 'rowsPerPage', $modelTrapCheck->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">     <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('id'))); ?>
											
						
                                           	<?php echo $form->dropDownListControlGroup($modelTrapCheck, 'property', CHtml::listData( $modelTrapCheck->getProperty() ,'id','name'),array('empty'=>'Select A Property'))?>
                             
				                            <?php echo $form->dropDownListControlGroup($modelTrapCheck, 'grower', CHtml::listData( $modelTrapCheck->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))?>
				                         
				                            <?php echo $form->dropDownListControlGroup($modelTrapCheck, 'block', CHtml::listData( $modelTrapCheck->getBlock() ,'id','name'),array('empty'=>'Select A Block'))?>
				                          
				                          	<?php echo $form->dropDownListControlGroup($modelTrapCheck, 'trap_id', CHtml::listData( $modelTrapCheck->getTrap() ,'id','name'),array('empty'=>'Select A Trap'))?>
				                            
				                        
                                            
            </div>	 
                    <div class="span4">       
                    						<?php echo $form->textFieldControlGroup($modelTrapCheck, 'date', array('class' => 'input-medium datepick', 'placeholder' => $modelTrapCheck->getAttributeLabel('date'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrapCheck, 'value', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('value'))); ?>
 											
 											<?php echo $form->textAreaControlGroup($modelTrapCheck, 'comment', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelTrapCheck->getAttributeLabel('comment'))); ?>
 											
 											    
                                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('creator_id'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('created_at'))); ?>

            </div><!-- 
                    <div class="span4">     <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('updated_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('status'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelTrapCheck, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelTrapCheck, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelTrapCheck->getAttributeLabel('params'))); ?>

            </div>-->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
