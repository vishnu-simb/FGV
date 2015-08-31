<?php
/* @var $this TrapController */
/* @var $modelTrap Trap */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Traps');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelTrap->name => array('update', 'id' => $modelTrap->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Traps'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Trap'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Trap'), 'url' => array('update', 'id' => $modelTrap->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Trap'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelTrap->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelTrap,
    'attributes' => array(
		'id',
		'pest.name',
		'block.name',
		'name',
		array('name'=>'ordering','header'=>'Sequence Number','filter'=>false),
		/*
		'creator_id',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',*/
	),
)); ?>