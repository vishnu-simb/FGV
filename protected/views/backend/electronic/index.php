<?php
/* @var $this ElectronicController */
/* @var $modelElectronic ElectronicMonitor */


$this->breadcrumbs=array(
	'Electronic Monitoring' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'record'), 'url' => array('create')),
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
                'modelElectronic' => $modelElectronic,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'trap-check-grid',
	'dataProvider' => $modelElectronic->search(),
	'filter' => $modelElectronic,
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
		array('name'=>'grower','value'=>'$data->grower->name','header'=>'Grower','filter'=>CHtml::activeDropDownList($modelElectronic,'grower', CHtml::listData( $modelElectronic->getGrower() ,'id','name'),array('empty'=>'Select A Grower', 'class' => 'select2-full-width'))),
		array('name'=>'property','value'=>'$data->property->name','header'=>'Property','filter'=>CHtml::activeDropDownList($modelElectronic,'property', CHtml::listData( $modelElectronic->getPropertyByGrower() ,'id','name'),array('empty'=>'Select A Property', 'class' => 'select2-full-width'))),
		array('name'=>'block','value'=>'$data->block->name','header'=>'Block','filter'=>CHtml::activeDropDownList($modelElectronic,'block', CHtml::listData( $modelElectronic->getBlockByProperty() ,'id','name'),array('empty'=>'Select A Block', 'class' => 'select2-full-width'))),
        array('name'=>'pest','value'=>'$data->pest->name','filter'=>CHtml::activeDropDownList($modelElectronic, 'pest_id', CHtml::listData( $modelElectronic->getPest() ,'id','name'),array('empty'=>'Select A Pest', 'class' => 'select2-full-width'))),
		array('name'=>'trap','value'=>'$data->trap?$data->trap->name:""','header'=>'Trap','filter'=>CHtml::activeDropDownList($modelElectronic, 'trap', CHtml::listData($modelElectronic->getTrapByBlock() ,'name','name'),array('empty'=>'Select A Trap', 'class' => 'select2-full-width'))),
		'date',
		'value',
		'comment'
	),
)); ?>
        </div>
    </div>
</div>