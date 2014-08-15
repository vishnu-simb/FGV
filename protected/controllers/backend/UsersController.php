<?php

class UsersController extends SimbController
{
	
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array(
						'allow',
						'actions' => array('index', 'logout'),
						'users' => array('@'),
						'expression'=>'Yii::app()->user->isAdmin()',
				),
				array(
						'deny',
						'actions' => array('index', 'logout'),
						'users' => array('*'),
						'deniedCallback' => array($this, 'redirectLoginNeeded'),
				),
	
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$modelUsers = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Users', $modelUsers->id);
		$this->render('view', array(
			'modelUsers' => $modelUsers,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Users');
		$modelUsers = new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelUsers);

		if (isset($_POST['Users'])) {
			$modelUsers->attributes = $_POST['Users'];
			if ($modelUsers->save()) {
				$this->redirect(array('view', 'id' => $modelUsers->id));
			}
		}

		$this->render('create', array(
			'modelUsers' => $modelUsers,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelUsers = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Users', $modelUsers->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelUsers);

		if (isset($_POST['Users'])) {
			$modelUsers->attributes=$_POST['Users'];
			if ($modelUsers->save()) {
				$this->redirect(array('view', 'id' => $modelUsers->id));
			}
		}

		$this->render('update', array(
			'modelUsers' => $modelUsers,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->getParam('get','delete')){
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
                'Users'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Users');
		$modelUsers = new Users('search');
		$modelUsers->unsetAttributes();  // clear any default values
		if (isset($_GET['Users'])) {
			$modelUsers->attributes = $_GET['Users'];
		}

		$this->render('index', array(
			'modelUsers' => $modelUsers,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelUsers = Users::model()->findByPk($id);
		if ($modelUsers === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Users'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelUsers;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $modelUsers the model to be validated
	 */
	protected function performAjaxValidation($modelUsers)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
			echo CActiveForm::validate($modelUsers);
			Yii::app()->end();
		}
	}
}