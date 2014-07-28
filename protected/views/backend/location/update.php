<?php
/* @var $this LocationController */
/* @var $modelLocation Location */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Locations');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelLocation->name=>array('view', 'id' => $modelLocation->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Locations'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Location'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Location'), 'url' => array('view', 'id' => $modelLocation->id)),
);
?>

<?php $this->renderPartial('_form', array('modelLocation'=>$modelLocation)); ?>