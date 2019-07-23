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
    static function dateOutput($date){
    	if(empty($date) || $date == '0000-00-00'){
    		return;
    	}
    	$time = strtotime($date);
    	return date('d-M-Y',$time);
    }
    
    static function dateOutputCurrentSeason($date, $year = ''){
    	if(empty($date) || $date == '0000-00-00'){
    		return null;
    	}
        
        /* From August to July */
        if (empty($year))
            $year = date('Y');
	    $start_t = strtotime($year.'-08-01 00:00:00');
	    $end_t = strtotime(($year+1).'-07-31 23:59:59');
        
    	$time = strtotime($date);
        if ($start_t <= $time && $time <= $end_t)
    	   return date('d-M-Y',$time);
        return null;
    }
}

function darken_color($rgb, $darker=2) {

    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;
}