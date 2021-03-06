<?php
/* @var $this TrapCheckController */
/* @var $modelTrapCheck TrapCheck */


$this->breadcrumbs=array(
	'Trap Checks' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'TrapCheck'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#trap-check-grid').yiiGridView('update', {
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
                'modelTrapCheck' => $modelTrapCheck,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'trap-check-grid',
	'dataProvider' => $modelTrapCheck->search(),
	'filter' => $modelTrapCheck,
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
			'htmlOptions' => array(
					'class' => 'c-button',
			),
		),
		array('name'=>'grower','value'=>'$data->grower->name','header'=>'Grower','filter'=>CHtml::activeDropDownList($modelTrapCheck,'grower', CHtml::listData( $modelTrapCheck->getGrower() ,'id','name'),array('empty'=>'Select A Grower', 'class' => 'select2-full-width'))),
		array('name'=>'property','value'=>'$data->property->name','header'=>'Property','filter'=>CHtml::activeDropDownList($modelTrapCheck,'property', CHtml::listData( $modelTrapCheck->getPropertyByGrower() ,'id','name'),array('empty'=>'Select A Property', 'class' => 'select2-full-width'))),
		array('name'=>'block','value'=>'$data->block->name','header'=>'Block','filter'=>CHtml::activeDropDownList($modelTrapCheck,'block', CHtml::listData( $modelTrapCheck->getBlockByProperty() ,'id','name'),array('empty'=>'Select A Block', 'class' => 'select2-full-width'))),
		array('name'=>'trap','value'=>'$data->trap->name','header'=>'Trap','filter'=>CHtml::activeDropDownList($modelTrapCheck, 'trap', CHtml::listData($modelTrapCheck->getTrapByBlock() ,'name','name'),array('empty'=>'Select A Trap', 'class' => 'select2-full-width'))),
		'date',
		'value',
		'comment',
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