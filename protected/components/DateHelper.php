<?php

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
} 