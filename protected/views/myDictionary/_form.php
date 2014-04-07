<?php
/* @var $this MyDictionaryController */
/* @var $modelRusWord RusWord */
/* @var $modelEngWord EngWord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'my-dictionary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($modelEngWord,'word'); ?>
        <?php echo $form->textField($modelEngWord,'word'); ?>
        <?php echo $form->error($modelEngWord,'word'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($modelRusWord,'word'); ?>
        <?php echo $form->textField($modelRusWord,'word'); ?>
        <?php echo $form->error($modelRusWord,'word'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($modelMyDictionary->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->