<?php
/* @var $this OrganizationPersonController */
/* @var $modelOrganizationPerson OrganizationPerson */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationPeople');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelOrganizationPerson->id => array('update', 'id' => $modelOrganizationPerson->id),
	Yii::t('app', 'View'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OrganizationPeople'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'OrganizationPerson'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), 'OrganizationPerson'), 'url' => array('update', 'id' => $modelOrganizationPerson->id)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), 'OrganizationPerson'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $modelOrganizationPerson->id), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $modelOrganizationPerson,
    'attributes' => array(
		'id',
		'player_biography_id',
		'code',
		'first_name',
		'last_name',
		'slug',
		'old_member_id',
		'gender_id',
		'date_of_birth',
		'nationality',
		'country',
		'country_id',
		'creator_id',
		'ordering',
		'created_at',
		'updated_at',
		'status',
		'is_deleted',
		'params',
	),
)); ?>