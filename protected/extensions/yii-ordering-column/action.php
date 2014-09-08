<?php

/**
 * OrderingAction
 *
 * @author Tom Doan
 * @copyright Nr Aziz
 */
class Action extends CAction {

    public $modelClass;
    public $pkName;

    public function run($pk, $name, $value, $move) {

        $model = CActiveRecord::model($this->modelClass)->findByPk($pk);
        $table = $model->tableName();
        
        if ($move === 'up' && $model->{$name} != 0)
        	$change = -1;
        else if ($move === 'down')
        	$change = 1;
        
        $sql = "SELECT * FROM $table ORDER BY $this->pkName";
        $order = Yii::app()->db->createCommand($sql)->queryAll();
        $arr_ordering = array();
        
        if (is_array($order)) {
        	foreach ($order AS $key => $k)
        	{
        		$arr_ordering[($key+1)] = $k['id'];
        	}
        	foreach ($arr_ordering as $key => $item) {
        		if ($item == $pk) {
        			$num_order = $key + $change;
        			if (isset($arr_ordering[$num_order])) {
        				$num_tmp = $arr_ordering[$num_order];
        				$arr_ordering[$num_order] = $arr_ordering[$key];
        				$arr_ordering[$key] = $num_tmp;
        				break;
        			}
        		}
        	}
        	foreach ($arr_ordering as $key => $item) {
        		$entry = $model->findByPk($item);
        		$entry->{$name} = $key;
        		$entry->update();
        	}
        }
		
    }

}

?>
