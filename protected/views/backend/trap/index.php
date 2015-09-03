<?php
/* @var $this TrapController */
/* @var $modelTrap Trap */


$this->breadcrumbs=array(
	'Traps' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Trap'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#trap-grid').yiiGridView('update', {
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
                'modelTrap' => $modelTrap,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'trap-grid',
	'dataProvider' => $modelTrap->search(),
	'filter' => $modelTrap,
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
		//array('name'=>'ordering','header'=>'Sequence Number','class' => 'ext.yii-ordering-column.column','filter'=>false),
		array('name'=>'grower','header'=>'Grower','value'=>'$data->grower->name','filter'=>CHtml::activeDropDownList($modelTrap,'grower', CHtml::listData( $modelTrap->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))),
		array('name'=>'property','header'=>'Property','value'=>'$data->property->name','filter'=>CHtml::activeDropDownList($modelTrap,'property', CHtml::listData( $modelTrap->getPropertyByGrower() ,'id','name'),array('empty'=>'Select A Property'))),
		array('name'=>'block','value'=>'$data->block->name','filter'=>CHtml::activeDropDownList($modelTrap, 'block_id', CHtml::listData( $modelTrap->getBlockByProperty() ,'id','name'),array('empty'=>'Select A Block'))),
		array('name'=>'pest','value'=>'$data->pest->name','filter'=>CHtml::activeDropDownList($modelTrap, 'pest_id', CHtml::listData( $modelTrap->getPest() ,'id','name'),array('empty'=>'Select A Pest'))),
		array('name'=>'name','filter'=>CHtml::activeDropDownList($modelTrap,'name', CHtml::listData($modelTrap->getTrapByBlock() ,'name','name'),array('empty'=>'Select A Trap'))),
		
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
));?>
        </div>
    </div>
</div>