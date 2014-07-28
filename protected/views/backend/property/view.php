<?php
/* @var $this PropertyController */
/* @var $modelProperty Property */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Properties');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelProperty->name => array('update', 'id' => $modelProperty->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Properties'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Property'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Property'), 'url' => array('update', 'id' => $modelProperty->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Property'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelProperty->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelProperty,
    'attributes' => array(
		'id',
		'grower_id',
		'location_id',
		'name',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
	),
)); ?>