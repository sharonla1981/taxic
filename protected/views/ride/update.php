<?php
/* @var $this RideController */
/* @var $model Ride */

$this->breadcrumbs=array(
	'Rides'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ride', 'url'=>array('index')),
	array('label'=>'Create Ride', 'url'=>array('create')),
	array('label'=>'View Ride', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ride', 'url'=>array('admin')),
);
?>

<h1>Update Ride <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>