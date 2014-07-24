<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 2:47 PM
 *
 * controller for common actions
 */
class SiteController extends SimbController
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
        $this->pageTitle = Yii::t('app', 'Admin Dashboard');
        $this->render(
            'index',
            array()
        );
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