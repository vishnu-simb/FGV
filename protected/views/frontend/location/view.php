<?php
/* @var $this LocationController */
/* @var $modelLocation Location */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Locations');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelLocation->name => array('update', 'id' => $modelLocation->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Locations'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Location'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Location'), 'url' => array('update', 'id' => $modelLocation->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Location'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelLocation->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelLocation,
    'attributes' => array(
		'id',
		'name',
		'observation',
		'forcast',
		/*
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',*/
	),
)); ?>