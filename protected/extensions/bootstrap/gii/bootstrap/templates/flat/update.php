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
	\$model$this->modelClass->{$nameColumn}=>array('view', 'id' => \$model".$this->modelClass."->{$this->tableSchema->primaryKey}),
	Yii::t('app', 'Update'),
);\n";
?>

$this->menu = array(
    array('label' => sprintf(Yii::t('app', 'Manage %s'), '<?php echo $this->pluralize($this->modelClass); ?>'), 'url' => array('index')),
    array('label' => sprintf(Yii::t('app', 'Create a new %s'), '<?php echo $this->modelClass; ?>'), 'url' => array('create')),
    array('label' => sprintf(Yii::t('app', 'View this item'), '<?php echo $this->modelClass; ?>'), 'url' => array('view', 'id' => $model<?php echo $this->modelClass; ?>-><?php echo $this->tableSchema->primaryKey; ?>)),
);
?>

<?php echo "<?php \$this->renderPartial('_form', array('model$this->modelClass'=>\$model$this->modelClass)); ?>"; ?>