<?php
/* @var $this PropertyController */
/* @var $modelProperty Property */


$this->breadcrumbs=array(
	'Properties' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Property'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#property-grid').yiiGridView('update', {
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
                'modelProperty' => $modelProperty,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'property-grid',
	'dataProvider' => $modelProperty->search(),
	'filter' => $modelProperty,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

'columns' => array(
		'id',
		array('name'=>'grower','value'=>'$data->grower->name','header'=>'Grower','filter'=>CHtml::activeDropDownList($modelProperty,'grower_id', CHtml::listData( $modelProperty->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))),
		array('name'=>'location','value'=>'$data->location->name','header'=>'Location','filter'=>CHtml::activeDropDownList($modelProperty,'location_id', CHtml::listData( $modelProperty->getLocation() ,'id','name'),array('empty'=>'Select A Location'))),
		array('name'=>'name','filter'=>CHtml::activeDropDownList($modelProperty,'name', CHtml::listData( $modelProperty->findAll() ,'name','name'),array('empty'=>'Select A Property'))),
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