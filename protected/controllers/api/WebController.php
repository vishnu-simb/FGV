<?php

class WebController extends SimbApiController {

	public function actionBlock()
	{
		
		$data =  Block::model()->with(array('property'=>array('condition'=>'property.grower_id='.$_POST['grower_id'])))->findAll();
		$data=CHtml::listData($data,'id','name');
		foreach($data as $value=>$block)  {
			echo CHtml::tag
			('option', array('value'=>$value),CHtml::encode($block),true);
		}
	
	}
  
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
    	if ($error = Yii::app()->errorHandler->error) {
    		if (Yii::app()->request->isAjaxRequest)
    			echo $error['message'];
    		else
    			$this->renderPartial('error', $error);
    	}
    }

}