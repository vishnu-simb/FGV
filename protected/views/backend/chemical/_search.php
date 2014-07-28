<?php
/* @var $this ChemicalController */
/* @var $modelChemical Chemical */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelChemical, 'rowsPerPage', $modelChemical->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelChemical, 'id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'pack_qty', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('pack_qty'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'pack_price', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('pack_price'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'dilution_rate', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('dilution_rate'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelChemical, 'application_rate', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('application_rate'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('updated_at'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelChemical, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelChemical, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelChemical->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelChemical, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelChemical->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
