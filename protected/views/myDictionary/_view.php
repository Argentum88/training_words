<?php
/* @var $this MyDictionaryController */
/* @var $data MyDictionary */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Слово')); ?>:</b>
	<?php echo CHtml::encode($data->Dictionary->engWord->word); ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('Перевод')); ?>:</b>
    <?php echo CHtml::encode($data->Dictionary->rusWord->word); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Прогресс изучения(от 0 до 9)')); ?>:</b>
	<?php echo CHtml::encode($data->progress); ?>
	<br />

</div>