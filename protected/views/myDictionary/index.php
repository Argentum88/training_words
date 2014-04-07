<?php
/* @var $this MyDictionaryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'My Dictionaries',
);

$this->menu=array(
	array('label'=>'Create MyDictionary', 'url'=>array('create')),
	array('label'=>'Manage MyDictionary', 'url'=>array('admin')),
);
?>

<h1>Мой словарь</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
