<?php
/* @var $this CropController */
/* @var $modelCrop CropMonitor */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'CropMonitors');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelCrop->id => array('update', 'id' => $modelCrop->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'CropMonitors'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'CropMonitor'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'CropMonitor'), 'url' => array('update', 'id' => $modelCrop->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'CropMonitor'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelCrop->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelCrop,
    'attributes' => array(
		'id',
		'trap.name',
		'date',
		'value',
		'comment'
	),
)); ?>