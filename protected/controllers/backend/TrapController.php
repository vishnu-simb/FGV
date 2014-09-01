<?php

class TrapController extends SimbController
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
		$modelTrap = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'View %s ID: #%s'), 'Trap', $modelTrap->id);
		$this->render('view', array(
			'modelTrap' => $modelTrap,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Create %s'), 'Trap');
		$modelTrap = new Trap;

		if (isset($_GET['Trap'])) {
			$modelTrap->attributes = $_GET['Trap'];
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelTrap);

		if (isset($_POST['Trap'])) {
			$modelTrap->attributes = $_POST['Trap'];
			if ($modelTrap->save()) {
				
				if($_POST['Trap']['_addMoreTrap'] == 'yes'){ // _addBlock enabled
					$this->redirect(array('trap/create', 'Trap[block_id]' => $modelTrap->block_id));
				}else{
					$this->redirect(array('view', 'id' => $modelTrap->id));
				}
			}
		}

		$this->render('create', array(
			'modelTrap' => $modelTrap,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelTrap = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Trap', $modelTrap->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelTrap);

		if (isset($_POST['Trap'])) {
			$modelTrap->attributes=$_POST['Trap'];
			if ($modelTrap->save()) {
				$this->redirect(array('view', 'id' => $modelTrap->id));
			}
		}

		$this->render('update', array(
			'modelTrap' => $modelTrap,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->getParam('get','delete')) {
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
                'Trap'
            ) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Manage %s'), 'Traps');
		$modelTrap = new Trap('search');
		$modelTrap->unsetAttributes();  // clear any default values
		if (isset($_GET['Trap'])) {
			$criteria = $_GET['Trap'];
			Yii::app()->session['Trap'] = $criteria;
		}
		$modelTrap->attributes = Yii::app()->session['Trap'];
		$this->render('index', array(
			'modelTrap' => $modelTrap,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Trap the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelTrap = Trap::model()->findByPk($id);
		if ($modelTrap === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Trap'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelTrap;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Trap $modelTrap the model to be validated
	 */
	protected function performAjaxValidation($modelTrap)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'trap-form') {
			echo CActiveForm::validate($modelTrap);
			Yii::app()->end();
		}
	}
}