<?php
/* @var $this CropPestController */
/* @var $modelCropPest CropPest */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Crop Pests');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelCropPest->name=>array('view', 'id' => $modelCropPest->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'CropPests'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'CropPest'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'CropPest'), 'url' => array('view', 'id' => $modelCropPest->id)),
);
?>

<?php $this->renderPartial('_form', array('modelCropPest'=>$modelCropPest)); ?>