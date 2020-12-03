<?php
/* @var $this CropController */
/* @var $modelCrop CropMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'CropMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'CropMonitor'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'CropMonitors'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelCrop' => $modelCrop)); ?>