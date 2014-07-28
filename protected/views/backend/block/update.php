<?php
/* @var $this BlockController */
/* @var $modelBlock Block */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Blocks');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelBlock->name=>array('view', 'id' => $modelBlock->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Blocks'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Block'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Block'), 'url' => array('view', 'id' => $modelBlock->id)),
);
?>

<?php $this->renderPartial('_form', array('modelBlock'=>$modelBlock)); ?>