<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 5:25 PM
 *
 * Common controller for backend actions
 */
class SimbControllerBackend extends SimbController
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow authenticated user to perform actions
                'users' => array('@'),
            ),
            array(
                'deny', // deny all anonymous to use
                'users' => array('*'),
                'deniedCallback' => array($this, 'redirectLoginNeeded'),
            ),
        );
    }
} 