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
                   							<!--  
                    						<?php //echo $form->textFieldControlGroup($modelBiofix, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('id'))); ?>
											-->
                                            <?php echo $form->dropDownListControlGroup($modelBiofix, 'pest_id', CHtml::listData( $modelBiofix->getPest() ,'id','name'),array('empty' => 'Select A Pest'))?>

                            				<?php echo $form->dropDownListControlGroup($modelBiofix, 'block_id', CHtml::listData( $modelBiofix->getBlock()->getData() ,'id','name'),array('empty' => 'Select A Block'))?>
                                            
                                            <?php echo $form->dropDownListControlGroup($modelBiofix, 'second_cohort', array('yes'=>'Yes','no'=>'No'),array('empty' => 'Select A Second Cohort'))?>
                            
           									 </div>
                    <div class="span4">          
											<?php echo $form->dropDownListControlGroup($modelBiofix, 'property', CHtml::listData( $modelBiofix->getProperty() ,'id','name'),array('empty'=>'Select A Property'))?>
											
											<?php echo $form->dropDownListControlGroup($modelBiofix, 'grower', CHtml::listData( $modelBiofix->getGrower() ,'id','name'),array('empty' => 'Select A Grower'))?>
											
											<?php echo $form->textFieldControlGroup($modelBiofix, 'date', array('class' => 'input-medium datepick', 'placeholder' => $modelBiofix->getAttributeLabel('date'))); ?>
           
                                            <?php //echo $form->textFieldControlGroup($modelBiofix, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('creator_id'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBiofix, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBiofix, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('created_at'))); ?>

            </div><!-- 
                    <div class="span4">            
                    						<?php //echo $form->textFieldControlGroup($modelBiofix, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('updated_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBiofix, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('status'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBiofix, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelBiofix->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelBiofix, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelBiofix->getAttributeLabel('params'))); ?>

            </div> -->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
