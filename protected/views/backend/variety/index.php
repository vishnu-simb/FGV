<?php
/* @var $this VarietyController */
/* @var $modelVariety Variety */


$this->breadcrumbs=array(
	'Varieties' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Variety'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#variety-grid').yiiGridView('update', {
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
                'modelVariety' => $modelVariety,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'variety-grid',
	'dataProvider' => $modelVariety->search(),
	'filter' => $modelVariety,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'dataTable simple-table dt-responsive table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

'columns' => array(
		array(
		'class' => 'bootstrap.widgets.TbButtonColumn',
		),
		'name',
        array('name'=>'fruit_type','value'=>!empty($data->fruit_type)?$data->fruit_type->name:'','filter'=>CHtml::activeDropDownList($modelVariety, 'fruit_type', CHtml::listData( $modelVariety->getFruitType() ,'id','name'),array('empty'=>'Select A Fruit Type'))),
		/*
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		
		'status',
		'is_deleted',
		'params',
		*/
		
	),
)); ?>
        </div>
    </div>
</div>