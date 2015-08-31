<?php
/* @var $this PropertyController */
/* @var $modelProperty Property */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Properties');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelProperty->name=>array('view', 'id' => $modelProperty->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Properties'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Property'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Property'), 'url' => array('view', 'id' => $modelProperty->id)),
);
?>

<?php $this->renderPartial('_form', array('modelProperty'=>$modelProperty)); ?>