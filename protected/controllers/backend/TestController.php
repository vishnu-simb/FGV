<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/1/14
 * Time: 1:54 PM
 *
 * Test actions for the backend
 */
class TestController extends SimbController
{
    public function actionBlogMigration()
    {
        $newlineStr = "<br />";
        echo "Start Using console for: " . Yii::app()->name . "$newlineStr$newlineStr";
        SimbBWFDbNewsCrawler::startCrawler(1, true);
        SimbBWFDbPageCrawler::startCrawler(1, true);

    }

    public function actionFileExtension()
    {
        $newlineStr = "<br />";
        echo "File extension: " . Yii::app()->name . "$newlineStr$newlineStr";
        require_once Yii::app()->basePath . '/helpers/FileHelper.php';
        $filepath = 'D:\projects\ron\bwf\cms\wp-content\uploads\2014\07\file_download.aspx-id-3D18809';
        $result = FileHelper::fillExtension($filepath);
        $url = 'http://www.bwfbadminton.org/file_download.aspx?id=18809';
        //$url = 'http://riverorchiddigital.com/staging/bwf/cms/wp-content/uploads/2014/07/file_download.aspx-id-3D16000.xlsx';
        /*
        try {
            $image = @file_get_contents('http://www.bwfbadminton.org/file_download.aspx?id=18809');

        } catch (Exception $e) {
            $image = null;
        }
        */
        /** Include PHPExcel_IOFactory */
        /*
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        require_once Yii::app()->basePath . '/vendors/PHPExcel/PHPExcel.php';
        spl_autoload_register(array('YiiBase', 'autoload'));


        $objPHPExcel = PHPExcel_IOFactory::load($filepath);
        $filetype = PHPExcel_IOFactory::identify($filepath);
        */

        function get_contents($url) {
            file_get_contents($url);
            var_dump($http_response_header);
        }
        $http_response_header = get_headers ($url);

        echo '<pre> result: ';
        print_r($http_response_header);
        echo '</pre>';


    }
}