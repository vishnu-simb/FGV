<?php

/**
 * Author: Andrew Chapman
 * Date: 26/09/2014
 * Time: 12:55 PM
 *
 */
class UpdateBiofixCommand extends SimbConsoleCommand
{
    public function run($args)
    {    
        $this->msg("Getting all biofix entries that have dates greater than or equal to 180 days ago");
        
        $threshold = date("Y-m-d", time() - (86400 * 180));
        
        $rstBioFix = Biofix::model()->findAll(array(
            'condition'=>'date >= :date',
            'params'=>array(':date'=>$threshold),
        )); 
        
        foreach($rstBioFix as $objBiofix) {
            $pest_id = $objBiofix->pest_id;
            $block_id = $objBiofix->block_id;
            $date = $objBiofix->date;      
            $this->msg("Processing Biofix id: " . $objBiofix->id . ", Pest ID: " . $pest_id. ", Block: " . $block_id . ", Date: " . $date);      
            $format = Yii::app()->params['dbDateFormat'];
            $pestSpray = PestSpray::model()->findAllByAttributes(array('pest_id'=>$pest_id));
            $block = Block::model()->findByAttributes(array('id'=>$block_id));
            $spraydates = array();        
            
            $this->msg("Loaded pests and blocks");
            
            foreach($pestSpray as $key=>$vv){
                $spraydates[$vv->id]= $vv->getDate($block, ($objBiofix->second_cohort=='yes')?true:false, $date,true);
            }
            $this->msg("Processing Biofix : " . $objBiofix->id);
            print_r(CJSON::encode($spraydates));
            $objBiofix->params = CJSON::encode($spraydates);
            $objBiofix->save();
        }       
    }
    
    public function msg($m)
    {
        echo $m . "\n";
    }
}