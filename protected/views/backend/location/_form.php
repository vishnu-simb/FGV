<?php
/* @var $this LocationController */
/* @var $modelLocation Location */
/* @var $form TbActiveForm */

Yii::app()->clientScript->registerScript('form', "
jQuery(document).ready(function() {
    if ($('#location-form #help_link').length > 0){
        $('#location-form #help_link').click(function(e){
            var location_name = $.trim($('#Location_name').val());
            if (location_name.length > 0){
                $(this).attr('href','http://postcodez.com.au/postcodes.cgi?search_suburb='+location_name+'&search_state=vic');
                return true;
            }else{
                alert('Please enter the location name');
                $('#Location_name').focus();
                $(this).attr('href','#');
                e.preventDefault();
                return false;
            }
        });
    }
});
");

?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'location-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate'),
                // for enabling client validation
                'enableClientValidation' => true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
<?php echo $form->errorSummary($modelLocation); ?>
<?php if(Yii::app()->user->hasFlash('location_error')):?>
<div class="alert alert-block alert-error" id="location-form_es_">
    <ul><li><?php echo Yii::app()->user->getFlash('location_error'); ?></li></ul>
</div>
<?php endif; ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
                    <?php echo $form->textFieldControlGroup($modelLocation, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('name'))); ?>
                    <?php echo $form->textFieldControlGroup($modelLocation, 'observation', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('observation'))); ?>
                    <?php echo $form->textFieldControlGroup($modelLocation, 'forcast', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelLocation->getAttributeLabel('forcast'))); ?>
				    <div class="control-group">
                        <label for="auto_populate" class="control-label">Auto get Observation and Forcast</label>
                        <div class="controls">
                            <input type="checkbox" id="auto_populate" name="auto_populate" class="input" value="1" />
                            <p class="help-block" id="auto_populate_em_">Observation and Forcast will be automatically get from www.bom.gov.au</p>
                        </div>
                    </div>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelLocation->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                        <br /><br />
                        <a href="#" id="help_link" target="_blank">Find your postcode</a>
                    </div>
                    
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>