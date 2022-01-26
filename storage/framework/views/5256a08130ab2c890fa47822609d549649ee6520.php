<div class="d-flex flex-sm-row">
    <div class="d-flex flex-sm-column mr-2">
        <img src="<?php echo e(asset('images/version-48.png')); ?>">
    </div>
    <div class="d-flex flex-sm-column">
        <div class="text text-warning"><?php echo e($config['version']); ?></div>
        <div class="text text-info" style="font-style: italic;font-weight: bold;font-size: 10px">Release note :</div>
        <?php $__currentLoopData = $config['release']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $release): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="text text-info" style="font-style: italic; font-size: 10px"><?php echo $release; ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/widgets/version-info.blade.php ENDPATH**/ ?>