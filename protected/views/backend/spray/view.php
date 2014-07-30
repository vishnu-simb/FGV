<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Sprays');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelSpray->id => array('update', 'id' => $modelSpray->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Sprays'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Spray'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Spray'), 'url' => array('update', 'id' => $modelSpray->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Spray'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelSpray->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelSpray,
    'attributes' => array(
		'id',
		'chemical.name',
		'date',
		'quantity',
		'block.name',
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