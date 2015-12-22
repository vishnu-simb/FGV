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
                	array('label' => Yii::t('app', 'Trapping'), 'url' => Yii::app()->baseUrl.'/trapping'),
                	array('label' => Yii::t('app', 'Spraying'), 'url' => Yii::app()->baseUrl.'/spraying'),
                	array('label' => Yii::t('app', 'Mite Monitoring'), 'url' => Yii::app()->baseUrl.'/monitoring'),
                    array(
                    	'visible' => Yii::app()->user->getState('role') == Users::USER_TYPE_ADMIN,
                        'label' => Yii::t('app', 'Administration'),
                        'itemOptions' => array(),
                        'items' => array(
                            array(
                                'label' => Yii::t('app', 'Users'),
                                'url' => Yii::app()->baseUrl.'/backend/users',
                            ),
                        		
                            array(
                                'label' => Yii::t('app', 'Biofix'),
                                'url' => Yii::app()->baseUrl.'/backend/biofix',
                            ),
							array(
									'label' => Yii::t('app', 'Block'),
									'url' => Yii::app()->baseUrl.'/backend/block',
							),
							array(
									'label' => Yii::t('app', 'Chemical'),
									'url' => Yii::app()->baseUrl.'/backend/chemical',
							),
							array(
									'label' => Yii::t('app', 'Grower'),
									'url' => Yii::app()->baseUrl.'/backend/grower',
							),
							array(
									'label' => Yii::t('app', 'Location'),
									'url' => Yii::app()->baseUrl.'/backend/location',
							),
							array(
									'label' => Yii::t('app', 'Pest'),
									'url' => Yii::app()->baseUrl.'/backend/pest',
							),
							array(
									'label' => Yii::t('app', 'PestSpray'),
									'url' => Yii::app()->baseUrl.'/backend/pestSpray',
							),
                        	array(
                        			'label' => Yii::t('app', 'Mite'),
                        			'url' => Yii::app()->baseUrl.'/backend/mite',
                        	),
                        		
                        	array(
                        			'label' => Yii::t('app', 'Mite Monitor'),
                        			'url' => Yii::app()->baseUrl.'/backend/monitoring',
                        	),
							array(
									'label' => Yii::t('app', 'Property'),
									'url' => Yii::app()->baseUrl.'/backend/property',
							),
							array(
									'label' => Yii::t('app', 'Sizing'),
									'url' => Yii::app()->baseUrl.'/backend/sizing',
							),
							array(
									'label' => Yii::t('app', 'Spray'),
									'url' => Yii::app()->baseUrl.'/backend/spray',
							),
							array(
									'label' => Yii::t('app', 'Trap'),
									'url' => Yii::app()->baseUrl.'/backend/trap',
							),
							array(
									'label' => Yii::t('app', 'TrapCheck'),
									'url' => Yii::app()->baseUrl.'/backend/trapCheck',
							),
							array(
									'label' => Yii::t('app', 'Variety'),
									'url' => Yii::app()->baseUrl.'/backend/variety',
							),
                            array(
									'label' => Yii::t('app', 'Pests Report by Region'),
									'url' => Yii::app()->baseUrl.'/backend/pestsReport',
							),
						),

                    ),
                    array(
                    	'visible' => Yii::app()->user->getState('role') == Users::USER_TYPE_GROWER,
                        'label' => Yii::t('app', 'Management'),
                        'itemOptions' => array(),
                        'items' => array(
                            array(
									'label' => Yii::t('app', 'Chemical'),
									'url' => Yii::app()->baseUrl.'/chemical',
							),
                            array(
                                'label' => Yii::t('app', 'Biofix'),
                                'url' => Yii::app()->baseUrl.'/biofix',
                            ),
							array(
									'label' => Yii::t('app', 'Location'),
									'url' => Yii::app()->baseUrl.'/location',
							),
							array(
									'label' => Yii::t('app', 'Property'),
									'url' => Yii::app()->baseUrl.'/property',
							),
                            array(
									'label' => Yii::t('app', 'Block'),
									'url' => Yii::app()->baseUrl.'/block',
							),
                            array(
									'label' => Yii::t('app', 'Trap'),
									'url' => Yii::app()->baseUrl.'/trap',
							),
							array(
									'label' => Yii::t('app', 'TrapCheck'),
									'url' => Yii::app()->baseUrl.'/trapCheck',
							),
                            array(
									'label' => Yii::t('app', 'Pests Report by Region'),
									'url' => Yii::app()->baseUrl.'/pestsReport',
							)
						),

                    ),
                    array(
                        'label' => Yii::t('app', 'My Account'), 
                        'url' => Yii::app()->baseUrl.'/myaccount',
                        'visible' => Yii::app()->user->getState('role') == Users::USER_TYPE_GROWER
                    )
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
                        /**array(
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
                        ),*/
                    ),
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class' => 'icon-nav'
                    ),
                )
            );
            ?>

            <div class="dropdown">
                <a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo Yii::app()->user->name ?>
                <?php
                    $avatar_url = $resourceUrl. '/img/demo/user-avatar.jpg';
                    $user = Yii::app()->user->isGrower();
                    if ($user && !empty($user->avatar) && file_exists(Yii::app()->basePath.'/../avatars/'.$user->avatar.'_27x27.jpg'))
                        $avatar_url = '/avatars/'.$user->avatar.'_27x27.jpg';
                ?>
                    <img src="<?php echo $avatar_url ?>" alt=""/>
                </a>
                <?php
                $this->widget(
                    'bootstrap.widgets.TbMenu',
                    array(
                        'items' => array(
							array(
								'visible' => Yii::app()->user->getState('role') == Users::USER_TYPE_ADMIN,
								'label' => 'Edit profile',
								'url' => Yii::app()->baseUrl.'/backend/users/update/'.Yii::app()->user->id,
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