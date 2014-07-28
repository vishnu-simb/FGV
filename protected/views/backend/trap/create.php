<?php
/* @var $this TrapController */
/* @var $modelTrap Trap */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Traps');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Trap'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Traps'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelTrap' => $modelTrap)); ?>