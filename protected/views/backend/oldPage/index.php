<?php
/* @var $this OldPageController */
/* @var $modelOldPage OldPage */


$this->breadcrumbs=array(
	'Old Pages' => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form-ext').toggle();
	$('.search-button-title').toggleClass('no-border');
	return false;
});
$('.search-form-ext form').submit(function(){
	$('#old-page-grid').yiiGridView('update', {
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
                'modelOldPage' => $modelOldPage,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'old-page-grid',
	'dataProvider' => $modelOldPage->search(),
	'filter' => $modelOldPage,
    'filterCssClass' => 'thefilter',
    'ajaxUpdate' => false,
    'itemsCssClass' => 'table-hover table-nomargin table-striped table-bordered dataTable-columnfilter',
    'htmlOptions' => array(
    'class' => 'dataTables_wrapper',
    ),
    'summaryText' => Yii::t('app', 'Showing page {page}: {start} to {end} of {count} record(s) found'),

'columns' => array(
		'id',
		'clubid',
		'pagegroupid',
		'title',
		'content',
		'membersonly',
		/*
		'deleted',
		'lastupdated',
		'created',
		'memberid',
		'migration_done',
		*/
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}',
		),
	),
)); ?>
        </div>
    </div>
</div>