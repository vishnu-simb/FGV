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
            echo $form->dropDownList($modelChemical, 'rowsPerPage', $modelChemical->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>
<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">
        <div class="span6">    
            <?php echo $form->textFieldControlGroup($modelChemical, 'name', array('maxlength' => 100, 'class' => 'input', 'placeholder' => $modelChemical->getAttributeLabel('name'))); ?>
            <?php echo $form->textFieldControlGroup($modelChemical, 'pack_qty', array('class' => 'input', 'placeholder' => $modelChemical->getAttributeLabel('pack_qty'))); ?>
            <?php echo $form->textFieldControlGroup($modelChemical, 'pack_price', array('class' => 'input', 'placeholder' => $modelChemical->getAttributeLabel('pack_price'))); ?>
        </div>
        <div class="span6">    
            <?php echo $form->textFieldControlGroup($modelChemical, 'dilution_rate', array('class' => 'input', 'placeholder' => $modelChemical->getAttributeLabel('dilution_rate'))); ?>
            <?php echo $form->textFieldControlGroup($modelChemical, 'application_rate', array('class' => 'input', 'placeholder' => $modelChemical->getAttributeLabel('application_rate'))); ?>
        </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->
<?php $this->endWidget(); ?>