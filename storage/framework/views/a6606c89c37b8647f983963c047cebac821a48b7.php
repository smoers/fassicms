<form wire:submit.prevent="validated" method="post">
    <div class="row ml-4">
        <?php if($mode['value'] >= 2 && $mode['value'] <= 4 || $mode['value'] == 6 ): ?>
            <p class="red-darker-hover"><i class="fas fa-exclamation-triangle"></i> : <?php echo e($mode['msg']); ?></p>
        <?php elseif($mode['value'] == 1): ?>
            <p class="blue-darker-hover"><i class="fas fa-edit"></i> : <?php echo e($mode['msg']); ?></p>
        <?php elseif($mode['value'] == 5): ?>
            <p class="green-darker-hover"><i class="fas fa-info-circle"></i> : <?php echo e($mode['msg']); ?></p>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <div class="card">
                <div class="card-header moco-title-table">
                    <img src="/images/crane-32.png"> <?php echo e(__('Crane')); ?>

                </div>
                <div class="card-body">
                    <input id="crane_id" name="crane_id" type="hidden" wire:model="crane_id">
                    <div class="form-group">
                        <label for="serial"><?php echo e(__('Serial number')); ?></label>
                        <input type="text" list="listcranes" id="serial" name="serial" class="form-control form-control-sm" autocomplete="off" wire:model="serial">
                        <datalist id="listcranes">
                            <?php $__currentLoopData = $listCranes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crane): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($crane->serial); ?>" label="<?php echo e($crane->serial); ?> : <?php echo e($crane->crane_model); ?>"/>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </datalist>
                        <?php $__errorArgs = ['serial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="crane_model"><?php echo e(__('Model')); ?></label>
                        <input type="text" id="crane_model" name="crane_model" class="form-control form-control-sm" autocomplete="off" wire:model="crane_model"/>
                        <?php $__errorArgs = ['crane_model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header moco-title-table"><img src="/images/customer-32.png"> <?php echo e(__("Customer")); ?></div>
                <div class="card-body">
                    <input id="customer_id" name="customer_id" type="hidden" value="" wire:model="customer_id">
                    <div class="form-group">
                        <label for="customer_name"><?php echo e(__('Company name')); ?></label>
                        <input type="text" list="listcustomers" id="customer_name" name="customer_name" class="form-control form-control-sm" autocomplete="off" wire:model="customer_name">
                        <datalist id="listcustomers">
                            <?php $__currentLoopData = $listCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($customer->name); ?>" label="<?php echo e($customer->address); ?> <?php echo e($customer->city); ?>"/>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </datalist>
                        <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-3">
            <div class="card">
                <div class="card-header moco-title-table">
                    <img src="/images/truck-32.png"> <?php echo e(__('Truck')); ?>

                </div>
                <div class="card-body">
                    <input id="truck_id" name="truck_id" type="hidden" wire:model="truck_id">
                    <div class="form-group">
                        <label for="plate"><?php echo e(__('Numberplate')); ?></label>
                        <input type="text" list="listtrucks" id="plate" name="plate" class="form-control form-control-sm" autocomplete="off" wire:model="plate">
                        <datalist id="listtrucks">
                            <?php $__currentLoopData = $listTrucks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truck): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($truck->plate); ?>" label="<?php echo e($truck->plate); ?> : <?php echo e($truck->brand); ?> <?php echo e($truck->truck_model); ?>"/>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </datalist>
                        <?php $__errorArgs = ['plate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="brand"><?php echo e(__('Brand')); ?></label>
                        <input type="text" id="brand" name="brand" class="form-control form-control-sm" autocomplete="off" wire:model="brand"/>
                        <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="truck_model"><?php echo e(__('Model')); ?></label>
                        <input type="text" id="truck_model" name="truck_model" class="form-control form-control-sm" autocomplete="off" wire:model="truck_model"/>
                        <?php $__errorArgs = ['truck_model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
        </div>
        <div>
            <a href="<?php echo e(route('crane.index')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
        </div>
    </div>
    <div class="row" <?php if($hasHistoric == false): ?> hidden <?php endif; ?>>
        <div class="col-12">
            <div class="card">
                <div class="card-header text-left">
                    <?php echo e(__('History')); ?>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="moco-title-table">
                        <tr>
                            <th><?php echo e(__('Source')); ?></th>
                            <th><?php echo e(__('Serial Number')); ?></th>
                            <th><?php echo e(__('Numberplate')); ?></th>
                            <th><?php echo e(__('Customer')); ?></th>
                            <th><?php echo e(__('Date')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $histories['crane']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crane): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><img src="/images/crane-32.png"></td>
                                <td><?php echo e($crane->serial); ?></td>
                                <td><?php echo e($crane->plate); ?></td>
                                <td><?php echo e($crane->name); ?></td>
                                <td><?php echo e($crane->date_current); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $histories['truck']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truck): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><img src="/images/truck-32.png"></td>
                                <td><?php echo e($truck->serial); ?></td>
                                <td><?php echo e($truck->plate); ?></td>
                                <td><?php echo e($truck->name); ?></td>
                                <td><?php echo e($truck->date_current); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Message avant la sauvegarde -->
<div class="modal" id="modal_message" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <div class="d-flex justify-content-sm-center align-items-center">
                        <p class="moco-color-error h4"><img src="/images/siren-48.png"> <?php echo e(__('Attention')); ?></p>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="moco-color-error moco" id="message"></div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="d-flex justify-content-md-between">
                        <button type="button" id="saveModal" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Save')); ?></button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function (){
        $('#customer_name').on('focusout',function (){
            Livewire.emit('eventCustomerNameFocusOut');
        })
        $('#saveModal').on('click',function (){
            Livewire.emit('save');
        })
        window.addEventListener('openMessageModal', event => {
            $('#message').html(event.detail.message);
            $("#modal_message").modal('show');
        })
        window.addEventListener('closeMessageModal', event => {
            $("#modal_message").modal('hide');
        })
    })
</script>
<?php /**PATH /var/www/moco/fassicms/resources/views/crane/crane-livewire.blade.php ENDPATH**/ ?>