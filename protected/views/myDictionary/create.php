<?php
/* @var $this MyDictionaryController */
/* @var $modelRusWord RusWord */
/* @var $modelEngWord EngWord */

$this->breadcrumbs=array(
	'My Dictionaries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MyDictionary', 'url'=>array('index')),
	array('label'=>'Manage MyDictionary', 'url'=>array('admin')),
);
?>

<h1>Create MyDictionary</h1>

<?php echo $this->renderPartial('_form', array(
    'modelRusWord'=>$modelRusWord,
    'modelEngWord'=>$modelEngWord,
)); ?>