<?php
/* @var $this PestController */
/* @var $modelPest Pest */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Pests');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Pest'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Pests'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelPest' => $modelPest)); ?>