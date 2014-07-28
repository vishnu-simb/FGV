<?php
/* @var $this TrapCheckController */
/* @var $modelTrapCheck TrapCheck */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'TrapChecks');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'TrapCheck'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'TrapChecks'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelTrapCheck' => $modelTrapCheck)); ?>