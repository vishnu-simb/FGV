<?php
/* @var $this SizingController */
/* @var $modelSizing Sizing */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Sizings');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelSizing->id => array('update', 'id' => $modelSizing->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Sizings'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Sizing'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Sizing'), 'url' => array('update', 'id' => $modelSizing->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Sizing'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelSizing->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelSizing,
    'attributes' => array(
		'id',
		'block_id',
		'variety_id',
		'date',
		'value',
		'type',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
	),
)); ?>