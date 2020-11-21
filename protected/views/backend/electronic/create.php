<?php
/* @var $this ElectronicController */
/* @var $modelElectronic ElectronicMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'ElectronicMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'ElectronicMonitor'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'ElectronicMonitors'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelElectronic' => $modelElectronic)); ?>