<?php

Yii::import('application.models._common.CommonMonitorCheck');

class MonitorCheck extends CommonMonitorCheck
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
	
		$condition = !empty($this->block_id) ? 'WHERE mm.block_id ='. $this->block_id : ' ';
		$condition .= !empty($this->date) ? ' AND (mc.date BETWEEN "'. $this->date .'-01" AND "'. $this->date.'-30")' : '';
		$sql="SELECT mc.date AS mc_date,mc.percentage as mc_percentage,mc.average_number as mc_average_number,m.name AS mite_name
		FROM ".$this->tableName()." mc
		INNER JOIN ".MiteMonitor::model()->tableName()." mm ON mc.monitor_id = mm.id
		INNER JOIN ".Mite::model()->tableName()." m ON mm.mite_id = m.id
		INNER JOIN ".Block::model()->tableName()." b ON mm.block_id = b.id
		".$condition."
		ORDER BY mc.date DESC";
		return new CSqlDataProvider($sql, array(
				'pagination'=>false,
		));
	
	}
}