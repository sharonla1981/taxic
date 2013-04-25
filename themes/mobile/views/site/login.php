<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="form">
<?php echo CHtml::beginForm(array('action'=>$this)); ?>
 
    <?php echo CHtml::errorSummary($model); ?>
 
    <div class="row">
        <?php echo CHtml::activeLabel($model,'email'); ?>
        <?php echo CHtml::activeTextField($model,'email') ?>
    </div>
 
    <div class="row">
        <?php echo CHtml::activeLabel($model,'password'); ?>
        <?php echo CHtml::activePasswordField($model,'password') ?>
    </div>
 
    <div class="row rememberMe">
        <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
        <?php echo CHtml::activeLabel($model,'rememberMe'); ?>
    </div>
 
    <div class="row submit">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


</div><!-- form -->
