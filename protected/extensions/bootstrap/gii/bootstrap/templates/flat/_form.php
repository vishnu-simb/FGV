<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
/* @var $this BootstrapCode */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model<?php echo $this->modelClass; ?> <?php echo $this->getModelClass(); ?> */
/* @var $form TbActiveForm */
<?php echo "?>\n"; ?>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo "<?php echo Yii::t('app', 'Fields with <span class=\"required\">*</span> are required.') ?>" ?>
</div>

<?php echo "<?php \$form = \$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'" . $this->class2id($this->modelClass) . "-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class' => 'form-horizontal form-column form-bordered form-validate'),
                // for enabling client validation
                'enableClientValidation' => true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>\n"; ?>

<?php echo "<?php echo \$form->errorSummary(\$model$this->modelClass); ?>\n"; ?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered">
            <div class="box-title">
                <h3><i class="icon-th-list"></i><?php echo "<?php echo Yii::t('app', 'General Info') ?>"; ?></h3>
            </div>
            <div class="box-content nopadding">

            <?php
            $openSpan = true;
            $limit = ceil(count($this->tableSchema->columns)/2);
            $col = 1;
            $key=0;
            foreach ($this->tableSchema->columns as $column) {
                $key++;
                if ($column->autoIncrement) {
                    continue;
                }
                ?>
                <?php
                if ($openSpan ) {
                    echo '<div class="span6">';
                    $openSpan = false;
                }
                echo "<?php echo " . $this->generateActiveControlGroupFlat($this->modelClass, $column) . "; ?>\n";

                if (!$openSpan && (($key >= $limit*$col) || ($key == count($this->tableSchema->columns)))) {
                    echo '</div>'."\n";
                    $openSpan = true;
                    $col++;
                }

                ?>

            <?php
            }
            ?>
                <div class="span12">
                    <div class="form-actions">
                        <?php echo "<?php echo TbHtml::submitButton(\$model". $this->modelClass."->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>\n"; ?>
                    </div>
                </div>

                <?php echo "<?php \$this->endWidget(); ?>\n"; ?>
            </div>
        </div>
    </div>
</div>