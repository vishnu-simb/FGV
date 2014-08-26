<?php
/* @var $this MiteController */
/* @var $modelMite Mite */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Mites');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Mite'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Mites'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelMite' => $modelMite)); ?>