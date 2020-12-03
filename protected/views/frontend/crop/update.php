<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
?>

<?php
$label = sprintf(Yii::t('app', 'Trapping %s'), '');
$this->breadcrumbs = array(
	$label => array('index'),
	Yii::t('app', 'Update'),
);

?>

<?php $this->renderPartial('_form', array('modelCrop'=>$modelCrop)); ?>