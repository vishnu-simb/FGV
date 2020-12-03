<?php
/* @var $this CropController */
/* @var $modelCrop CropMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'CropMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelCrop->id=>array('view', 'id' => $modelCrop->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'CropMonitors'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'CropMonitor'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'CropMonitor'), 'url' => array('view', 'id' => $modelCrop->id)),
);
?>

<?php $this->renderPartial('_form', array('modelCrop'=>$modelCrop)); ?>