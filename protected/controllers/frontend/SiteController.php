<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 2:19 PM
 */
class SiteController extends SimbControllerFrontend
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
	
	public function actionIndex()
    {
    	$this->pageTitle = sprintf(Yii::t('app', 'Dashboard'), '');
    	$modelGrower = new Grower();
    	$modelBlock = new Block();
    	$modelGrower->unsetAttributes();  // clear any default values
    	$modelBlock->unsetAttributes(); 
        $this->render("index",array(
        		'modelGrower' => $modelGrower,
        		'modelBlock' => $modelBlock,
        		));
    }
    
    /**
     * Login into the system
     */
    public function actionLogin()
    {
    	$this->layout = 'login';
    	$this->pageTitle = Yii::t('app', 'Login');
    
    	if (!Yii::app()->user->isGuest) {
    		$this->redirect(Yii::app()->homeUrl);
    	}
    
    	$model = new FormUserLogin();
    	// collect user input data
    	/* @var $model FormUserLogin */
    	if (isset($_POST['FormUserLogin'])) {
    		$model->attributes = $_POST['FormUserLogin'];
    		// validate user input and redirect to previous page if valid
    		if ($model->validate()) {
    			// reinit session to store flash
    			Yii::app()->session->open();
    			Yii::app()->user->setFlash('success', Yii::t('app', 'Log in successfully!'));
    			$this->redirect((Yii::app()->user->returnUrl ? Yii::app()->user->returnUrl : array('site/index')));
    		}
    	}
    
    	$this->render(
    			'login',
    			array(
    					'model' => $model,
    			)
    	);
    }
    
    
    /**
     * Password reset
     */
    public function actionForgot()
    {
    	$this->layout = 'login';
    	$this->pageTitle = Yii::t('app', 'Forgot Password');
    
    	if (!Yii::app()->user->isGuest) {
    		$this->redirect(Yii::app()->homeUrl);
    	}
    
    	$model = new FormUserForgot();
    	// collect user input data
    	/* @var $model FormUserForgot */
    	if (isset($_POST['FormUserForgot'])) {
    		$model->attributes = $_POST['FormUserForgot'];
    		// validate user input and redirect to previous page if valid
    		if ($model->validate()) {
    			if($model->sendPasswordCode()){
    				// reinit session to store flash
    				Yii::app()->session->open();
    				Yii::app()->user->setFlash('success', Yii::t('app', 'Password reset in successfully!'));
    				$this->redirect((Yii::app()->user->returnUrl ? Yii::app()->user->returnUrl : array('site/forgot')));
    			}
    		}
    	}
    
    	$this->render(
    			'forgot',
    			array(
    					'model' => $model,
    			)
    	);
    }
    
    
    /**
     * reset password with 3 different scenario
     * case 1 enter username
     * case 2 enter code got from email
     * case 3 enter a new password based on code
     */
    public function actionResetpassword(){
    	
    	$this->layout = 'login';
    	$this->pageTitle = Yii::t('app', 'Reset Password');
    	
    	if (!Yii::app()->user->isGuest) {
    		$this->redirect(Yii::app()->homeUrl);
    	}
    	
    	if (isset($_GET['is_code'])){
    		if (isset($_GET['is_code'])){
    			$model = new UserPasswordReset();
    			$model->code = isset($_GET['code']) ? $_GET['code'] : null;
    		}
    	}
    
    	if (isset($_POST['UserPasswordReset'])){
    		$model->attributes = $_POST['UserPasswordReset'];
    		if ($model->validate()){
    			$model->changePassword();
    			$this->redirect(Yii::app()->user->loginUrl);
    		}
    	}
    	
    	$this->render('resetpassword',array(
    					'model' => $model,
    	));
     }
    
    /**
     * Logout the backend, redirect to login page
     */
    public function actionLogout()
    {
    	// force to logout
    	Yii::app()->user->logout();
    
    	// reinit session to store flash
    	Yii::app()->session->open();
    	Yii::app()->user->setFlash('success', Yii::t('app', 'You were logged out successfully!'));
    
    	$this->redirect(Yii::app()->user->loginUrl);
    }
}