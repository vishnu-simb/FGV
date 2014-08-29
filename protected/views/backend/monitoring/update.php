<?php
/* @var $this MonitoringController */
/* @var $modelMiteMonitor MiteMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'MiteMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelMiteMonitor->id=>array('view', 'id' => $modelMiteMonitor->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'MiteMonitors'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Import %s'), 'MiteMonitor'), 'url' => array('import')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'MiteMonitor'), 'url' => array('view', 'id' => $modelMiteMonitor->id)),
);
?>

<?php $this->renderPartial('_form', array('modelMiteMonitor'=>$modelMiteMonitor)); ?>