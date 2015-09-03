<?php
/* @var $this MonitoringController */
/* @var $modelMiteMonitor MiteMonitor */
/* @var $form TbActiveForm */
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'mite-monitor-form',
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
<?php echo $form->errorSummary($modelMiteMonitor); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
            <div class="box-content nopadding">
                <div class="span6">
					<?php echo $form->dropDownListControlGroup($modelMiteMonitor, 'mite_id', CHtml::listData( $modelMiteMonitor->getMite() ,'id','name'),array('empty'=>'Select A Mite'))?>
					<?php echo $form->dropDownListControlGroup($modelMiteMonitor, 'block_id', CHtml::listData( $modelMiteMonitor->getBlock() ,'id','name'),array('empty'=>'Select A Block'))?>
                    <?php echo $form->textFieldControlGroup($modelMiteMonitor, 'date', array('class' => 'input-xlarge', 'placeholder' => $modelMiteMonitor->getAttributeLabel('date'))); ?>
                    <?php echo $form->textFieldControlGroup($modelMiteMonitor, 'percent_li', array('class' => 'input-xlarge', 'placeholder' => $modelMiteMonitor->getAttributeLabel('percent_li'))); ?>
                    <?php //echo $form->textFieldControlGroup($modelMiteMonitor, 'average_li', array('class' => 'input-xlarge', 'placeholder' => $modelMiteMonitor->getAttributeLabel('average_li'))); ?>
                    <?php echo $form->textFieldControlGroup($modelMiteMonitor, 'no_days', array('class' => 'input-xlarge', 'placeholder' => $modelMiteMonitor->getAttributeLabel('no_days'))); ?>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton($modelMiteMonitor->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>