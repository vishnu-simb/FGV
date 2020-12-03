<?php
/* @var $this CropPestController */
/* @var $modelCropPest CropPest */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Crop Pests');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Crop Pest'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Crop Pests'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelCropPest' => $modelCropPest)); ?>