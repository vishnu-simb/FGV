<?php

class OrganizationGroupController extends SimbControllerBackend
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelOrganizationGroup = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'OrganizationGroup', $modelOrganizationGroup->id);
		$this->render('view', array(
			'modelOrganizationGroup' => $modelOrganizationGroup,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'OrganizationGroup');
		$modelOrganizationGroup = new OrganizationGroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelOrganizationGroup);

		if (isset($_POST['OrganizationGroup'])) {
			$modelOrganizationGroup->attributes = $_POST['OrganizationGroup'];
			if ($modelOrganizationGroup->save()) {
				$this->redirect(array('view', 'id' => $modelOrganizationGroup->id));
			}
		}

		$this->render('create', array(
			'modelOrganizationGroup' => $modelOrganizationGroup,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelOrganizationGroup = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'OrganizationGroup', $modelOrganizationGroup->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelOrganizationGroup);

		if (isset($_POST['OrganizationGroup'])) {
			$modelOrganizationGroup->attributes=$_POST['OrganizationGroup'];
			if ($modelOrganizationGroup->save()) {
				$this->redirect(array('view', 'id' => $modelOrganizationGroup->id));
			}
		}

		$this->render('update', array(
			'modelOrganizationGroup' => $modelOrganizationGroup,
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
                'OrganizationGroup'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'OrganizationGroups');
		$modelOrganizationGroup = new OrganizationGroup('search');
		$modelOrganizationGroup->unsetAttributes();  // clear any default values
		if (isset($_GET['OrganizationGroup'])) {
			$modelOrganizationGroup->attributes = $_GET['OrganizationGroup'];
		}

		$this->render('index', array(
			'modelOrganizationGroup' => $modelOrganizationGroup,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrganizationGroup the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelOrganizationGroup = OrganizationGroup::model()->findByPk($id);
		if ($modelOrganizationGroup === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'OrganizationGroup'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelOrganizationGroup;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OrganizationGroup $modelOrganizationGroup the model to be validated
	 */
	protected function performAjaxValidation($modelOrganizationGroup)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'organization-group-form') {
			echo CActiveForm::validate($modelOrganizationGroup);
			Yii::app()->end();
		}
	}
}