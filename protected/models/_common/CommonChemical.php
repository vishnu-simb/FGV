<?php

Yii::import('application.models._base.BaseChemical');

class CommonChemical extends BaseChemical
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    function perKG(){
		return $this->pack_price/$this->pack_qty;
	}

	/**
	 * @return the $cost
	 */
	public function getCost() {
		return $this->perKG()/1000 * (($this->dilution_rate*$this->application_rate)/100);
	}
	
	function calculateCost($ha){
		return $this->cost * $ha;
	}
}