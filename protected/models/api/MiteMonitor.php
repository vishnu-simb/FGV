<?php

Yii::import('application.models._common.CommonMiteMonitor');

class MiteMonitor extends CommonMiteMonitor
{
	
	public $block_id;
	public $date;
	
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	public function getMiteRange(){
		$data = array();
		$data['date_initial'] = strtotime($this->date .'-30');
		$data['date_start'] = strtotime(date('Y').'-07-01');
		if(date('m',$data['date_start']) >= date('m',$data['date_initial'])){
			$data['date_start'] = strtotime('-1 year',$data['date_start']);
		}
		$data['date_start'] = date('Y-m-d',$data['date_start']);
		$data['date_initial'] = date('Y-m-d',$data['date_initial']);
		return $data;
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
		if(!empty($this->date)){
			$data = $this->getMiteRange();
			$condition .= ' AND (mm.date BETWEEN "'.$data['date_start'].'" AND "'. $data['date_initial'].'")';
		}
		$sql="SELECT mm.date AS mm_date,mm.no_days AS mm_no_days,mm.percent_li ,mm.average_li ,m.name AS mite_name ,
			((SELECT pr.percent_li FROM ".$this->tableName()." pr WHERE pr.date < mm.date AND pr.mite_id = mm.mite_id AND pr.block_id = mm.block_id ORDER BY DATE DESC LIMIT 1) + mm.percent_li)/2 AS mm_average_li
		FROM ".$this->tableName()." mm
		INNER JOIN ".Mite::model()->tableName()." m ON mm.mite_id = m.id
		INNER JOIN ".Block::model()->tableName()." b ON mm.block_id = b.id
		".$condition."
		ORDER BY mm.date DESC";
		return new CSqlDataProvider($sql, array(
				'pagination'=>false,
		));
	
	}
}