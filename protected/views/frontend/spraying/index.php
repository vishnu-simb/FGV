<?php
/* @var $this SprayController */
/* @var $modelSpray Spray */

?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">

            <?php $this->renderPartial('_add',array(
                'modelSpray' => $modelSpray,
 )); ?>

        </div>
    </div>
    <?php
     	$dataProvider = $modelSpray->SearchLatestSpray();
     ?>
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
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
										</tr>
									</thead>
									<tbody>
									<?php foreach($dataProvider->getData() as $lastest):?>
										<tr>
											<td><?php echo $lastest['praying_name'] ; ?></td>
											<td>
												<?php echo $lastest['date'] ;?>
											</td>
											
											<td class='hidden-480'>
												<a href="<?php echo Yii::app()->baseUrl."/spraying/update/".$lastest['id'] ?>" rel="tooltip" title="" class="update" data-original-title="Update"><i class="icon-pencil"></i></a>
												<a href="<?php echo Yii::app()->baseUrl."/spraying/delete/".$lastest['id'] ?> " rel="tooltip" title="" class="delete" data-original-title="Delete"><i class="icon-trash"></i>
											</a></td>
										</tr>
									<?php endforeach;?>
									</tbody>
								</table>
								</div>
						</div>
					</div>
				</div>
</div>