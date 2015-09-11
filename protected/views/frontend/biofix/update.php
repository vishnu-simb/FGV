<?php
/* @var $this BiofixController */
/* @var $modelBiofix Biofix */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Biofixes');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelBiofix->id=>array('view', 'id' => $modelBiofix->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Biofixes'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Biofix'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Biofix'), 'url' => array('view', 'id' => $modelBiofix->id)),
);
?>

<?php $this->renderPartial('_form', array('modelBiofix'=>$modelBiofix)); ?>