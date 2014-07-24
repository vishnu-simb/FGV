<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model<?php echo $this->modelClass; ?> <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
echo "\$label = sprintf(Yii::t('app', 'Manage %s'), '". $this->pluralize($this->modelClass) ."');\n";
echo "\$this->breadcrumbs = array(
	\$label => array('index'),
	\$model$this->modelClass->{$nameColumn} => array('update', 'id' => \$model".$this->modelClass."->{$this->tableSchema->primaryKey}),
	Yii::t('app', 'View'),
);\n";
?>

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), '<?php echo $this->pluralize($this->modelClass); ?>'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), '<?php echo $this->modelClass; ?>'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'Update this item'), '<?php echo $this->modelClass; ?>'), 'url' => array('update', 'id' => $model<?php echo $this->modelClass; ?>-><?php echo $this->tableSchema->primaryKey; ?>)),
    array('label' => sprintf(Yii::t('app', 'Delete this item'), '<?php echo $this->modelClass; ?>'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model<?php echo $this->modelClass; ?>-><?php echo $this->tableSchema->primaryKey; ?>), 'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'))),
);

?>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover table-view-details',
    ),
    'data' => $model<?php echo $this->modelClass; ?>,
    'attributes' => array(
<?php
foreach ($this->tableSchema->columns as $column) {
    echo "\t\t'" . $column->name . "',\n";
}
?>
	),
)); ?>