<?php
/* @var $this UserController */
/* @var $modelUser User */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Users');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelUser->id => array('update', 'id' => $modelUser->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Users'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'User'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'User'), 'url' => array('update', 'id' => $modelUser->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'User'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelUser->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelUser,
    'attributes' => array(
		'id',
		'username',
		'email',
		'display_name',
		'slug',
		'password',
		'salt',
		'is_super_admin',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
	),
)); ?>