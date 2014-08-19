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
    <h2><?= Yii::t('app', 'Forgot Password') ?></h2>

    <?php CHtml::$afterRequiredLabel=':'; ?>

    <?php $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'forgot-form',
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
            <div class="username controls">
                <?php echo $form->textField(
                    $model,
                    'username',
                    array('placeholder' => $model->getAttributeLabel('username'), 'class' => 'input-block-level')
                ) ?>
                <?php echo $form->error($model, 'username') ?>
            </div>
        </div>
        <div class="submit">
            <?php echo CHtml::submitButton(Yii::t('app','Reset Password'),array('class'=>'btn btn-primary')); ?>
        </div>
    <?php $this->endWidget(); ?>

    <div class="forget">
        <a href="login"><span><?= Yii::t('app', 'Back to login ?') ?></span></a>
    </div>
</div>
 