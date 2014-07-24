<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/1/14
 * Time: 1:32 PM
 *
 * Helpers class for handling string
 */
class StringHelper
{
    public static function sanitize($str = '', $delimiter = '-')
    {
        // Use dash '-' for replacing character
        $str = strip_tags($str);
        $str = str_replace(array('(', ')'), '-', $str);
        $str = preg_replace('/[\r\n\t ]+/', '-', $str);
        $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '-', $str);
        $str = strtolower($str);
        $str = self::sanitizeByLanguages($str, '-');
        $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
        $str = str_replace(array('"', "'", '&', '<', '>'), '-', $str);
        $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
        $str = rawurlencode($str);
        //$str = str_replace('%', '-', $str);

        // Remove duplicated characters
        while (strpos($str, '--') !== false) {
            $str = str_replace('--', '-', $str);
        }
        $str = str_replace('-', ' ', $str);
        $str = trim($str);

        $str = str_replace(' ', $delimiter, $str);

        return $str;
    }

    /**
     * Sanitize string by languages
     * @param $str
     * @param string $replacement
     * @return mixed
     */
    public static function sanitizeByLanguages($str, $replacement = '-')
    {
        $map = array();
        $quotedReplacement = preg_quote($replacement, '/');

        $default = array(
            '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
            '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
            '/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
            '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
            '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
            '/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/'	=> 'y',
            '/đ|Đ/' => 'd',
            '/ç/' => 'c',
            '/ñ/' => 'n',
            '/ä|æ/' => 'ae',
            '/ö/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/ß/' => 'ss',
            //sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );

        $map = array_merge($map, $default);

        $result = preg_replace(array_keys($map), array_values($map), $str);

        return $result;
    }
} 