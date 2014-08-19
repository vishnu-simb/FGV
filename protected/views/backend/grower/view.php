<?php
/* @var $this GrowerController */
/* @var $modelGrower Grower */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Growers');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelGrower->name => array('update', 'id' => $modelGrower->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Growers'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Grower'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Grower'), 'url' => array('update', 'id' => $modelGrower->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Grower'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelGrower->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelGrower,
    'attributes' => array(
		'id',
		'name',
		'username',
		'email',
		'enabled',
		'reporting',
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