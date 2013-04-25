<?php
/* @var $this RideController */
/* @var $model Ride */

$this->breadcrumbs=array(
	'Rides'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ride', 'url'=>array('index')),
	array('label'=>'Manage Ride', 'url'=>array('admin')),
);
?>

<h1>Create Ride</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>