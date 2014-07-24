<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 7/1/14
 * Time: 11:26 AM
 *
 * console command to migrate bwf site to Wp
 */
class BwfMigration2WpCommand extends SimbConsoleCommand
{
    public function actionStartAll($limit=3)
    {
        echo "Start Crawling News and Page Using console for: ".Yii::app()->name."\n\n";
        SimbBWFDbNewsCrawler::startCrawler($limit);
        SimbBWFDbPageCrawler::startCrawler($limit, 0);
    }

    public function actionStartNews($limit=3)
    {
        echo "Start crawling News Using console for: ".Yii::app()->name."\n\n";
        SimbBWFDbNewsCrawler::startCrawler($limit);
    }

    public function actionStartPage($limit=3)
    {
        echo "Start crawling Page Using console for: ".Yii::app()->name."\n\n";
        SimbBWFDbPageCrawler::startCrawler($limit);
    }
}
 