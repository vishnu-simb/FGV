<?php
/* @var $this OrganizationGroupController */
/* @var $modelOrganizationGroup OrganizationGroup */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationGroups');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelOrganizationGroup->name=>array('view', 'id' => $modelOrganizationGroup->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OrganizationGroups'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'OrganizationGroup'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'OrganizationGroup'), 'url' => array('view', 'id' => $modelOrganizationGroup->id)),
);
?>

<?php $this->renderPartial('_form', array('modelOrganizationGroup'=>$modelOrganizationGroup)); ?>