<?php
/* @var $this GrowerController */
/* @var $modelGrower Grower */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array('class' => 'form-horizontal form-search-advanced form-validate'),
)); ?>

<div class="search-button-title">
    <?php echo CHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button btn')); ?>    <?php
            echo $form->dropDownList($modelGrower, 'rowsPerPage', $modelGrower->rowsPerPageData, array('class'=> 'posts-per-page', 'onclick' => "document.getElementById('".$form->id."').submit();"));
            ?></div>

<div class="search-form-ext" style="display:none">
    <div class="box-content nopadding">

                    <div class="span4">    <!-- 
                    						<?php // echo $form->textFieldControlGroup($modelGrower, 'id', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('id'))); ?>
 											-->
                                            <?php echo $form->textFieldControlGroup($modelGrower, 'name', array('maxlength' => 100, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('name'))); ?>

                                            <?php echo $form->textFieldControlGroup($modelGrower, 'username', array('maxlength' => 45, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('username'))); ?>

                                            <?php echo $form->textAreaControlGroup($modelGrower, 'email', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelGrower->getAttributeLabel('email'))); ?>
											
											<?php echo $form->dropDownListControlGroup($modelGrower, 'enabled', array('yes'=>'Yes','no'=>'No'),array('empty' => 'Select Grower Enabled'))?>
                            
                            				<?php echo $form->dropDownListControlGroup($modelGrower, 'reporting', SimbHtml::getEnumItem($modelGrower,'reporting'),array('empty' => 'Select Reporting Interval'))?>
								
            </div>
                    <div class="span4">    			<!-- 
                                            <?php //echo $form->textFieldControlGroup($modelGrower, 'creator_id', array('maxlength' => 20, 'class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('creator_id'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelGrower, 'ordering', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('ordering'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelGrower, 'created_at', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('created_at'))); ?>
											 -->
            </div>							<!-- 
                    <div class="span4">     <?php //echo $form->textFieldControlGroup($modelGrower, 'updated_at', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('updated_at'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelGrower, 'status', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('status'))); ?>

                                            <?php //echo $form->textFieldControlGroup($modelGrower, 'is_deleted', array('class' => 'input-xlarge', 'placeholder' => $modelGrower->getAttributeLabel('is_deleted'))); ?>

                                            <?php //echo $form->textAreaControlGroup($modelGrower, 'params', array( 'rows' => 6, 'class' => 'input-block-level', 'placeholder' => $modelGrower->getAttributeLabel('params')));?>
					
            </div> -->
            </div>
    <div class="form-actions">
        <?php echo TbHtml::submitButton(Yii::t('app', 'Search'),  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div><!-- search-form -->

<?php $this->endWidget(); ?>
