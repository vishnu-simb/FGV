<?php
/* @var $this ChemicalController */
/* @var $modelChemical Chemical */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Chemicals');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Chemical'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Chemicals'), 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('modelChemical' => $modelChemical)); ?>