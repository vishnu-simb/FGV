<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/25/14
 * Time: 5:38 PM
 *
 * Main navigation of the layout
 */

$clientScript = Yii::app()->clientScript;
$resourceUrl = $clientScript->staticUrl . '/flatapp';
?>
<div id="navigation">
    <div class="container-fluid">
        <a href="<?php echo Yii::app()->getHomeUrl() ?>" id="brand"><?php echo Yii::app()->name ?></a>
        <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom"
           title="<?= Yii::t('app', 'Toggle navigation') ?>">
            <i class="icon-reorder"></i>
        </a>
        <?php
        $this->widget(
            'bootstrap.widgets.TbMenu',
            array(
                'items' => array(
                    array('label' => Yii::t('app', 'Dashboard'), 'url' => Yii::app()->getHomeUrl()),
                    array(
                        'label' => Yii::t('app', 'Site Content'),
                        'itemOptions' => array(),
                        'items' => array(
                            array(
                                'label' => Yii::t('app', 'Syndicated Blogs Management'),
                                'items' => array(
                                    array(
                                        'label' => Yii::t('app', 'List All Syndicated Blogs'),
                                        'url' => array('syndicatedBlog/index')
                                    ),
                                    array(
                                        'label' => Yii::t('app', 'Add New Syndicated Blog'),
                                        'url' => array('syndicatedBlog/create')
                                    ),
                                ),
                            ),
                        ),

                    ),
                ),
                'encodeLabel' => false,
                'htmlOptions' => array(
                    'class' => 'main-nav'
                ),
            )
        );
        ?>

        <div class="user">
            <?php
            $this->widget(
                'bootstrap.widgets.TbMenu',
                array(
                    'items' => array(
                        array(
                            'label' => '<i class="icon-envelope"></i><span class="label label-lightred">4</span>',
                            'submenuOptions' => array('class' => 'pull-right message-ul'),
                            'itemOptions' => array('class' => 'no-caret', 'data-toggle' => 'dropdown'),
                            'items' => array(
                                array(
                                    'label' => '<img src="' . $resourceUrl . '/img/demo/user-1.jpg" alt="">

                                <div class="details">
                                    <div class="name">Jane Doe</div>
                                    <div class="message">
                                        Lorem ipsum Commodo quis nisi ...
                                    </div>
                                </div>',
                                    'url' => '#'
                                ),
                                array(
                                    'label' => '<img src="' . $resourceUrl . '/img/demo/user-2.jpg" alt="">

                                <div class="details">
                                    <div class="name">Jane Doe</div>
                                    <div class="message">
                                        Lorem ipsum Commodo quis nisi ...
                                    </div>
                                </div>',
                                    'url' => '#'
                                ),
                                array(
                                    'label' => 'Go to Message center <i
                                    class="icon-arrow-right"></i>',
                                    'url' => '#'
                                ),
                            )
                        ),
                        array(
                            'label' => '<img src="' . $resourceUrl . '/img/demo/flags/us.gif" alt=""><span>US</span>',
                            'submenuOptions' => array('class' => 'pull-right'),
                            'itemOptions' => array(
                                'class' => 'dropdown language-select no-caret',
                                'data-toggle' => 'dropdown'
                            ),
                            'items' => array(
                                array(
                                    'label' => '<img src="' . $resourceUrl . '/img/demo/flags/us.gif" alt=""><span>US</span>',
                                    'url' => '#'
                                ),
                            ),
                        ),
                    ),
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class' => 'icon-nav'
                    ),
                )
            );
            ?>

            <div class="dropdown">
                <a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo Yii::app()->user->name ?> <img
                        src="<?php echo $resourceUrl ?>/img/demo/user-avatar.jpg" alt=""></a>
                <?php
                $this->widget(
                    'bootstrap.widgets.TbMenu',
                    array(
                        'items' => array(
                            array(
                                'label' => 'Edit profile',
                                'url' => '#',
                            ),
                            array(
                                'label' => Yii::t('app', 'Log out'),
                                'url' => array('site/logout'),
                            ),

                        ),
                        'encodeLabel' => false,
                        'htmlOptions' => array(
                            'class' => 'dropdown-menu pull-right'
                        ),
                    )
                );
                ?>

            </div>
        </div>
    </div>
</div>