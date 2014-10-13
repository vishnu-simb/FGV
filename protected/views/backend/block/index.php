<?php
/* @var $this BlockController */
/* @var $modelBlock Block */


$this->breadcrumbs=array(
	'Blocks' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Block'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#block-grid').yiiGridView('update', {
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
                'modelBlock' => $modelBlock,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'block-grid',
	'dataProvider' => $modelBlock->search(),
	'filter' => $modelBlock,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

'columns' => array(
		//'id',
		array('name'=>'property','value'=>'$data->property->name','header'=>'Property','filter'=>CHtml::activeDropDownList($modelBlock,'property_id', CHtml::listData( $modelBlock->getProperty() ,'id','name'),array('empty'=>'Select A Property'))),
		array('name'=>'location','value'=>'$data->location->name','header'=>'Location','filter'=>CHtml::activeDropDownList($modelBlock,'location', CHtml::listData( $modelBlock->getLocation() ,'id','name'),array('empty'=>'Select A Location'))),
		array('name'=>'grower','value'=>'$data->grower->name','header'=>'Grower','filter'=>CHtml::activeDropDownList($modelBlock,'grower', CHtml::listData( $modelBlock->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))),
		array('name'=>'name','filter'=>CHtml::activeDropDownList($modelBlock, 'name', CHtml::listData($modelBlock->findAll() ,'name','name'),array('empty'=>'Select A Block'))),
		'tree_spacing',
		'tree_variety',
		'row_width',
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
			'htmlOptions' => array(
					'class' => 'c-button',
			),
		),
	),
)); ?>
        </div>
    </div>
</div>