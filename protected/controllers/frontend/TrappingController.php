<?php

class TrappingController extends SimbController
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$modelTrapCheck = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'TrapCheck', $modelTrapCheck->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelTrapCheck);

		if (isset($_POST['TrapCheck'])) {
			$modelTrapCheck->attributes=$_POST['TrapCheck'];
			try{
				if ($modelTrapCheck->save()) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('success', Yii::t('app', 'The system has saved your data successfully !'));
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
			}catch(Exception $e) {
				$modelTrapCheck->addError(null, Yii::t('app', 'Trap has already been taken same block'));
			}
		}

		$this->render('update', array(
			'modelTrapCheck' => $modelTrapCheck,
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
					'Spray'
			) : Yii::t('app', 'Invalid request. Please do not repeat this request again.');
			throw new CHttpException(400, $errorText);
		}
	}
	
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Trapping %s'), '');
		$modelTrapCheck = new TrapCheck();
		$modelGrower = new Grower();
		$modelGrower->unsetAttributes();  // clear any default values
		$search = false;
		if (isset($_GET['Grower'])) {
			$modelGrower->attributes = $_GET['Grower'];
			$search = true;
		}
		if(isset($_POST['Traps'])){
			try{
				foreach ($_POST['Traps'] as $key => $value){ // save multiple records
					if($value != ""){
						$saveTrapCheck = new TrapCheck();
						$save = array('value'=>$value,'trap_id'=>$key,'date'=>!empty($_POST['date'])?$_POST['date']:gmdate('Y-m-d'));
						$saveTrapCheck->attributes = $save;
						if($saveTrapCheck->save()){
							Yii::app()->session->open();
							Yii::app()->user->setFlash('success', Yii::t('app', 'Trap added successfully !'));
						}
					}
				}
			}catch (Exception $e) {
					Yii::app()->session->open();
					Yii::app()->user->setFlash('error', Yii::t('app', 'Trap has already been taken same block !'));
	    	}
	    	// reinit session to store flash
	    	
	    		
		}
		$this->render('index', array(
				'modelTrapCheck' => $modelTrapCheck,
				'dataProvider' => $modelTrapCheck->SearchRecentTrapings(),
				'modelGrower' => $modelGrower,
				'search' => $search,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TrapCheck the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelTrapCheck = TrapCheck::model()->findByPk($id);
		if ($modelTrapCheck === null) {
			$errorText = YII_DEBUG ? sprintf(
					Yii::t('app', 'The ID %s does not exist in %s.'),
					$id,
					'TrapCheck'
			) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelTrapCheck;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param TrapCheck $modelTrapCheck the model to be validated
	 */
	protected function performAjaxValidation($modelTrapCheck)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'trap-check-form') {
			echo CActiveForm::validate($modelTrapCheck);
			Yii::app()->end();
		}
	}
	
	public function actions()
	{
		return array(
				'order' => array(
						'class' => 'ext.yii-ordering-column.actionBlock', // sort by group block_id
						'modelClass' => 'Trap',
						'pkName'  => 'ordering',
				),
		);
	}
	
}