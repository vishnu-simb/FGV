<?php
/* @var $this TrapController */
/* @var $modelTrap Trap */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Traps');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelTrap->name=>array('view', 'id' => $modelTrap->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Traps'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Trap'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Trap'), 'url' => array('view', 'id' => $modelTrap->id)),
);
?>

<?php $this->renderPartial('_form', array('modelTrap'=>$modelTrap)); ?>