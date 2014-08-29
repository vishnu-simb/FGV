<?php
/* @var $this MonitoringController */
/* @var $modelMiteMonitor MiteMonitor */


$this->breadcrumbs=array(
	'Mite Monitors' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Import %s'), 'MiteMonitor'), 'url' => array('import')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#mite-monitor-grid').yiiGridView('update', {
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
                'modelMiteMonitor' => $modelMiteMonitor,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'mite-monitor-grid',
	'dataProvider' => $modelMiteMonitor->search(),
	'filter' => $modelMiteMonitor,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

'columns' => array(
		'id',
		array('name'=>'mite.name','header'=>'Mite','filter'=>CHtml::activeDropDownList($modelMiteMonitor,'mite', CHtml::listData( $modelMiteMonitor->getMite() ,'id','name'),array('empty'=>'Select A Mite'))),
		array('name'=>'property.name','header'=>'Property','filter'=>CHtml::activeDropDownList($modelMiteMonitor,'property', CHtml::listData( $modelMiteMonitor->getProperty() ,'id','name'),array('empty'=>'Select A Property'))),
		array('name'=>'block.name','header'=>'Block','filter'=>CHtml::activeDropDownList($modelMiteMonitor,'block', CHtml::listData( $modelMiteMonitor->getBlock() ,'id','name'),array('empty'=>'Select A Block'))),
		array('name'=>'grower.name','header'=>'Grower','filter'=>CHtml::activeDropDownList($modelMiteMonitor,'grower', CHtml::listData( $modelMiteMonitor->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))),
		'date',
		'percent_li',
		'no_days',
		/*
		'average_li',
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