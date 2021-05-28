<!-- message -->

<?php if($message = Session::get('success')): ?>
    <script type="text/javascript">
        iziToast.success({
            title: '<?php echo e(__('Success')); ?>',
            message: '<?php echo e(__($message)); ?>',
            timeout: 10000,
        });
    </script>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
    <script type="text/javascript">
        iziToast.error({
            title: '<?php echo e(__('Error')); ?>',
            message: '<?php echo e(__($message)); ?>',
            timeout: 10000,
        });
    </script>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
    <script type="text/javascript">
        iziToast.warning({
            title: '<?php echo e(__('Warning')); ?>',
            message: '<?php echo e(__($message)); ?>',
            timeout: 10000,
        });
    </script>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
    <script type="text/javascript">
        iziToast.info({
            title: '<?php echo e(__('Info')); ?>',
            message: '<?php echo e(__($message)); ?>',
            timeout: 10000,
        });
    </script>
<?php endif; ?>

<?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script type="text/javascript">
                iziToast.error({
                    title: '<?php echo e(__('Error')); ?>',
                    message: '<?php echo e(__($error)); ?>',
                    timeout: 10000,
                });
            </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php /**PATH /var/www/moco/fassicms/resources/views/root/message.blade.php ENDPATH**/ ?>