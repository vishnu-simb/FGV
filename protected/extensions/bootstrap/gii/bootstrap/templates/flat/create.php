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
echo "\$label = sprintf(Yii::t('app', 'Manage %s'), '". $this->pluralize($this->modelClass) ."');\n";
echo "\$this->breadcrumbs = array(
	\$label => array('index'),
	sprintf(Yii::t('app', 'Create a new %s'), '$this->modelClass'),
);\n";
?>

$this->menu = array(
	array('label' => sprintf(Yii::t('app', 'Manage %s'), '<?php echo $this->pluralize($this->modelClass); ?>'), 'url'=>array('index')),
);
?>

<?php echo "<?php \$this->renderPartial('_form', array('model$this->modelClass' => \$model$this->modelClass)); ?>"; ?>