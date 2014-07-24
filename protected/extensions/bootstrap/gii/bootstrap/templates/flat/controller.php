<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass . "\n"; ?>
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model<?php echo $this->modelClass; ?> = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), '<?php echo $this->modelClass; ?>', $model<?php echo $this->modelClass; ?>-><?php echo $this->tableSchema->primaryKey ?>);
		$this->render('view', array(
			'model<?php echo $this->modelClass; ?>' => $model<?php echo $this->modelClass; ?>,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), '<?php echo $this->modelClass; ?>');
		$model<?php echo $this->modelClass; ?> = new <?php echo $this->modelClass; ?>;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model<?php echo $this->modelClass; ?>);

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model<?php echo $this->modelClass; ?>->attributes = $_POST['<?php echo $this->modelClass; ?>'];
			if ($model<?php echo $this->modelClass; ?>->save()) {
				$this->redirect(array('view', 'id' => $model<?php echo $this->modelClass; ?>-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('create', array(
			'model<?php echo $this->modelClass; ?>' => $model<?php echo $this->modelClass; ?>,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model<?php echo $this->modelClass; ?> = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), '<?php echo $this->modelClass; ?>', $model<?php echo $this->modelClass; ?>-><?php echo $this->tableSchema->primaryKey ?>);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model<?php echo $this->modelClass; ?>);

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model<?php echo $this->modelClass; ?>->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if ($model<?php echo $this->modelClass; ?>->save()) {
				$this->redirect(array('view', 'id' => $model<?php echo $this->modelClass; ?>-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('update', array(
			'model<?php echo $this->modelClass; ?>' => $model<?php echo $this->modelClass; ?>,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		} else {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The Delete Request for ID %s in %s is not working correctly.'),
                $id,
                '<?php echo $this->modelClass; ?>'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), '<?php echo $this->pluralize($this->modelClass); ?>');
		$model<?php echo $this->modelClass; ?> = new <?php echo $this->modelClass; ?>('search');
		$model<?php echo $this->modelClass; ?>->unsetAttributes();  // clear any default values
		if (isset($_GET['<?php echo $this->modelClass; ?>'])) {
			$model<?php echo $this->modelClass; ?>->attributes = $_GET['<?php echo $this->modelClass; ?>'];
		}

		$this->render('index', array(
			'model<?php echo $this->modelClass; ?>' => $model<?php echo $this->modelClass; ?>,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return <?php echo $this->modelClass; ?> the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model<?php echo $this->modelClass; ?> = <?php echo $this->modelClass; ?>::model()->findByPk($id);
		if ($model<?php echo $this->modelClass; ?> === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                '<?php echo $this->modelClass; ?>'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $model<?php echo $this->modelClass; ?>;
	}

	/**
	 * Performs the AJAX validation.
	 * @param <?php echo $this->modelClass; ?> $model<?php echo $this->modelClass; ?> the model to be validated
	 */
	protected function performAjaxValidation($model<?php echo $this->modelClass; ?>)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === '<?php echo $this->class2id($this->modelClass); ?>-form') {
			echo CActiveForm::validate($model<?php echo $this->modelClass; ?>);
			Yii::app()->end();
		}
	}
}