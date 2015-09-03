<?php
/* @var $this TrappingController */
/* @var $modelTrapCheck TrapCheck */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Trapping');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Import %s'), 'Trapping'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Trapping'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_import', array('modelTrapCheck' => $modelTrapCheck)); ?>