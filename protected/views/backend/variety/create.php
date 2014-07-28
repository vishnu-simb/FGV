<?php
/* @var $this VarietyController */
/* @var $modelVariety Variety */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Varieties');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Variety'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Varieties'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelVariety' => $modelVariety)); ?>