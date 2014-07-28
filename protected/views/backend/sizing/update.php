<?php
/* @var $this SizingController */
/* @var $modelSizing Sizing */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Sizings');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelSizing->id=>array('view', 'id' => $modelSizing->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Sizings'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Sizing'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Sizing'), 'url' => array('view', 'id' => $modelSizing->id)),
);
?>

<?php $this->renderPartial('_form', array('modelSizing'=>$modelSizing)); ?>