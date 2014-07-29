<?php
/* @var $this BiofixController */
/* @var $modelBiofix Biofix */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Biofixes');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelBiofix->id => array('update', 'id' => $modelBiofix->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Biofixes'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Biofix'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Biofix'), 'url' => array('update', 'id' => $modelBiofix->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Biofix'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelBiofix->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelBiofix,
    'attributes' => array(
		'id',
		'pest_id',
		'block_id',
		'second_cohort',
		'date',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
	),
)); ?>