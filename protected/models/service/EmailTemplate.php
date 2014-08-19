<?php
/**
 * Copyright by Tom.
 * Date: 8/19/14
 * Time: 9:26 PM
 *
 * 1.	A class for our email template. For example Send Activation Email Templates, New Register Email Templates.
 * 2.	This class get the template for a text file from protected/data/email-template
 */
class EmailTemplate
{

    const RESETPASSCODE='resetpasscode.txt';

    public static function resourcePath(){
    	return dirname(__FILE__).'/../../data/email-template';
    }
    
    public static function getContents($filename){
    	return file_get_contents(self::resourcePath().'/'.$filename);
    }
    
    /**
     * Send reset password code email template
     * @static
     * @param array $params
     * @return string
     */
    public static function resetPassCode($params=array()){
        $template = self::getContents(self::RESETPASSCODE);
        return strtr($template,$params);
    }

}
