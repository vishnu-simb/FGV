<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model<?php echo $this->modelClass; ?> <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
<?php echo "?>\n"; ?>

<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl(\$this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>\n"; ?>

<div class="search-button-title">
    <?php echo "<?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>"; ?>
    <?php echo "<?php
            echo \$form->dropDownList(\$model".$this->modelClass.", 'rowsPerPage', \$model".$this->modelClass."->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => \"document.getElementById('\".\$form->id.\"').submit();\"));
            ?>"; ?>
</div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

        <?php
        $openSpan = true;
        $limit = ceil(count($this->tableSchema->columns)/3);
        $col = 1;
        $key=0;
        foreach ($this->tableSchema->columns as $column): ?>
            <?php
            $key++;
            if ($openSpan ) {
                echo '<div class="span4">';
                $openSpan = false;
            }
            $field = $this->generateInputField($this->modelClass, $column);
            if (strpos($field, 'password') !== false) {
                continue;
            }
            ?>
            <?php echo "<?php echo " . $this->generateActiveControlGroupFlat($this->modelClass, $column) . "; ?>\n"; ?>

            <?php
            if (!$openSpan && ($key >= $limit*$col) || ($key == count($this->tableSchema->columns))) {
                echo '</div>'."\n";
                $openSpan = true;
                $col++;
            }
            ?>
        <?php endforeach; ?>
    </div>
    <div class="form-actions">
        <?php echo "<?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>\n" ?>
    </div>
</div><!-- search-form -->

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>