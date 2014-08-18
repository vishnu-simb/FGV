<?php
/* @var $this VarietyController */
/* @var $modelVariety Variety */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelVariety, 'rowsPerPage', $modelVariety->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">    
                    						
                    						<?php echo $form->textFieldControlGroup($modelVariety, 'id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelVariety, 'name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('name'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelVariety, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('creator_id'))); ?>

            </div>	<!-- 
                    <div class="span4">    <?php //echo $form->textFieldControlGroup($modelVariety, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelVariety, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('created_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelVariety, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('updated_at'))); ?>

            </div>
                    <div class="span4">    <?php //echo $form->textFieldControlGroup($modelVariety, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('status'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelVariety, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelVariety->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelVariety, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelVariety->getAttributeLabel('params'))); ?>

            </div> -->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
