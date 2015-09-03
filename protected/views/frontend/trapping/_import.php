<?php
/* @var $this TrappingController */
/* @var $modelTrapCheck TrapCheck */
/* @var $form TbActiveForm */

$clientScript = Yii::app()->clientScript;
$resourceUrl = $clientScript->staticUrl.'/flatapp';
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
                'htmlOptions' => array('class' =>'form-validate','enctype' => 'multipart/form-data'),
                // for enabling client validation
                'enableClientValidation' => true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
<?php echo $form->errorSummary($modelTrapCheck); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo Yii::t('app', 'General Info') ?></h3>
            </div>
                   <div class="box-content">
                <div class="span6">
                	 <?php echo $form->fileFieldControlGroup($modelTrapCheck, 'import_file', array('class' => 'input-xlarge', 'placeholder' => $modelTrapCheck->getAttributeLabel('import_file'))); ?>
                	 <p>Please download the sample file at <a href="<?=$resourceUrl.'/files/grower_trapping_import_sample.csv'?>">here</a>.</p>
                        <?php echo TbHtml::submitButton(Yii::t('app', 'Import'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>