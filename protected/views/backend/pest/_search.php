<?php
/* @var $this PestController */
/* @var $modelPest Pest */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelPest, 'rowsPerPage', $modelPest->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">     <!--  
                    					    <?php //echo $form->textFieldControlGroup($modelPest, 'id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('id'))); ?>
											-->
                                            <?php echo $form->textFieldControlGroup($modelPest, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPest, 'dd', array('class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('dd'))); ?>
											
											<?php echo $form->dropDownListControlGroup($modelPest, 'calculate', array('yes'=>'Yes','no'=>'No'),array('empty' => 'Select Calculate'))?>
                                            
                  </div>	<!--  
                    <div class="span4">            <?php //echo $form->textFieldControlGroup($modelPest, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('creator_id'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelPest, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelPest, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('created_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelPest, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('updated_at'))); ?>

            </div>
                    <div class="span4">            <?php //echo $form->textFieldControlGroup($modelPest, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('status'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelPest, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelPest->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelPest, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelPest->getAttributeLabel('params'))); ?>

            </div>-->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
