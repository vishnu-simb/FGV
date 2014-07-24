<?php
/* @var $this OldPageController */
/* @var $modelOldPage OldPage */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OldPages');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelOldPage->title => array('update', 'id' => $modelOldPage->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OldPages'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'OldPage'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'OldPage'), 'url' => array('update', 'id' => $modelOldPage->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'OldPage'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelOldPage->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelOldPage,
    'attributes' => array(
		'id',
		'clubid',
		'pagegroupid',
		'title',
		'content',
		'membersonly',
		'deleted',
		'lastupdated',
		'created',
		'memberid',
		'migration_done',
	),
)); ?>