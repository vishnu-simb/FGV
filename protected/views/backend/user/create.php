<?php
/* @var $this UserController */
/* @var $modelUser User */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Users');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'User'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Users'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelUser' => $modelUser)); ?>