<?php
/* @var $this BiofixController */
/* @var $modelBiofix Biofix */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelBiofix, 'rowsPerPage', $modelBiofix->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">     
                                            <?php echo $form->dropDownListControlGroup($modelBiofix, 'pest_id', CHtml::listData( $modelBiofix->getPest() ,'id','name'),array('empty' => 'Select A Pest'))?>
											
											<?php echo $form->dropDownListControlGroup($modelBiofix, 'grower', CHtml::listData( $modelBiofix->getGrower() ,'id','name'),array('empty' => 'Select A Grower'))?>
										
											<?php echo $form->dropDownListControlGroup($modelBiofix, 'property', CHtml::listData( $modelBiofix->getPropertyByGrower() ,'id','name'),array('empty'=>'Select A Property'))?>
											
											
                            				
           									 </div>
                    <div class="span4">     
                    						<?php echo $form->dropDownListControlGroup($modelBiofix, 'block_id', CHtml::listData( $modelBiofix->getBlockByProperty() ,'id','name'),array('empty' => 'Select A Block'))?>
                                            
                                            <?php echo $form->dropDownListControlGroup($modelBiofix, 'second_cohort', array('yes'=>'Yes','no'=>'No'),array('empty' => 'Select A Second Cohort'))?>
                            
											<?php echo $form->textFieldControlGroup($modelBiofix, 'date', array('class' => 'input-medium datepick', 'placeholder' => $modelBiofix->getAttributeLabel('date'))); ?>
           
            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
