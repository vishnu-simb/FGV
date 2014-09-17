<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	       'id'=>'dashboard-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
           'enableAjaxValidation'=>false,
           'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate'),
            // for enabling client validation
           'enableClientValidation' => false,
           'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
)); ?>


<div class="search-form-ext">
    <div class="box-content nopadding">
                    <div class="span12">
                    	 <div style="float:left;">
                    	 <?php if(Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER):?>
                    	   <?php echo $form->dropDownList($modelBlock, 'id', CHtml::listData($modelBlock->getBlockByGrowerId(Yii::app()->user->id),'id','name','property.name'), array('class' => 'growerable input-xxlarge'))?>
                    	 	<?php echo $form->dropDownList($modelGrower, 'id', CHtml::listData($modelGrower->findAllPk(Yii::app()->user->id) ,'id','name'), array('prompt'=>'Reports','class' => 'clickable input-xlarge'))?>
                    	  <?php else:?>
                    		<?php echo $form->dropDownList($modelGrower, 'id', CHtml::listData($modelGrower->findAll() ,'id','name'), 
                    				array(
										'class' => 'select2-me input-xlarge',
										'ajax' => array(
												'type' => 'POST',
												'url'=>$this->createUrl('api/web/block'),
												'update' => '#Block_id',
												'data'=>array('grower_id'=>'js:this.value',),
												'success'=> 'function(data) {
										                                 $("#Block_id").empty();
										                                 $("#Block_id").append(data);
										                                 $("#Block_id").trigger("liszt:updated");
																		 var t = $("#Block_id").find("option[value="+$("#Block_id").val()+"]");
																		 var g = $("#Grower_id").find("option[value="+$("#Grower_id").val()+"]");
																		 if(typeof g.html() != "undefined")
																		 $("h1").html(g.html()+": "+t.html());
																		 $("#yw0").html("");
																		 drawTrapCheckChart();
																		 loadSprayTable();
																		 drawMiteMonitoringChart();
										
										  		} ',)
							))?>
		                    <?php echo $form->dropDownList($modelBlock, 'id', CHtml::listData($modelBlock->findAll() ,'id','name'), array('class' => 'blockable input-xxlarge'))?>
                     	  	<?php echo $form->dropDownList($modelGrower, 'id', CHtml::listData($modelGrower->findAll() ,'id','name'), array('prompt'=>'Reports','class' => 'clickable input-xlarge'))?>
                      	 <?php endif;?>
                    	 </div>
                    	   </div>
                       
            		</div>

            </div>
   
</div><!-- search-form -->

<?php $this->endWidget(); ?>
