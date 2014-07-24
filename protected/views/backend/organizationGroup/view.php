<?php
/* @var $this OrganizationGroupController */
/* @var $modelOrganizationGroup OrganizationGroup */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationGroups');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelOrganizationGroup->name => array('update', 'id' => $modelOrganizationGroup->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OrganizationGroups'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'OrganizationGroup'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'OrganizationGroup'), 'url' => array('update', 'id' => $modelOrganizationGroup->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'OrganizationGroup'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelOrganizationGroup->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelOrganizationGroup,
    'attributes' => array(
		'id',
		'code',
		'name',
		'number',
		'display_name',
		'contact',
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
	),
)); ?>