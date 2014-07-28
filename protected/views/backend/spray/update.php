<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Sprays');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelSpray->id=>array('view', 'id' => $modelSpray->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Sprays'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Spray'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Spray'), 'url' => array('view', 'id' => $modelSpray->id)),
);
?>

<?php $this->renderPartial('_form', array('modelSpray'=>$modelSpray)); ?>