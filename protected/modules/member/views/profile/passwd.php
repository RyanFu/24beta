<?php if (user()->hasFlash('user_save_result')):?>
<div class="alert alert-success fade in" data-dismiss="alert">
    <a href="javascript:void(0);" data-dismiss="alert" class="close">&times;</a>
    <?php echo user()->getFlash('user_save_result');?>
</div>
<?php endif;?>

<?php echo CHtml::form('', 'post', array('class'=>'form-horizontal member-form'));?>
<div class="control-group">
    <?php echo CHtml::activeLabel($model, 'username', array('class'=>'control-label'));?>
    <div class="controls">
        <?php echo CHtml::activeTextField($model, 'username', array('readonly'=>'readonly', 'class'=>'uneditable-input'));?>
    </div>
</div>
<div class="control-group <?php if($model->hasErrors('password')) echo 'error';?>">
    <?php echo CHtml::activeLabel($model, 'password', array('class'=>'control-label'));?>
    <div class="controls">
        <?php echo CHtml::activePasswordField($model, 'password');?>
        <?php if($model->hasErrors('password')):?><p class="help-block"><?php echo $model->getError('password');?></p><?php endif;?>
    </div>
</div>
<div class="form-actions">
    <input type="submit" value="提交" class="btn btn-primary" />
</div>
<?php echo CHtml::endForm();?>