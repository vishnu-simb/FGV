<?php
/* @var $this ChemicalController */
/* @var $modelChemical Chemical */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Chemicals');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelChemical->name => array('update', 'id' => $modelChemical->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Chemicals'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Chemical'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'Chemical'), 'url' => array('update', 'id' => $modelChemical->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'Chemical'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelChemical->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelChemical,
    'attributes' => array(
		'id',
		'name',
		'pack_qty',
		'pack_price',
		'dilution_rate',
		'application_rate',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
	),
)); ?>