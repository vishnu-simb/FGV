<?php

class SprayingController extends SimbController
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
	
		$modelSpray = $this->loadModel($id);
		$this->pageTitle = sprintf(Yii::t('app', 'Update %s ID: #%s'), 'Spray', $modelSpray->id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($modelSpray);
		if (isset($_POST['Spray'])) {
			$modelSpray->attributes=$_POST['Spray'];
			if ($modelSpray->save()) {
				// reinit session to store flash
				Yii::app()->session->open();
				Yii::app()->user->setFlash('success', Yii::t('app', 'The system has saved your data successfully'));
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		}
		$this->render('update', array(
				'modelSpray' => $modelSpray,
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
				// reinit session to store flash
				Yii::app()->session->open();
				Yii::app()->user->setFlash('success', Yii::t('app', 'Spray ID: #'.$id.' delete successfully!'));
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
		$this->pageTitle = sprintf(Yii::t('app', '%s'), 'Spraying');
		$modelSpray = new Spray();
		$modelSpray->unsetAttributes();  // clear any default values
		if (isset($_POST['Spray'])) {
		    if (!empty($_POST['Spray']['block_id']) && is_array($_POST['Spray']['block_id']))
            {    
                $block_ids = $_POST['Spray']['block_id'];
                unset($_POST['Spray']['block_id']);
                $inserted_ids = array();
                foreach($block_ids as $block_id)
                {
                    $mSpray = new Spray();
                    $mSpray->unsetAttributes();
                    $mSpray->attributes = $_POST['Spray'];
                    $mSpray->block_id = $block_id;
                    if ($mSpray->save()) {
                        $inserted_ids[] = $mSpray->id;
                    }
                }
                if (!empty($inserted_ids))
                {
                    // reinit session to store flash
    				Yii::app()->session->open();
    				Yii::app()->user->setFlash('success', Yii::t('app', 'Spray ID: #'.implode(',', $inserted_ids).' create successfully!'));
                }
            }
            else
            {
                $modelSpray->attributes = $_POST['Spray'];
    			if ($modelSpray->save()) {
    				// reinit session to store flash
    				Yii::app()->session->open();
    				Yii::app()->user->setFlash('success', Yii::t('app', 'Spray ID: #'.$modelSpray->id.' create successfully!'));
    			}
            }
		}
        $grower_id = '';
        if (Yii::app()->user->getState('role') === Users::USER_TYPE_GROWER)
            $grower_id = Yii::app()->user->id;
		$this->render('index', array(
				'modelSpray' => $modelSpray,
				'dataProvider' => $modelSpray->SearchLatestSpray($grower_id),
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Spray the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelSpray = Spray::model()->findByPk($id);
		if ($modelSpray === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'Spray'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelSpray;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Spray $modelSpray the model to be validated
	 */
	protected function performAjaxValidation($modelSpray)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'spray-form') {
			echo CActiveForm::validate($modelSpray);
			Yii::app()->end();
		}
	}
}