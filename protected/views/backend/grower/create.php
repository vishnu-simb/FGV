<?php
/* @var $this GrowerController */
/* @var $modelGrower Grower */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Growers');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Grower'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Growers'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_create', array('modelGrower' => $modelGrower)); ?>