<?php
/* @var $this PestController */
/* @var $modelPest Pest */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Pests');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelPest->name => array('update', 'id' => $modelPest->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Pests'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Pest'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Pest'), 'url' => array('update', 'id' => $modelPest->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Pest'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelPest->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelPest,
    'attributes' => array(
		'id',
		'name',
		'dd',
		'calculate',
		'color',
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