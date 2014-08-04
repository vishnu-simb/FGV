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
		$modelGrower = new Grower();
		$modelGrower->unsetAttributes();  // clear any default values
		$filter = "";
		if (isset($_GET['Grower'])) {
			$modelGrower->attributes = $_GET['Grower'];
			if(isset($_GET['Grower']['name'])){
				// filter by grower name
				$filter = "t.name like '%".$_GET['Grower']['name']."%'";
			}
		}
		$this->render('index', array(
				'modelTrapCheck' => $modelTrapCheck,
				'dataProvider' => $modelTrapCheck->SearchRecentTrapings(),
				'modelGrower' => $modelGrower,
				'filter' => $filter,
		));
	}
	
}