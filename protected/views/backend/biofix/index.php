<?php
/* @var $this BiofixController */
/* @var $modelBiofix Biofix */


$this->breadcrumbs=array(
	'Biofixes' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Biofix'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#biofix-grid').yiiGridView('update', {
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
                'modelBiofix' => $modelBiofix,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'biofix-grid',
	'dataProvider' => $modelBiofix->search(),
	'filter' => $modelBiofix,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

	'columns' => array(
		//'id',
		
		array('name'=>'pest.name','filter'=>CHtml::activeDropDownList($modelBiofix, 'pest_id', CHtml::listData( $modelBiofix->getPest() ,'id','name'),array('empty'=>'Select A Pest'))),
		array('name'=>'property.name','filter'=>CHtml::activeDropDownList($modelBiofix,'property', CHtml::listData( $modelBiofix->getProperty() ,'id','name'),array('empty'=>'Select A Property'))),
		array('name'=>'grower.name','filter'=>CHtml::activeDropDownList($modelBiofix,'grower', CHtml::listData( $modelBiofix->getGrower() ,'id','name'),array('empty'=>'Select A Grower'))),
		array('name'=>'block.name','filter'=>CHtml::activeDropDownList($modelBiofix, 'block_id', CHtml::listData( $modelBiofix->getBlock() ,'id','name'),array('empty'=>'Select A Block'))),
		'second_cohort',
		'date',
		
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