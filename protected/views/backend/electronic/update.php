<?php
/* @var $this ElectronicController */
/* @var $modelElectronic ElectronicMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'ElectronicMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelElectronic->id=>array('view', 'id' => $modelElectronic->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'ElectronicMonitors'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'ElectronicMonitor'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'ElectronicMonitor'), 'url' => array('view', 'id' => $modelElectronic->id)),
);
?>

<?php $this->renderPartial('_form', array('modelElectronic'=>$modelElectronic)); ?>