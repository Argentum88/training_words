<?php
/* @var $this MyDictionaryController */
/* @var $model MyDictionary */

$this->breadcrumbs=array(
	'My Dictionaries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MyDictionary', 'url'=>array('index')),
	array('label'=>'Create MyDictionary', 'url'=>array('create')),
	array('label'=>'Update MyDictionary', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MyDictionary', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MyDictionary', 'url'=>array('admin')),
);
?>

<h1>View MyDictionary #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_user',
		'id_dictionary',
		'progress',
	),
)); ?>
