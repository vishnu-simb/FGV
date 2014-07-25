<?php
/* @var $this UserController */
/* @var $modelUser User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelUser, 'rowsPerPage', $modelUser->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelUser, 'id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'username', array('maxlength' => 32, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('username'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'email', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('email'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'display_name', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('display_name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'slug', array('maxlength' => 255, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('slug'))); ?>

            </div>
                    <div class="span4">                        <?php echo $form->textFieldControlGroup($modelUser, 'salt', array('maxlength' => 8, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('salt'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'is_super_admin', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('is_super_admin'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('ordering'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelUser, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('created_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('updated_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUser, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelUser->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelUser, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelUser->getAttributeLabel('params'))); ?>

            </div>
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
