<?php
/* @var $this BlockController */
/* @var $modelBlock Block */
?>

<?php
$label = sprintf(Yii::t('app', 'Manage %s'), 'Blocks');
$this->breadcrumbs = array(
	$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), 'Block'),
);

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), 'Blocks'), 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('create',"
    $(document).ready(function(){
        $('#Block_tree_variety').change(function(){
            var val = $(this).val();
            if (val.length){
                $('#new_variety_group').val('');
                $('#new_variety_group').hide();
            }else{
                $('#new_variety_group').show();
            }
        });
    });
");

?>

<?php $this->renderPartial('_create', array('modelBlock' => $modelBlock)); ?>