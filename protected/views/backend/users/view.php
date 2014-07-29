<?php
/* @var $this UsersController */
/* @var $modelUsers Users */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Users');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelUsers->id => array('update', 'id' => $modelUsers->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Users'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Users'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Users'), 'url' => array('update', 'id' => $modelUsers->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Users'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelUsers->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelUsers,
    'attributes' => array(
		'id',
		'username',
		'password',
		'type',
		/*
		'salt',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
		*/
	),
)); ?>