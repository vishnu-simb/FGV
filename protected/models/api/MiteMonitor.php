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
		$condition .= !empty($this->date) ? ' AND (mm.date BETWEEN "'. $this->date .'-01" AND "'. $this->date.'-30")' : '';
		$sql="SELECT mm.date AS mm_date,mm.percent_li ,mm.average_li ,m.name AS mite_name ,
				(SELECT CONCAT(pr.average_li * pr.no_days) FROM ".$this->tableName()." pr WHERE pr.date < mm.date AND pr.mite_id = mm.mite_id AND pr.block_id = mm.block_id ORDER BY DATE DESC LIMIT 1) AS prev_averge_percent,
				CONCAT(mm.no_days * mm.average_li) AS average_percent
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