<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 2:19 PM
 */
class SiteController extends SimbControllerFrontend
{
    public function actionIndex()
    {
        $this->render("index");
    }
}