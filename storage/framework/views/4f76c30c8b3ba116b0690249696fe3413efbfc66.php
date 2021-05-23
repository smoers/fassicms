<div class="container-fluid">
    <?php if($whatIs == 'crane'): ?>
        <?php  $_modify = route('crane.edit',$crane->id); ?>
        <?php  $_show = ''; ?>
        <?php  $_remove = ''; ?>
        <?php  $_print = ''; ?>
        <?php  $_print_id = ''; ?>
        <?php  $_r_modify = true; ?>
    <?php elseif($whatIs == 'customer'): ?>
        <?php  $_modify = route('customer.edit',$customer->id); ?>
        <?php  $_show = ''; ?>
        <?php  $_remove = ''; ?>
        <?php  $_print = ''; ?>
        <?php  $_print_id = ''; ?>
        <?php  $_r_modify = true; ?>
    <?php elseif($whatIs == 'technician'): ?>
        <?php  $_modify = route('technician.edit',$technician->id); ?>
        <?php  $_show = ''; ?>
        <?php  $_remove = ''; ?>
        <?php  $_print = ''; ?>
        <?php  $_print_id = ''; ?>
        <?php  $_r_modify = true; ?>
    <?php elseif($whatIs == 'worksheet'): ?>
        <?php  $_modify = route('worksheet.edit',$worksheet->id); ?>
        <?php  $_show = ''; ?>
        <?php  $_remove = ''; ?>
        <?php  $_hour = route('clocking.edit',$worksheet->id); ?>
        <?php  $_part = route('worksheet.part',$worksheet->id); ?>
        <?php  $_print = route('worksheet.print'); ?>
        <?php  $_print_id = $worksheet->id; ?>
        <?php  $_r_modify = !$worksheet->validated; ?>
    <?php endif; ?>
    <div class="d-flex justify-content-md-end justify-content-sm-end justify-content-lg-end" style="height: auto">
        <?php if($_r_modify): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['edit customer','edit crane','edit technician','edit worksheet'])): ?>
                <div class="ml-2"><a href="<?php echo e($_modify); ?>" class="btn btn-primary moco-btn-sm"><i class="fas fa-edit" style="color: white !important;"></i> <?php echo e(trans('Modify')); ?></a></div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($whatIs == 'worksheet'): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clocking worksheet')): ?><div class="ml-2"><a href="<?php echo e($_hour); ?>" class="btn btn-info moco-btn-sm"><i class="fas fa-clock" style="color: white !important;"></i> <?php echo e(trans('Hours')); ?></a></div><?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('part worksheet')): ?><div class="ml-2"><a href="<?php echo e($_part); ?>" class="btn btn-info moco-btn-sm"><i class="fas fa-clock" style="color: white !important;"></i> <?php echo e(trans('Parts')); ?></a></div><?php endif; ?>
        <?php else: ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['consult customer','consult crane','consult technician'])): ?>
                <div class="ml-2"><a href="<?php echo e($_show); ?>" class="btn btn-info moco-btn-sm"><i class="fas fa-eye" style="color: white !important;"></i> <?php echo e(trans('Show')); ?></a></div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['consult worksheet','print worksheet'])): ?>
        <div class="ml-2">
            <a class="nav-link dropdown-toggle btn btn-secondary moco-btn-sm" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Plus</a>
            <div class="dropdown-menu">
                <?php if($whatIs == 'worksheet'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('consult worksheet')): ?><a class="dropdown-item moco-color-info moco-error-small" href="<?php echo e($_show); ?>"><i class="fas fa-eye"></i> <?php echo e(trans('Show')); ?> </a><?php endif; ?>
                <?php endif; ?>
                <!-- <a class="dropdown-item moco-color-error moco-error-small" href="<?php echo e($_remove); ?>"><i class="fas fa-trash-alt"></i> <?php echo e(trans('Remove')); ?> </a> -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print worksheet')): ?><a class="dropdown-item moco-color-info moco-error-small" href="<?php echo e($_print); ?>" id="print_<?php echo e($_print_id); ?>"><i class="fas fa-print"></i> <?php echo e(trans('Print')); ?> </a><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<?php /**PATH /var/www/moco/fassicms/resources/views/menus/list-submenu.blade.php ENDPATH**/ ?>