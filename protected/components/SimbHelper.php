<?php
class PestResult {
	public $sprays = array();
	public $pest;
	public $biofix;
	public $secondCohortSprays = array();
	public $secondCohortBiofix;
	public $isLowPop = false;
}

class SprayResult {
	public $sprayDate;
	public $coverUntil;
}

class Number{
	static function Ordinal($number){
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if (($number %100) >= 11 && ($number%100) <= 13)
			$abbreviation = $number. 'th';
		else
			$abbreviation = $number. $ends[$number % 10];
		
		return $abbreviation;
	}
	static function Natural($int, $plurals = false) {
		$readable = array ("", "thousand", "million", "billion" );
		$index = 0;
		while ( $int > 1000 ) {
			$int /= 1000;
			$index ++;
		}
		$s = '';
		$num = round ( $int, 0 );
		if ($num != 1 && $plurals) {
			$s = 's';
		}
		return ($num . " " . $readable [$index]);
	}
	static function is($number){
		if(is_int($number)){
			return true;
		}
		if(is_numeric($number) && (int)$number == $number){
			return true;
		}
		return false;
	}
}

class DateHelper
{    
    /**
     * Output date in d-M-Y format
     * @param string $date
     * @return string
     */
    function dateOutput($date){
    	if(empty($date) || $date == '0000-00-00'){
    		return;
    	}
    	$time = strtotime($date);
    	return date('d-M-Y',$time);
    }
} 