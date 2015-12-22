<?php
/* @var $this ChemicalController */
/* @var $modelChemical Chemical */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Chemicals');
$this->breadcrumbs = array(
	$label => array('index'),
	$modelChemical->name=>array('view', 'id' => $modelChemical->id),
	Yii::t('app', 'Update'),
);

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Chemicals'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), 'Chemical'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), 'Chemical'), 'url' => array('view', 'id' => $modelChemical->id)),
);
?>

<?php $this->renderPartial('_form', array('modelChemical'=>$modelChemical)); ?>