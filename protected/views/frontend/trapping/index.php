<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */

?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">

 <?php $this->renderPartial('_search',array(
                'growers' => $growers,
            )); ?>

        </div>
    </div>
    	<div class="row-fluid">
					<div class="span8">
					
						<?php 
						foreach($growers as $grower){
							foreach($grower->getProperties() as $property){
								echo '<h2><b>'.$grower->name.':</b> '.$property->name.'</h2>';
								
								foreach($property->getBlocks() as $block){
									echo '<div class="box box-color box-bordered">
                						  <div class="box-title"><h3>'.$block->name.'</h3></div>';
									echo '
									<div class="box-content nopadding">
								    <table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
										</tr>
									</thead>
									<tbody>';
									foreach($block->getTraps() as $trap){
										echo '<tr>';
										echo '<td>'.$trap->name.' - '.$trap->pest .'</td>';
										echo '<td><input type="number" name="" class="pest_input" min="0" max="200" style="float: right;width: 30px;" /></td>';
										echo '</tr>';
									}
									echo '</tbody>
								</table>
								</div>	</div>';
								}
							}
							
						}
						
						?>
						<div class="box box-color box-bordered">
							<div class="box-title">
							<h3>
									<i class="icon-table"></i>
									Latest sprays
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
											<a href="<?php echo Yii::app()->baseUrl."/spraying/update/".$lastest['trap_check_id'] ?>" rel="tooltip" class="btn" data-original-title="Edit <?php echo $lastest['trap_check_name'] ; ?>"><i class="icon-edit"></i></a>
											<a href="<?php echo Yii::app()->baseUrl."/spraying/delete/".$lastest['trap_check_id'] ?>" rel="tooltip" class="btn" data-original-title="Delete <?php echo $lastest['trap_check_name'] ; ?>"><i class="icon-remove"></i></a>
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