<?php
/* @var $this TrapController */
/* @var $modelTrap Trap */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelTrap, 'rowsPerPage', $modelTrap->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelTrap, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrap, 'pest_id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('pest_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrap, 'block_id', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('block_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrap, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('name'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelTrap, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrap, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrap, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrap, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('updated_at'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelTrap, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelTrap, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelTrap->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelTrap, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelTrap->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
