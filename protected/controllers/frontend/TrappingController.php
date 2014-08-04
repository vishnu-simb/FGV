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
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = sprintf(Yii::t('app', 'Trapping %s'), '');
		$modelTrapCheck = new TrapCheck();
		$modelGrowers = new Grower('search');
		$modelTrapCheck->unsetAttributes();  // clear any default values
		if (isset($_GET['TrapCheck'])) {
			$modelTrapCheck->attributes = $_GET['TrapCheck'];
		}
	
		$this->render('index', array(
				'modelTrapCheck' => $modelTrapCheck,
				'dataProvider' => $modelTrapCheck->SearchRecentTrapings(),
				'growers' => $modelGrowers->findAll(),
		));
	}
	
}