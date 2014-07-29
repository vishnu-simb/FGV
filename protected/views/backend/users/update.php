<?php
/* @var $this UsersController */
/* @var $modelUsers Users */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Users');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelUsers->id=>array('view', 'id' => $modelUsers->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Users'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Users'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Users'), 'url' => array('view', 'id' => $modelUsers->id)),
);
?>

<?php $this->renderPartial('_form', array('modelUsers'=>$modelUsers)); ?>