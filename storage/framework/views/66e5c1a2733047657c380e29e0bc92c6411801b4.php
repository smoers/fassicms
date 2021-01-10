<div class="container-fluid">
    <div class="d-flex justify-content-md-end justify-content-sm-end justify-content-lg-end" style="height: auto">
        <?php if(strpos(url()->current(),'store')): ?>
            <div class="ml-2"><a class="btn btn-primary moco-btn-sm" href="<?php echo e(route('store.edit',[$store->id,$store->cat_id])); ?>"><i class="fas fa-edit" style="color: white !important;"></i> <?php echo e(__('Modify')); ?></a></div>
        <?php elseif(strpos(url()->current(),'reassort')): ?>
            <div class="ml-2"><a class="btn btn-info moco-btn-sm" href="<?php echo e(route('reassort.edit',$store->id)); ?>"><i class="fas fa-sign-in-alt" style="color: white !important;"></i></a></div>
            <div class="ml-2"><a class="btn btn-danger moco-btn-sm" href="<?php echo e(route('out.edit',$store->id)); ?>"><i class="fas fa-sign-out-alt" style="color: white !important;"></i></a></div>
        <?php endif; ?>
        <div class="ml-2"><a class="btn btn-info moco-btn-sm" href="<?php echo e(route('store.barcode_sticker',[$store->id])); ?>"><i class="fas fa-qrcode" style="color: white !important;"></i> <?php echo e(__('Print')); ?></a></div>
        <div class="ml-2">
            <a class="nav-link dropdown-toggle btn btn-secondary moco-btn-sm" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Plus</a>
            <div class="dropdown-menu">
                <a class="dropdown-item moco-color-error moco-error-small" href=""><i class="fas fa-trash-alt"></i> <?php echo e(trans('Remove')); ?> </a>
                <a class="dropdown-item moco-color-info moco-error-small" href=""><i class="fas fa-print"></i> <?php echo e(trans('Print')); ?> </a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/menus/store-list-sub.blade.php ENDPATH**/ ?>