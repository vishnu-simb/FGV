<?php
/* @var $this CropPestController */
/* @var $modelCropPest CropPest */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Crop Pests');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelCropPest->name => array('update', 'id' => $modelCropPest->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Crop Pests'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'CropPest'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'CropPest'), 'url' => array('update', 'id' => $modelCropPest->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'CropPest'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelCropPest->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelCropPest,
    'attributes' => array(
		'id',
		'name',
		'color'
	),
)); ?>