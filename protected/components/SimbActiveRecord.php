<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 5:09 PM
 *
 * common ActiveRecord for all
 */
class SimbActiveRecord extends GxActiveRecord
{
    /* @property array $rowsPerPageData */
    public $rowsPerPageData = array('10' => 10, '20' => 20, '50' => 50, '100' => 100);

    /* @property string $rowsPerPage */
    public $rowsPerPage = 20; // show this number of rows in listing screen

    /**
     * @return string, error string to put to log file
     */
    public function getErrorString()
    {
        $strError = '';
        foreach ($this->getErrors() as $key => $value) {
            $strError = "\n".$key . ': ' . implode(', ', $value);
        }
        return $strError ? $strError : "";
    }
}
 