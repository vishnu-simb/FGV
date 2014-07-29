<?php
/* @var $this PestSprayController */
/* @var $modelPestSpray PestSpray */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'PestSprays');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'PestSpray'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'PestSprays'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelPestSpray' => $modelPestSpray)); ?>