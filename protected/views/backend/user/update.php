<?php
/* @var $this UserController */
/* @var $modelUser User */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Users');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelUser->id=>array('view', 'id' => $modelUser->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Users'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'User'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'User'), 'url' => array('view', 'id' => $modelUser->id)),
);
?>

<?php $this->renderPartial('_form', array('modelUser'=>$modelUser)); ?>