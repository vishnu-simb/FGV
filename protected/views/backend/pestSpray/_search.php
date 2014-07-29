<?php
/* @var $this PestSprayController */
/* @var $modelPestSpray PestSpray */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelPestSpray, 'rowsPerPage', $modelPestSpray->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelPestSpray, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'pest_id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('pest_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'number', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('number'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'grower_id', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('grower_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'dd', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('dd'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelPestSpray, 'every', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('every'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'lowpop_dd', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('lowpop_dd'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'lowpop_every', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('lowpop_every'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('ordering'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelPestSpray, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('updated_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelPestSpray, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelPestSpray->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelPestSpray, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelPestSpray->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
