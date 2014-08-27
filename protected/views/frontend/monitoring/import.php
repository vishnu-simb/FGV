<?php
/* @var $this MonitoringController */
/* @var $form TbActiveForm */
?>

<?php
$clientScript = Yii::app()->clientScript;
$resourceUrl = $clientScript->staticUrl.'/flatapp';
$label = sprintf(Yii::t('app', 'Mite Monitoring %s'), '');
$this->breadcrumbs = array(
    $label => array('index'),
	Yii::t('app', 'Import')
);
?>
<script>
    $(document).ready(function () {
        $('#import_file').bind('change', function(){
            var ext = $(this).val().replace(/^.*\./, '');
            if($.inArray(ext.toLowerCase(), ['csv']) == -1) {
                alert('Invalid extension! Please select a csv file.');
                $('#import_file').val('');
            }
        });
        $("#import-form").bind("submit", function() {
            var filepath = $('#import_file').val();
            if (filepath == ''){
                alert('Please select a csv file.');
                return false;
            }
            return true;
        });
    });
</script>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'import-form',
                'htmlOptions' => array('enctype' => 'multipart/form-data', 'style' => 'margin-top: 0;'),
            )); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-content">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">File to import (*.csv)</label>
                        <div class="controls">
                            <?php echo TbHTML::fileFieldControlGroup('import_file', '', array('id' => 'import_file', 'class' => 'input-xlarge'))?>
                        </div>
                        <p>Please download the sample file at <a href="<?=$resourceUrl.'/files/import_sample.csv'?>">here</a>.</p>
                    </div>
                </div>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo TbHtml::submitButton(Yii::t('app', 'Submit'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>