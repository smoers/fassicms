<div class="container-fluid">
    <div class="row">
        <?php if(strpos(url()->current(),'store')): ?>
            <div class="col-4"><a href="<?php echo e(route('store.edit',[$store->id,$store->cat_id])); ?>"><i class="fas fa-edit" style="color: dodgerblue !important;"></i></a></div>
        <?php elseif(strpos(url()->current(),'reassort')): ?>
            <div class="col-2"><a href="<?php echo e(route('reassort.edit',$store->id)); ?>"><i class="fas fa-sign-in-alt" style="color: dodgerblue !important;"></i></a></div>
            <div class="col-2"><a href="<?php echo e(route('out.edit',$store->id)); ?>"><i class="fas fa-sign-out-alt" style="color:red !important;"></i></a></div>
        <?php endif; ?>
        <div class="col-4"><a href=""><i class="fas fa-qrcode" style="color: dodgerblue !important;"></i></a> </div>
        <div class="col-4"><a href=""><i class="fas fa-trash-alt" style="color: red !important;"></i></a></div>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/menus/store-list-sub.blade.php ENDPATH**/ ?>