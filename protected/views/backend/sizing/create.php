<?php
/* @var $this SizingController */
/* @var $modelSizing Sizing */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Sizings');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Sizing'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Sizings'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelSizing' => $modelSizing)); ?>