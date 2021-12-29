    <div class="d-flex justify-content-start">
        <div class="ml-2"><a href="#" class="btn btn-danger moco-btn-sm closed_id" id="closed_<?php echo e($model->id); ?>" object="<?php echo e(json_encode($model, true)); ?>"><?php echo e(__('Closed')); ?></a></div>
        <div class="ml-2"><a href="#" class="btn btn-primary moco-btn-sm removed_id" id="removed_<?php echo e($model->id); ?>"><?php echo e(__('Removed')); ?></a></div>
    </div>
<?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/clocking-correct-action.blade.php ENDPATH**/ ?>