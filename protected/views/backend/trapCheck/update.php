<?php
/* @var $this TrapCheckController */
/* @var $modelTrapCheck TrapCheck */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'TrapChecks');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelTrapCheck->id=>array('view', 'id' => $modelTrapCheck->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'TrapChecks'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'TrapCheck'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'TrapCheck'), 'url' => array('view', 'id' => $modelTrapCheck->id)),
);
?>

<?php $this->renderPartial('_form', array('modelTrapCheck'=>$modelTrapCheck)); ?>