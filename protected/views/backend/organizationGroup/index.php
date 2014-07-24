<?php
/* @var $this OrganizationGroupController */
/* @var $modelOrganizationGroup OrganizationGroup */


$this->breadcrumbs=array(
	'Organization Groups' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'OrganizationGroup'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#organization-group-grid').yiiGridView('update', {
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
                'modelOrganizationGroup' => $modelOrganizationGroup,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'organization-group-grid',
	'dataProvider' => $modelOrganizationGroup->search(),
	'filter' => $modelOrganizationGroup,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

'columns' => array(
		'id',
		'code',
		'name',
		'number',
		'display_name',
		'contact',
		/*
		'address',
		'address2',
		'address3',
		'city',
		'state',
		'country',
		'country_id',
		'phone',
		'fax',
		'postal_code',
		'email',
		'website',
		'latitude',
		'longtitude',
		'parent_id',
		'level',
		'organization_id',
		'organization_level_id',
		'slug',
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