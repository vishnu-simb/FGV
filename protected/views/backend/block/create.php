<?php
/* @var $this BlockController */
/* @var $modelBlock Block */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Blocks');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Block'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Blocks'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_create', array('modelBlock' => $modelBlock)); ?>