<?php
/* @var $this MonitoringController */
/* @var $modelMiteMonitor MiteMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'MiteMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelMiteMonitor->id => array('update', 'id' => $modelMiteMonitor->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'MiteMonitors'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Import %s'), 'MiteMonitor'), 'url' => array('import')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'MiteMonitor'), 'url' => array('update', 'id' => $modelMiteMonitor->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'MiteMonitor'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelMiteMonitor->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelMiteMonitor,
    'attributes' => array(
		'id',
		'mite.name',
		'block.name',
		'date',
		'percent_li',
		'no_days',
		/*
		'average_li',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',*/
	),
)); ?>