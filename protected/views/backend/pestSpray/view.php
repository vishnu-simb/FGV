<?php
/* @var $this PestSprayController */
/* @var $modelPestSpray PestSpray */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'PestSprays');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelPestSpray->id => array('update', 'id' => $modelPestSpray->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'PestSprays'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'PestSpray'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'PestSpray'), 'url' => array('update', 'id' => $modelPestSpray->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'PestSpray'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelPestSpray->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelPestSpray,
    'attributes' => array(
		'id',
		'pest',
		'number',
		'grower',
		'dd',
		'every',
		'lowpop_dd',
		'lowpop_every',
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