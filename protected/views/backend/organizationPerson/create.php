<?php
/* @var $this OrganizationPersonController */
/* @var $modelOrganizationPerson OrganizationPerson */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationPeople');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'OrganizationPerson'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OrganizationPeople'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelOrganizationPerson' => $modelOrganizationPerson)); ?>