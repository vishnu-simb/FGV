<?php
/* @var $this OldNewsController */
/* @var $data OldNews */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clubid')); ?>:</b>
	<?php echo CHtml::encode($data->clubid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('newscategoryid')); ?>:</b>
	<?php echo CHtml::encode($data->newscategoryid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lcid')); ?>:</b>
	<?php echo CHtml::encode($data->lcid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abstract')); ?>:</b>
	<?php echo CHtml::encode($data->abstract); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('body')); ?>:</b>
	<?php echo CHtml::encode($data->body); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('copyright')); ?>:</b>
	<?php echo CHtml::encode($data->copyright); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inlinephotoid')); ?>:</b>
	<?php echo CHtml::encode($data->inlinephotoid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('memberid')); ?>:</b>
	<?php echo CHtml::encode($data->memberid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published')); ?>:</b>
	<?php echo CHtml::encode($data->published); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastupdated')); ?>:</b>
	<?php echo CHtml::encode($data->lastupdated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('migration_done')); ?>:</b>
	<?php echo CHtml::encode($data->migration_done); ?>
	<br />

	*/ ?>

</div>