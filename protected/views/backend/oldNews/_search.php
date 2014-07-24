<?php
/* @var $this OldNewsController */
/* @var $modelOldNews OldNews */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>        <?php
    echo $form->dropDownList($modelOldNews, 'rowsPerPage', $modelOldNews->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
    ?>    </div>

<div class="search-form-ext" style="display:none">


    <div class="box-content nopadding">
        <div class="span4">
            <?php echo $form->textFieldControlGroup($modelOldNews, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('id'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'clubid', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('clubid'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'newscategoryid', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('newscategoryid'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'lcid', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('lcid'))); ?>
        </div>

        <div class="span4">
            <?php echo $form->textFieldControlGroup($modelOldNews, 'title', array('maxlength' => 200, 'class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('title'))); ?>

            <?php echo $form->textAreaControlGroup($modelOldNews, 'abstract', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelOldNews->getAttributeLabel('abstract'))); ?>

            <?php echo $form->textAreaControlGroup($modelOldNews, 'body', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelOldNews->getAttributeLabel('body'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'copyright', array('maxlength' => 250, 'class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('copyright'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'created', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('created'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'inlinephotoid', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('inlinephotoid'))); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldControlGroup($modelOldNews, 'memberid', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('memberid'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'published', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('published'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'deleted', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('deleted'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'lastupdated', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('lastupdated'))); ?>

            <?php echo $form->textFieldControlGroup($modelOldNews, 'migration_done', array('class' => 'input-xlarge', 'placeholder' => $modelOldNews->getAttributeLabel('migration_done'))); ?>
        </div>











    </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
