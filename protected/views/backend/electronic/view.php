<?php
/* @var $this ElectronicController */
/* @var $modelElectronic ElectronicMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'ElectronicMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelElectronic->id => array('update', 'id' => $modelElectronic->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'ElectronicMonitors'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'ElectronicMonitor'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'ElectronicMonitor'), 'url' => array('update', 'id' => $modelElectronic->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'ElectronicMonitor'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelElectronic->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelElectronic,
    'attributes' => array(
		'id',
		'trap.name',
		'date',
		'value',
		'comment'
	),
)); ?>