<!-- message -->
<div style="position: relative; margin: 20px; z-index: 999999">
    <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e(__($message)); ?></strong>
    </div>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
    <div class="alert alert-danger alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e(__($message)); ?></strong>
    </div>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
    <div class="alert alert-warning alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e(__($message)); ?></strong>
    </div>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
    <div class="alert alert-info alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e(__($message)); ?></strong>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>

        <div class="alert alert-danger" style="position: absolute; top: 0; right: 0;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e(__($error)); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

<?php endif; ?>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/root/message.blade.php ENDPATH**/ ?>