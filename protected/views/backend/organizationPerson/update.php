<?php
/* @var $this OrganizationPersonController */
/* @var $modelOrganizationPerson OrganizationPerson */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationPeople');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelOrganizationPerson->id=>array('view', 'id' => $modelOrganizationPerson->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'OrganizationPeople'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'OrganizationPerson'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'OrganizationPerson'), 'url' => array('view', 'id' => $modelOrganizationPerson->id)),
);
?>

<?php $this->renderPartial('_form', array('modelOrganizationPerson'=>$modelOrganizationPerson)); ?>