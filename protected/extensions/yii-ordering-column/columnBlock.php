<?php

class ColumnBlock extends TbDataColumn {

    public $ajaxUrl;
    public $pk;
    public $cssClass = 'order_link';
    public $name;
    private $_upIcon;
    private $_downIcon;
    private $last_ordering;
    
    public function init() {
        $assetsDir = dirname(__FILE__) . "/assets";
        $gridId = $this->grid->getId();
        $this->ajaxUrl = array(Yii::app()->controller->id . "/order");


        $this->_upIcon = Yii::app()->assetManager->publish($assetsDir . "/up.gif");
        $this->_downIcon = Yii::app()->assetManager->publish($assetsDir . "/down.gif");

        Yii::app()->clientScript->registerCoreScript('jquery');

        $script = <<<SCRIPT
            $(document).ready(function() {
                $('.{$this->cssClass}').live('click', function(e) {
                    var link    = $(this).attr('link-data');
                    $.ajax({
                        cache: false,
                        dataType: 'json',
                        type: 'get',
                        url: link,
                        success: function(data) {
                            \$.fn.yiiGridView.update('$gridId');
                        }

                    });
                    return false;
                });

            });
SCRIPT;

        Yii::app()->clientScript->registerScript(__CLASS__ . "#{$this->cssClass}", $script, CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish($assetsDir . "/orderColumn.css"));
    }

    public function renderDataCellContent($row,$data) {
        $value = CHtml::value($data, $this->name);
        $this->ajaxUrl['pk'] = $data['id'];
        $this->ajaxUrl['name'] = $this->name;
        $this->ajaxUrl['value'] = $value;
        $this->ajaxUrl['move'] = 'up';
        $this->ajaxUrl['block'] = $data['block_id'];
        $this->last_ordering = count($this->grid->dataProvider->getData());
        $up = CHtml::link(CHtml::image($this->_upIcon),'#', array('class' => $this->cssClass,'link-data'=>CHtml::normalizeUrl($this->ajaxUrl)));

        $this->ajaxUrl['move'] = 'down';
        $down = CHtml::link(CHtml::image($this->_downIcon),'#', array('class' => $this->cssClass,'link-data'=>CHtml::normalizeUrl($this->ajaxUrl)));
        if($value > 1){
       		 echo CHtml::tag('span', array(
            	'style' => 'margin-bottom:3px',
             ), $up);
		}
		if($data['ordering'] < $this->last_ordering)
        echo CHtml::tag('span', array(
            	'style' => 'float: left;',
        ), $down);
    }

}

?>