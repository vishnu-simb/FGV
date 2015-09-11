<?php
/* @var $this BiofixController */
/* @var $modelBiofix Biofix */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Biofixes');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Biofix'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Biofixes'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelBiofix' => $modelBiofix)); ?>