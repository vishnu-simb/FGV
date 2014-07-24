<?php
/* @var $this OrganizationGroupController */
/* @var $modelOrganizationGroup OrganizationGroup */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationGroups');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'OrganizationGroup'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OrganizationGroups'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelOrganizationGroup' => $modelOrganizationGroup)); ?>