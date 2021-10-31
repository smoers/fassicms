<div>
    <div class="d-flex flex-column">
        <div class="moco-title">Test</div>
        <div>
            <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <?php $__currentLoopData = $heads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table => $head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $head; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e(__($item)); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </thead>
                <tbody>
                <?php $__currentLoopData = $worksheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $worksheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($worksheet->id); ?></td>
                        <td><?php echo e($worksheet->description); ?></td>
                        <td><?php echo e($worksheet->created_at); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            </div>
            <?php echo e($worksheets->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/reporting/reporting-worksheets-clockings.blade.php ENDPATH**/ ?>