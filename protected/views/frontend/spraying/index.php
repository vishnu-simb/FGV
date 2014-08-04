<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */

?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">

            <?php $this->renderPartial('_form',array(
                'modelSpray' => $modelSpray,
 )); ?>

        </div>
    </div>
    	<div class="row-fluid">
					<div class="span8">
					
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
											<td><?php echo $lastest['praying_name'] ; ?></td>
											<td style="width: 85px">
												<?php echo $lastest['praying_date'] ;?>
											</td>
											
											<td style="text-align: right;width: 65px">
											<a href="<?php echo Yii::app()->baseUrl."/spraying/update/".$lastest['praying_id'] ?>" rel="tooltip" class="btn" data-original-title="Edit <?php echo $lastest['praying_name'] ; ?>"><i class="icon-edit"></i></a>
											<a href="<?php echo Yii::app()->baseUrl."/spraying/delete/".$lastest['praying_id'] ?>" rel="tooltip" class="btn" data-original-title="Delete <?php echo $lastest['praying_name'] ; ?>"><i class="icon-remove"></i></a>
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