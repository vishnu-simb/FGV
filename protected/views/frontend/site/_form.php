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
                <div style="float:left;width: 100%;">
                    <?php if(Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER):?>
                        <div class="controls" style="margin:0px">
                            <div class="calendar fc">
                                <h4>Full Reports</h4>
                                <table class="fc-header" style="float: left;">
                                    <tbody><tr>
                                        <td class="fc-header-left">
                                        </td>
                                        <td class="fc-header-center" style="text-align: left;">
        					<span class="fc-button yr-button-prev fc-state-default fc-corner-left fc-corner-right">
        					<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-left"></i></span></span></span>
                                            <span class="fc-header-title"><h2><span id="yearPicker"><?= intval(date('m')) >=8 ? date('Y').'-'.date('Y', strtotime('+1 year')) : date('Y', strtotime('-1 year')).'-'.date('Y')?></span></h2></span>
                                            <span class="fc-button yr-button-next fc-state-default fc-corner-left fc-corner-right">
        					<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-right"></i></span></span></span></td><td class="fc-header-right"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php // echo $form->dropDownList($modelGrower, 'name', CHtml::listData($modelGrower->findAllPk(Yii::app()->user->id) ,'id','name'), array('prompt'=>'Grower Reports','class' => 'clickable input-xlarge'))?>
                            <select class="grower-name clickable input-xlarge" name="Grower[name]" id="Grower_name">
                                <option value="">One Block Report</option>
                                <option value="<?=Yii::app()->user->id?>">Report for All Blocks</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <br />
                        <h4>Spray dates report and graphs</h4>
                        <input type="hidden" id="Grower_id" value="<?=Yii::app()->user->id?>" />
                        <?php echo $form->dropDownList($modelBlock, 'id', CHtml::listData($modelBlock->getBlockByGrowerId(Yii::app()->user->id),'id','name','property.name'), array('class' => 'growerable input-xlarge'))?>
                    <?php else:?>
                        <div class="controls" style="margin:0px">
                            <div class="calendar fc">
                                <h4>Full Reports</h4>
                                <table class="fc-header" style="float: left;">
                                    <tbody><tr>
                                        <td class="fc-header-left">
                                        </td>
                                        <td class="fc-header-center" style="text-align: left;">
        						<span class="fc-button yr-button-prev fc-state-default fc-corner-left fc-corner-right">
        						<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-left"></i></span></span></span>
                                            <span class="fc-header-title"><h2><span id="yearPicker"><?= intval(date('m')) >=8 ? date('Y').'-'.date('Y', strtotime('+1 year')) : date('Y', strtotime('-1 year')).'-'.date('Y')?></span></h2></span>
                                            <span class="fc-button yr-button-next fc-state-default fc-corner-left fc-corner-right">
        						<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-right"></i></span></span></span></td><td class="fc-header-right"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                            <?php echo $form->dropDownList($modelGrower, 'name', CHtml::listData($modelGrower->byname()->findAllActive() ,'id','name'),
                                array(
                                    'prompt'=> 'Grower Reports',
                                    'class' => 'select2-me input-xlarge',
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url'=>$this->createUrl('api/web/block'),
                                        'update' => '#Block_id_for_report',
                                        'data'=>array('grower_id'=>'js:this.value', 'show_all' => 1),
                                        'success'=> 'function(data) { 
    		                                 $("#Block_id_for_report").empty();
    		                                 $("#Block_id_for_report").append(data + "<option value=\"\">ALL BLOCKS</option>");
    		                                 $("#Block_id_for_report").trigger("liszt:updated");
    							  		} ',)
                                )
                            );?>
                            <?php echo $form->dropDownList($modelBlock, 'id', array('' => ' - Select Block'), array('class' => 'blockable clickable select2-me input-xlarge', 'id' => 'Block_id_for_report')); ?>
                        </div>
                        <div class="clearfix"></div>
                        <br />
                        <h4>Spray dates report and graphs</h4>
                        <?php echo $form->dropDownList($modelGrower, 'id', CHtml::listData($modelGrower->byname()->findAllActive() ,'id','name'),
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
                            ));
                        ?>
                        <?php echo $form->dropDownList($modelBlock, 'id', CHtml::listData($modelBlock->findAll() ,'id','name'), array('class' => 'blockable select2-me input-xlarge'))?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div><!-- search-form -->
<?php $this->endWidget(); ?>