<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 5:37 PM
 *
 * a test file contain testing actions
 */
class TestCommand extends SimbConsoleCommand
{
    public function actionIndex($type, $limit = 5)
    {
        echo "index result: \n";
        echo "type: $type \n";
        echo "limit: $limit \n";
    }

    public function actionInit()
    {
        echo "index result: \n";
        echo "sdaf: \n";
    }
    
    public function run($args)
    {    
        $this->msg("Running Test command");
        
        $pest_id = 3;
        $block_id = 220;
        $date = "2014-08-29";
        
        $format = Yii::app()->params['dbDateFormat'];
        $postData = Yii::app()->request->getPost('Biofix');
        $pestSpray = PestSpray::model()->findAllByAttributes(array('pest_id'=>$pest_id));
        $block = Block::model()->findByAttributes(array('id'=>$block_id));
        $spraydates = array();        
        
        $this->msg("Loaded pests and blocks");
        
        foreach($pestSpray as $key=>$vv){
            $this->msg("Processing Pest Spray: " . $vv->id);    
            $spraydates[$vv->id]= $vv->getDate($block, false, date('Y',strtotime($date)),true);
        }
        
        print_r($spraydates);
        
    }
    
    public function msg($m)
    {
        echo $m . "\n";
    }
}