<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Sprays');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Spray'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Sprays'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelSpray' => $modelSpray)); ?>