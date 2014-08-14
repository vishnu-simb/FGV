<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */


$this->breadcrumbs=array(
	'Sprays' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Spray'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#spray-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo sprintf(Yii::t('app', 'You may optionally enter a comparison operator (%s) at the beginning of each of your search values to specify how the comparison should be done.'), '<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b> &lt;&gt;</b>, <b>=</b>') ?>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="box">

            <?php $this->renderPartial('_search',array(
                'modelSpray' => $modelSpray,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'spray-grid',
	'dataProvider' => $modelSpray->search(),
	'filter' => $modelSpray,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

'columns' => array(
		'id',
		array('name'=>'chemical','value'=>'$data->chemical->name','filter'=>CHtml::activeDropDownList($modelSpray, 'chemical_id', CHtml::listData( $modelSpray->getChemical() ,'id','name'),array('empty'=>'Select A Chemical'))),
		array('name'=>'property','value'=>'$data->property->name','header'=>'Property','filter'=>CHtml::activeDropDownList($modelSpray,'property', CHtml::listData( $modelSpray->getProperty() ,'id','name'),array('empty'=>'Select A Property'))),
		array('name'=>'grower','header'=>'Grower','value'=>'$data->grower->name','filter'=>CHtml::activeDropDownList($modelSpray,'grower', CHtml::listData( $modelSpray->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))),
		array('name'=>'block','value'=>'$data->block->name','filter'=>CHtml::activeDropDownList($modelSpray, 'block_id', CHtml::listData( $modelSpray->getBlock() ,'id','name'),array('empty'=>'Select A Block'))),
		'date',
		'quantity',
	
		/*
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
		*/
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
        </div>
    </div>
</div>