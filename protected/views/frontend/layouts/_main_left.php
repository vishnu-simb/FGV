<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/25/14
 * Time: 5:29 PM
 *
 * Left panel of the layout
 */
?>
<div id="left">
    <?php echo $this->renderPartial('//layouts/_main_search_form') ?>



    <div class="subnav">
        <div class="subnav-title">
            <a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span><?= Yii::t('app', 'Operations') ?></span></a>
        </div>
        <?php

        $this->widget(
            'zii.widgets.CMenu',
            array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'subnav-menu'),
                'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
            )
        );

        ?>
    </div>

</div>
 