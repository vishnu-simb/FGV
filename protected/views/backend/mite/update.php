<?php
/* @var $this MiteController */
/* @var $modelMite Mite */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Mites');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelMite->name=>array('view', 'id' => $modelMite->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Mites'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Mite'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Mite'), 'url' => array('view', 'id' => $modelMite->id)),
);
?>

<?php $this->renderPartial('_form', array('modelMite'=>$modelMite)); ?>