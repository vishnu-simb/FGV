<?php
/* @var $this PestSprayController */
/* @var $modelPestSpray PestSpray */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'PestSprays');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelPestSpray->id=>array('view', 'id' => $modelPestSpray->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'PestSprays'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'PestSpray'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'PestSpray'), 'url' => array('view', 'id' => $modelPestSpray->id)),
);
?>

<?php $this->renderPartial('_form', array('modelPestSpray'=>$modelPestSpray)); ?>