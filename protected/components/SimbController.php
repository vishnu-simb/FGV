<?php

/**
 * User: trac.nguyen
 * Date: 6/18/14
 * Time: 2:22 PM
 *
 * Common Controller file
 */
class SimbController extends CController
{
    public $breadcrumbs = array();
    public $menu = array();

    /**
     * @var string the default layout for the views. Defaults to '//layouts/main'.
     * See 'protected/views/layouts/main.php'.
     */
    public $layout = '//layouts/main';

    /**
     * Title to be displayed for the browser
     * @return string
     */
    public function getBrowserTitle()
    {
        return $this->pageTitle . ' :: ' . Yii::app()->name;
    }

    /**
     * Css Class for body of web application due to caontroller, action using
     * @param string $suffix
     * @return string
     */
    public function getBodyClass($suffix = '')
    {
        $strResult = '';
        $strResult .= 'lang-' . Yii::app()->language;
        $strResult .= $strResult ? ' ' : '';
        $strResult .= 'c' . $this->id . '-' . 'a' . $this->action->id;
        return $suffix ? $strResult . ' ' . $suffix : $strResult;
    }

    /**
     * Actions to do in case login required
     */
    public function redirectLoginNeeded()
    {
        Yii::app()->user->setFlash('info', Yii::t('app', 'You need to login to perform this action!'));
        $this->redirect(Yii::app()->user->loginUrl);
    }
}