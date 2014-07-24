<?php
/* @var $this OldPageController */
/* @var $modelOldPage OldPage */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelOldPage, 'rowsPerPage', $modelOldPage->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelOldPage, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'clubid', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('clubid'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'pagegroupid', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('pagegroupid'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'title', array('maxlength' => 80, 'class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('title'))); ?>

            </div>
        <div class="span4">            <?php echo $form->textAreaControlGroup($modelOldPage, 'content', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelOldPage->getAttributeLabel('content'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'membersonly', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('membersonly'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'deleted', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('deleted'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'lastupdated', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('lastupdated'))); ?>

            </div>
        <div class="span4">            <?php echo $form->textFieldControlGroup($modelOldPage, 'created', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('created'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'memberid', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('memberid'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelOldPage, 'migration_done', array('class' => 'input-xlarge', 'placeholder' => $modelOldPage->getAttributeLabel('migration_done'))); ?>

            </div>
    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
