<?php
/* @var $this LocationController */
/* @var $modelLocation Location */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Locations');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Location'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Locations'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelLocation' => $modelLocation)); ?>