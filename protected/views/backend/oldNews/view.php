<?php
/* @var $this OldNewsController */
/* @var $modelOldNews OldNews */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OldNews');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelOldNews->title => array('update', 'id' => $modelOldNews->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OldNews'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'OldNews'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'OldNews'), 'url' => array('update', 'id' => $modelOldNews->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'OldNews'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelOldNews->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelOldNews,
    'attributes' => array(
		'id',
		'clubid',
		'newscategoryid',
		'lcid',
		'title',
		'abstract',
		'body',
		'copyright',
		'created',
		'inlinephotoid',
		'memberid',
		'published',
		'deleted',
		'lastupdated',
		'migration_done',
	),
)); ?>