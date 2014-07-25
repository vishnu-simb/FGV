<?php
/* @var $this GrowerController */
/* @var $modelGrower Grower */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Growers');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelGrower->name=>array('view', 'id' => $modelGrower->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Growers'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Grower'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Grower'), 'url' => array('view', 'id' => $modelGrower->id)),
);
?>

<?php $this->renderPartial('_form', array('modelGrower'=>$modelGrower)); ?>