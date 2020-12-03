<?php

Yii::import('application.models._common.CommonCropMonitor');

class CropMonitor extends CommonCropMonitor
{
	
	public $block_id;
	public $date;
	
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	public function rules()
	{
		return array(
				array('block_id,date','safe','on'=>'search')
		);
	}
	
	/**
	 * @static
	 * @return CActiveDataProvider
	 */
	public function getSqlDataProvider(){
	    $filter = array(
                    'block_id' => $this->block_id,
                    'date_from' => $this->date .'-01',
                    'date_to' => date('Y-m-t',strtotime($this->date))
                    );
		return $this->getCropMonitorInRange($filter);
	}
}