<?php
/* @var $this MiteController */
/* @var $modelMite Mite */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Mites');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelMite->name => array('update', 'id' => $modelMite->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Mites'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Mite'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Mite'), 'url' => array('update', 'id' => $modelMite->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Mite'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelMite->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelMite,
    'attributes' => array(
		'id',
		'name',
		'type',
		/*'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',*/
	),
)); ?>