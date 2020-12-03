<?php
Yii::app()->clientScript->registerScript('trapping',"
    $('.crop-daterangepick').daterangepicker(
        {format: 'DD/MM/YY'}
    );
");

if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
    $this->menu = array(
        array('label' => sprintf(Yii::t('app', 'Import %s'), 'Trapping'), 'url' => array('import')),
    );
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
    <?php if (!empty($foundGrowerIDs)): ?>
        <div class="row-fluid">
            <div class="span12">
                <h4>Export to XLS</h4>
                <form class="form-horizontal form-search-advanced form-validate" id="export-xls" action="/crop/xls" method="post" novalidate="novalidate">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Date range</label>
                        <div class="controls">
                            <input type="text" name="dates" id="dates" class="input-large crop-daterangepick" value="<?=date('d/m/y', strtotime('-1 month'))?> - <?=date('d/m/y')?>">
                        </div>
                    </div>
                    <input type="hidden" name="ids" value="<?=$foundGrowerIDs ?>" />
                    <button class="btn btn-success" type="submit">Export to XLS</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div class="row-fluid">
        <div class="span12">
            <h4>New Crop Monitor Record</h4>
            <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'action' => Yii::app()->createUrl($this->route),
                'method' => 'post',
                'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
            )); ?>
            <?php if($search):?>
                <?php echo TbHtml::textField('date',gmdate('Y-m-d'), array('class' => 'datepick', 'placeholder' => gmdate('Y-m-d'))); ?>
                <div class="bootstrap-timepicker" style="display: inline-block;">
                    <?php echo TbHtml::textField('time',gmdate('H:i'), array('class' => 'timepick', 'placeholder' => gmdate('H:i'))); ?>
                </div>
                <?php echo TbHtml::textField('duration','', array('placeholder' => 'Duration in minutes'));?>
                <?php
                $dataPests = $modelGrower->getPestsDataProvider();
                foreach($modelGrower->search()->getData() as $grower){
                    foreach($grower->getProperties() as $property){
                        echo '<h2><b>'.$grower->name.':</b> '.$property->name.'</h2>';

                        foreach($property->getBlocks() as $block){
                            echo '<div class="box box-small box-custom box-bordered">
                						  <div class="box-title"><h3>'.$block->name.'</h3></div>';
                            $this->widget('bootstrap.widgets.TbGridView', array(
                                'id' => 'crop-pests-grid',
                                'dataProvider' =>  $dataPests,
                                //'filter' => false,
                                'ajaxUpdate' => false,
                                'enablePagination'=>true,
                                'itemsCssClass' => 'table-hover table-nomargin table-striped',
                                'summaryText' => false,
                                'columns' => array(
                                    array('name'=>'name','header'=>''),
                                    array('name'=>'','value'=>function($data)use($block){
                                        echo '<input type="text" name="CropPests['.$block->id.']['.$data['id'].']" class="spinner" style="width: 30px;" />';
                                    },'header'=>'','htmlOptions' => array('class' => 'right-cell'))
                                ),
                            ));
                            echo '</div>';
                            echo TbHtml::textField('Comments['.$block->id.']','', array('style' => 'width: 100%;', 'placeholder' => 'Comment for "'.$block->name.'"'));
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
                        Latest Crop Monitoring
                    </h3>

                </div>
                <div class="box-content nopadding">
                    <table class="table table-hover table-nomargin table-bordered">
                        <thead>
                        <tr>
                            <th>Pest</th>
                            <th>Date</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($dataProvider->getData() as $lastest):?>
                            <tr>
                                <td><?php echo $lastest['monitoring_name'] ; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($lastest['date'])). ' '. substr($lastest['time'], 0, 5) ; ?></td>
                                <td style="text-align: center;">
                                    <?php echo $lastest['monitoring_number'] ;?>
                                </td>
                                <td style="text-align: right;width: 65px">
                                    <a href="<?php echo Yii::app()->baseUrl."/crop/update/".$lastest['monitoring_id'] ?>" rel="tooltip" class="btn" data-original-title="Edit <?php echo $lastest['monitoring_name'] ; ?>"><i class="icon-edit"></i></a>
                                    <a href="<?php echo Yii::app()->baseUrl."/crop/delete/".$lastest['monitoring_id'] ?>" rel="tooltip" class="btn" data-original-title="Delete <?php echo $lastest['monitoring_name'] ; ?>"><i class="icon-remove"></i></a>
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