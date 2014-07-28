<?php
/* @var $this PestController */
/* @var $modelPest Pest */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Pests');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelPest->name=>array('view', 'id' => $modelPest->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Pests'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Pest'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Pest'), 'url' => array('view', 'id' => $modelPest->id)),
);
?>

<?php $this->renderPartial('_form', array('modelPest'=>$modelPest)); ?>