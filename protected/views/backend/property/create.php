<?php
/* @var $this PropertyController */
/* @var $modelProperty Property */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Properties');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Property'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Properties'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelProperty' => $modelProperty)); ?>