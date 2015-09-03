<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */

if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
    $this->menu = array(
    	array('label' => sprintf(Yii::t('app', 'Import %s'), 'MiteMonitor'), 'url' => array('import')),
    );

?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">
            
 <?php 
    if (Yii::app()->user->getState('role') !== Users::USER_TYPE_GROWER)
        $this->renderPartial('_search',array(
                'modelGrower' => $modelGrower,
            )); ?>
            
        </div>
    </div>
    	<div class="row-fluid">
					<div class="span12">
						<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
							'action' => Yii::app()->createUrl($this->route),
							'method' => 'post',
							'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
						)); ?>
						<?php if($search):?>
						<?php echo TbHtml::textField('date',gmdate('Y-m-d'), array('class' => 'input-xxlarge datepick', 'placeholder' => gmdate('Y-m-d'))); ?> 
						<?php
						 foreach($modelGrower->search()->getData() as $grower){
							 foreach($grower->getProperties() as $property){
								echo '<h2><b>'.$grower->name.':</b> '.$property->name.'</h2>';
								
								foreach($property->getBlocks() as $block){
									echo '<div class="box box-small box-custom box-bordered">
                						  <div class="box-title"><h3>'.$block->name.'</h3></div>';
									echo '
									<div class="box-content nopadding">
								    <table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Mite</th>
											<th style="text-align: right;border-left: 0 none;">% Li</th>
											<th style="text-align: right;border-left: 0 none;">No days b/n</th>
										</tr>
									</thead>
									<tbody id="tbl_'.$block->id.'">';
									foreach($block->getMites() as $monitor){
										echo '<tr>';
										echo '<td>'.$monitor->name.'</td>';
										echo '<td style="text-align: right;border-left: 0 none;"><input type="text" name="PercentLi['.$block->id.','.$monitor->id.']" class="spinner" value="" style="width: 30px;" /></td>';
										echo '<td style="text-align: right;border-left: 0 none;"><input type="text" name="NoDays['.$block->id.','.$monitor->id.']" class="spinner" value="" style="width: 30px;" /></td>';
										
										echo '</tr>';
									}
									echo '</tbody>
								</table>
								</div>	</div>';
								}
								}
							
							}
					
						
						?>
						      
                    	<div class="form-actions">
                        <?php echo TbHtml::submitButton(Yii::t('app', 'Submit'),array(
                            'color'=>'','class'=>'input-xxlarge btn btn-large',
                        )); ?>
                    	</div>
               			<?php endif;?>
               			
						 <?php $this->endWidget(); ?>
						 
						<div class="box box-color box-bordered">
							<div class="box-title">
							<h3>
									<i class="icon-table"></i>
									Latest Mite Monitoring
								</h3>
							
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
										<th>Mite</th>
                                        <th>Date</th>
										<th style="text-align: right;">% Li</th>
										<th class="hidden-mobile-360" style="text-align: right;">No days b/n</th>
										<th class="hidden-mobile-400" style="text-align: right;">AVG Li</th>
										<th></th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($dataProvider->getData() as $lastest):?>
										<tr>
											<td><?php echo $lastest['monitoring_name'] ; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($lastest['date'])) ; ?></td>
											<td style="text-align: right;">
												<?php echo $lastest['percent_li'] ;?>%
											</td>
											<td class="hidden-mobile-360"  style="text-align: right;">
												<?php echo $lastest['no_days'] ;?>
											</td>
											<td class="hidden-mobile-400" style="text-align: right;">
												<?php echo !empty($lastest['mm_average_li'])?$lastest['mm_average_li']:0 ;?>
											</td>
											<td style="text-align: right;width: 65px">
    											<a href="<?php echo Yii::app()->baseUrl."/monitoring/update/".$lastest['monitoring_id'] ?>" rel="tooltip" class="btn" data-original-title="Edit <?php echo $lastest['monitoring_name'] ; ?>"><i class="icon-edit"></i></a>
    											<a href="<?php echo Yii::app()->baseUrl."/monitoring/delete/".$lastest['monitoring_id'] ?>" rel="tooltip" class="btn" data-original-title="Delete <?php echo $lastest['monitoring_name'] ; ?>"><i class="icon-remove"></i></a>
											</td>
										</tr>
									<?php endforeach;?>
									</tbody>
								</table>
								
								</div>
						</div>
					</div>
				</div>
</div>