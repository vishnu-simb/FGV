<?php
/* @var $this GrowerController */
/* @var $data Grower */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grower_name')); ?>:</b>
	<?php echo CHtml::encode($data->grower_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grower_username')); ?>:</b>
	<?php echo CHtml::encode($data->grower_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grower_password')); ?>:</b>
	<?php echo CHtml::encode($data->grower_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grower_email')); ?>:</b>
	<?php echo CHtml::encode($data->grower_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grower_enabled')); ?>:</b>
	<?php echo CHtml::encode($data->grower_enabled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grower_reporting')); ?>:</b>
	<?php echo CHtml::encode($data->grower_reporting); ?>
	<br />

	<?php /*
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