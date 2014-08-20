<?php

class MyaccountController extends SimbController
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
	 * Manages all models.
	 */
	public function actionIndex()
	{
	    $user_id = Yii::app()->user->id;
	    $modelGrower = $this->loadModel($user_id);
		$this->pageTitle = sprintf(Yii::t('app', '%s'), 'My Account');
		if (isset($_POST['Grower'])) {
            $modelGrower->attributes = $_POST['Grower'];
            $uploadedFile = CUploadedFile::getInstance($modelGrower, 'avatar');
            
            $filename = '';
            if (!empty($uploadedFile)) // check if uploaded file is set or not
            {
                $filename = $user_id. '.'. $uploadedFile->getExtensionName();
                $modelGrower->avatar = $filename;
            }
            
            if($modelGrower->save())
            {
                $avatars_path = Yii::app()->basePath.'/../avatars/';
                if($filename)
                {
                    if (!file_exists($avatars_path))
                    {
                        mkdir($avatars_path);
                        chmod($avatars_path, 777);
                    }
                    $full_path = $avatars_path.$filename;
                    if (file_exists($full_path))
                    {
                        @unlink($full_path);
                        @unlink($full_path.'_27x27.jpg');
                    }
                    $uploadedFile->saveAs($full_path);
                    chmod($full_path, 777);
                    Yii::app()->image->create_square_thumbnail($full_path, $full_path.'_27x27.jpg', 27);
                }
            }
		}
		$this->render('index', array(
				'modelGrower' => $modelGrower
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grower the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$modelGrower = Grower::model()->findByPk($id);
		if ($modelGrower === null) {
            $errorText = YII_DEBUG ? sprintf(
                Yii::t('app', 'The ID %s does not exist in %s.'),
                $id,
                'My Account'
            ) : Yii::t('app', 'The requested page does not exist.');
			throw new CHttpException(404, $errorText);
		}
		return $modelGrower;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Grower $modelGrower the model to be validated
	 */
	protected function performAjaxValidation($modelGrower)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'grower-form') {
			echo CActiveForm::validate($modelGrower);
			Yii::app()->end();
		}
	}
}