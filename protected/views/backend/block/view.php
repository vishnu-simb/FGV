<?php
/* @var $this BlockController */
/* @var $modelBlock Block */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Blocks');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelBlock->name => array('update', 'id' => $modelBlock->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Blocks'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Block'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Block'), 'url' => array('update', 'id' => $modelBlock->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Block'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelBlock->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelBlock,
    'attributes' => array(
		'id',
		'property.name',
		'name',
		'tree_spacing',
		'row_width',
		/*
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',*/
	),
)); ?>