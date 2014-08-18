<?php
/* @var $this PropertyController */
/* @var $modelProperty Property */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelProperty, 'rowsPerPage', $modelProperty->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">    
   
 											<?php echo $form->dropDownListControlGroup($modelProperty, 'grower_id', CHtml::listData( $modelProperty->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))?>
                    
                                            <?php echo $form->dropDownListControlGroup($modelProperty, 'location_id', CHtml::listData( $modelProperty->getLocation() ,'id','name'),array('empty'=>'Select A Location'))?>
 											
                                            <?php echo $form->dropDownListControlGroup($modelProperty, 'name',CHtml::listData( $modelProperty->findAll() ,'name','name'),array('empty'=>'Select A Property')); ?>

            </div>	<!--  
                    <div class="span4">     <?php //echo $form->textFieldControlGroup($modelProperty, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('creator_id'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelProperty, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelProperty, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('created_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelProperty, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('updated_at'))); ?>

            </div>
                    <div class="span4">            <?php //echo $form->textFieldControlGroup($modelProperty, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('status'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelProperty, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelProperty->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelProperty, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelProperty->getAttributeLabel('params'))); ?>

            </div>-->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
