<?php
/* @var $this MonitoringController */
/* @var $modelMiteMonitor MiteMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'MiteMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Import %s'), 'MiteMonitor'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'MiteMonitors'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_import', array('modelMiteMonitor' => $modelMiteMonitor)); ?>