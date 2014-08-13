<?php
/* @var $this BlockController */
/* @var $modelBlock Block */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelBlock, 'rowsPerPage', $modelBlock->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">     
                    						<!--  
                    						<?php //echo $form->textFieldControlGroup($modelBlock, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('id'))); ?>
											-->
											<?php echo $form->dropDownListControlGroup($modelBlock, 'property_id', CHtml::listData( $modelBlock->getProperty() ,'id','name'),array('empty' => 'Select A Property'))?>
											
											<?php echo $form->dropDownListControlGroup($modelBlock, 'location', CHtml::listData( $modelBlock->getLocation() ,'id','name'),array('empty' => 'Select A Location'))?>
											
											<?php echo $form->dropDownListControlGroup($modelBlock, 'grower', CHtml::listData( $modelBlock->getGrower() ,'id','name'),array('empty' => 'Select A Grower'))?>
											
											<?php echo $form->dropDownListControlGroup($modelBlock, 'name', CHtml::listData( $modelBlock->findAll() ,'name','name'),array('empty' => 'Select A Block'))?>
											
                                        
                                           
            </div>  
                    <div class="span4">     
                    						<?php echo $form->textFieldControlGroup($modelBlock, 'tree_spacing', array('maxlength' => 11, 'class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('tree_spacing'))); ?>
											
                    						<?php echo $form->textFieldControlGroup($modelBlock, 'row_width', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('row_width'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBlock, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('creator_id'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBlock, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBlock, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('created_at'))); ?>

            </div><!--
                    <div class="span4">     
                    						<?php //echo $form->textFieldControlGroup($modelBlock, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('updated_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBlock, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('status'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelBlock, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelBlock->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelBlock, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelBlock->getAttributeLabel('params'))); ?>

            </div>-->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
