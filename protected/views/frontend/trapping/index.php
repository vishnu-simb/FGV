<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */

?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">

 	<?php 
        if (Yii::app()->user->getState('role') !== Users::USER_TYPE_GROWER)
             $this->renderPartial('_search',array(
                        'modelGrower' => $modelGrower,
             )); 
    ?>

        </div>
    </div>
    	<div class="row-fluid">
					<div class="span8">
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
									$this->widget('bootstrap.widgets.TbGridView', array(
											'id' => 'trap-grid',
											'dataProvider' =>  $block->getTrapsGrower(),
											//'filter' => false,
											'ajaxUpdate' => false,
											'enablePagination'=>true,
											'itemsCssClass' => 'table-hover table-nomargin table-striped',
											'summaryText' => false,
											'columns' => array(
													array('name'=>'ordering','header'=>'','class' =>'ext.yii-ordering-column.columnBlock','visible' => Yii::app()->user->getState('role') == Users::USER_TYPE_ADMIN,'filter'=>false),
													array('name'=>'trap_name','header'=>''),
													array('name'=>'','value'=>function($data){
															echo '<input type="text" name="Traps['.$data['id'].']" class="spinner" style="width: 30px;" />';
														},'header'=>'','htmlOptions' => array('class' => 'right-cell')), 

													
											),
									));
									echo '</div>';
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
									Latest Trapping
								</h3>
							
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
										</tr>
									</thead>
									<tbody>
									<?php foreach($dataProvider->getData() as $lastest):?>
										<tr>
											<td><?php echo $lastest['trap_check_name'] ; ?></td>
											<td style="text-align: center;">
												<?php echo $lastest['trap_check_number'] ;?>
											</td>
											
											<td style="text-align: right;width: 65px">
											<a href="<?php echo Yii::app()->baseUrl."/trapping/update/".$lastest['trap_check_id'] ?>" rel="tooltip" class="btn" data-original-title="Edit <?php echo $lastest['trap_check_name'] ; ?>"><i class="icon-edit"></i></a>
											<a href="<?php echo Yii::app()->baseUrl."/trapping/delete/".$lastest['trap_check_id'] ?>" rel="tooltip" class="btn" data-original-title="Delete <?php echo $lastest['trap_check_name'] ; ?>"><i class="icon-remove"></i></a>
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