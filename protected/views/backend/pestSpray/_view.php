<?php
/* @var $this PestSprayController */
/* @var $data PestSpray */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pest_id')); ?>:</b>
	<?php echo CHtml::encode($data->pest_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grower_id')); ?>:</b>
	<?php echo CHtml::encode($data->grower_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dd')); ?>:</b>
	<?php echo CHtml::encode($data->dd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('every')); ?>:</b>
	<?php echo CHtml::encode($data->every); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lowpop_dd')); ?>:</b>
	<?php echo CHtml::encode($data->lowpop_dd); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lowpop_every')); ?>:</b>
	<?php echo CHtml::encode($data->lowpop_every); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?>:</b>
	<?php echo CHtml::encode($data->creator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ordering')); ?>:</b>
	<?php echo CHtml::encode($data->ordering); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('params')); ?>:</b>
	<?php echo CHtml::encode($data->params); ?>
	<br />

	*/ ?>

</div>