<?php
/* @var $this VarietyController */
/* @var $modelVariety Variety */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Varieties');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelVariety->name => array('update', 'id' => $modelVariety->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Varieties'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Variety'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Variety'), 'url' => array('update', 'id' => $modelVariety->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Variety'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelVariety->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelVariety,
    'attributes' => array(
		'id',
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