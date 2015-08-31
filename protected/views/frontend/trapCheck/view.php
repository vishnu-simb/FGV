<?php
/* @var $this TrapCheckController */
/* @var $modelTrapCheck TrapCheck */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'TrapChecks');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelTrapCheck->id => array('update', 'id' => $modelTrapCheck->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'TrapChecks'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'TrapCheck'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'TrapCheck'), 'url' => array('update', 'id' => $modelTrapCheck->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'TrapCheck'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelTrapCheck->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelTrapCheck,
    'attributes' => array(
		'id',
		'trap.name',
		'date',
		'value',
		'comment',
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