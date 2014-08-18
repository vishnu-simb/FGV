<?php
/* @var $this UsersController */
/* @var $modelUsers Users */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelUsers, 'rowsPerPage', $modelUsers->rowsPerPageData, array('class'=> 'posts-per-page', 'onchange' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">   
                    						<!-- Hide ID 
                    						<?php echo $form->textFieldControlGroup($modelUsers, 'id', array('maxlength' => 10, 'class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('id'))); ?>
                    						-->
                                            <?php echo $form->textFieldControlGroup($modelUsers, 'username', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('username'))); ?>
											<?php echo $form->dropDownListControlGroup($modelUsers, 'type', SimbHtml::getEnumItem($modelUsers,'type'),array('empty' => 'Select Admin Type'))?>
										
											
            </div>	<!-- Hide field not necessary
                    <div class="span4">           
                     						<?php echo $form->textFieldControlGroup($modelUsers, 'salt', array('maxlength' => 8, 'class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('salt'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUsers, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('creator_id'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUsers, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('ordering'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUsers, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('created_at'))); ?>

            </div>
                    <div class="span4">            <?php echo $form->textFieldControlGroup($modelUsers, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('updated_at'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUsers, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('status'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelUsers, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelUsers->getAttributeLabel('is_deleted'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelUsers, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelUsers->getAttributeLabel('params'))); ?>
	
            </div>
             -->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
