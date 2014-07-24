<?php
/* @var $this OldNewsController */
/* @var $modelOldNews OldNews */


$this->breadcrumbs=array(
	'Old News' => array('index'),
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
	$('#old-news-grid').yiiGridView('update', {
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
                'modelOldNews' => $modelOldNews,
            )); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'old-news-grid',
	'dataProvider' => $modelOldNews->search(),
	'filter' => $modelOldNews,
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
		'newscategoryid',
		'lcid',
		'title',
		'abstract',
		/*
		'body',
		'copyright',
		'created',
		'inlinephotoid',
		'memberid',
		'published',
		'deleted',
		'lastupdated',
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