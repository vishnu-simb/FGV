<?php
/* @var $this OldPageController */
/* @var $data OldPage */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clubid')); ?>:</b>
	<?php echo CHtml::encode($data->clubid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pagegroupid')); ?>:</b>
	<?php echo CHtml::encode($data->pagegroupid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('membersonly')); ?>:</b>
	<?php echo CHtml::encode($data->membersonly); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lastupdated')); ?>:</b>
	<?php echo CHtml::encode($data->lastupdated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('memberid')); ?>:</b>
	<?php echo CHtml::encode($data->memberid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('migration_done')); ?>:</b>
	<?php echo CHtml::encode($data->migration_done); ?>
	<br />

	*/ ?>

</div>