<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/19/14
 * Time: 11:40 AM
 *
 * login view file
 */
/* @var $this SimbController */
/* @var $clientScript CClientScript */
/* @var $bootstrap TbApi */
/* @var $model FormUserLogin */
/* @var $form TbActiveForm */
$themeUrl = is_object(Yii::app()->theme) ? Yii::app()->theme->baseUrl : '';
$clientScript = Yii::app()->clientScript;
$bootstrap = Yii::app()->bootstrap;
?>
<!--  <h1><a href="index.html"><img src="<?= $themeUrl ?>/img/logo_bwf.jpg" alt="Main Logo" class='retina-ready' width="179" height="55"> BWF </a>
</h1>-->

<div class="login-body">
    <h2><?= Yii::t('app', 'LOG IN') ?></h2>

    <?php CHtml::$afterRequiredLabel=':'; ?>

    <?php $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'login-form',
            'focus' => array($model, 'username'),

            // for enabling client validation
            'enableClientValidation' => true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),

            'htmlOptions' => array(
                'class' => 'form-validate',
            ),
        )
    ); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="control-group">
            <div class="email controls">
                <?php echo $form->textField(
                    $model,
                    'username',
                    array('placeholder' => $model->getAttributeLabel('username'), 'class' => 'input-block-level')
                ) ?>
                <?php echo $form->error($model, 'username') ?>
            </div>
        </div>

        <div class="control-group">
            <div class="pw controls">
                <?php echo $form->passwordField(
                    $model,
                    'password',
                    array(
                        'placeholder' => $model->getAttributeLabel('password'),
                        'class' => 'input-block-level',
                        'value' => ''
                    )
                ) ?>
                <?php echo $form->error($model, 'password') ?>
            </div>
        </div>
        <div class="submit">
            <?php echo CHtml::submitButton(Yii::t('app','Login'),array('class'=>'btn btn-primary')); ?>
        </div>
    <?php $this->endWidget(); ?>

    <div class="forget">
        <a href="/site/forgot"><span><?= Yii::t('app', 'Forgot Password?') ?></span></a>
    </div>
</div>
 