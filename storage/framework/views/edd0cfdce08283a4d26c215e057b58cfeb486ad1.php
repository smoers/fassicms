<form wire:submit.prevent="save" method="post">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-3">
            <!-- Date -->
            <div class="form-group">
                <label for="date"><?php echo e(__('Date')); ?></label>
                <div class="input-group mb-3">
                    <input type="text" id="date" name="date" class="form-control form-control-sm" placeholder="<?php echo e(__('DD/MM/YYYY')); ?>" aria-label="date" aria-describedby="basic-addon1" wire:model.debounce.2000ms="worksheet.date"/>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                    </div>
                </div>
                <?php $__errorArgs = ['worksheet.date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-2">
            <!-- Number -->
            <div class="form-group">
                <label for="number"><?php echo e(__('Number')); ?></label>
                <input type="text" id="number" name="number" class="form-control form-control-sm" value="" readonly wire:model="worksheet.number"/>
            </div>
        </div>
        <div class="col-2">
            <!-- Warranty -->
            <div class="form-group">
                <label for="warranty"><?php echo e(__('Warranty')); ?></label>
                <select id="warranty" name="warranty" class="form-control form-control-sm" wire:model="warranty">
                    <option value="1"><?php echo e(__('Yes')); ?></option>
                    <option value="0"><?php echo e(__('No')); ?></option>
                </select>
                <?php $__errorArgs = ['worksheet.warranty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-2">
            <!-- Validated -->
            <div class="form-group">
                <label for="validated"><?php echo e(__('Validated')); ?></label>
                <select id="validated" name="validated" class="form-control form-control-sm" wire:model="validated">
                    <option value="1" ><?php echo e(__('Yes')); ?></option>
                    <option value="0" ><?php echo e(__('No')); ?></option>
                </select>
                <?php $__errorArgs = ['worksheet.validated'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-3">
            <!-- Validated date -->
            <div class="form-group">
                <label for="validated_date"><?php echo e(__('Validated date')); ?></label>
                <input type="text" id="validated_date" name="validated_date" class="form-control form-control-sm" value="" readonly wire:model="validated_date"/>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#general" class="nav-link <?php if($tab_general): ?> active <?php endif; ?>" data-toggle="tab" wire:click="setTab"><?php echo e(__('General data')); ?></a>
            </li>
            <li class="nav-item">
                <a href="#data" class="nav-link <?php if($tab_data): ?> active <?php endif; ?>" data-toggle="tab" wire:click="setTab"><?php echo e(__('Data')); ?></a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <!-- TAB GENERAL-->
            <div class="tab-pane fade <?php if($tab_general): ?> show active <?php endif; ?>" id="general">
                <div class="row">

                    <!-- Search -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="searchCrane"><?php echo e(__('Search crane')); ?> <a href="#" id="add_crane" wire:click="addTrucksCrane"><img src=<?php echo e(asset('/images/crane-24.png')); ?>/></a> </label>
                            <input id="searchCrane" name="searchCrane" class="form-control form-control-sm" placeholder="<?php echo e(__('Search ...')); ?>" autocomplete="off" wire:model="searchCrane"/>
                            <div class="position-absolute mt-1" style="border-radius: 4px; border: lightgray 1px solid;z-index: 9999; height: 300px; width: 475px; background-color: white; overflow: auto; padding: 10px" <?php if(count($search) == 0): ?> hidden <?php endif; ?>>
                                <?php $__currentLoopData = $search; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card mb-2 p-2" style="font-size: 9px;">
                                        <div class="d-flex d-sm-flex flex-sm-column">
                                            <div class="row">
                                                <div class="col-sm-10 border-right">
                                                    <div class="red-lighter-hover font-weight-bold"><?php echo e($item->serial); ?></div>
                                                    <div><?php echo e($item->crane_model); ?> - <?php echo e($item->plate); ?></div>
                                                    <div><?php echo e($item->name); ?> - <?php echo e($item->address); ?></div>
                                                    <div><?php echo e($item->zipcode); ?> - <?php echo e($item->city); ?> - <?php echo e($item->country); ?></div>
                                                </div>
                                                <div class="col-sm-2 d-flex d-sm-flex align-items-center"><a href="#" wire:click="getTruckCrane(<?php echo e($item->tc_id); ?>)"><i class="fas fa-edit fa-2x" style="color: darkblue !important;"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="moco-error-small danger-darker-hover" id="crane_idError">
                            </div>
                        </div>
                    </div>

                    <!-- TrucksCrane -->
                    <div class="col-6">
                        <div class="form-group">
                            <label><?php echo e(__('Crane')); ?> <a href="#" id="add_crane" wire:click="addTrucksCrane"><img src=<?php echo e(asset('/images/crane-24.png')); ?>/></a> </label>
                            <input type="number" hidden wire:model="worksheet.truckscrane.id"/>
                            <?php if(is_null($truckscrane)): ?>
                                <div class="card" style="height: 200px">
                                    <div class="card-body" id="cardBody">
                                        <p style="color: lightgray"><?php echo e(__('No crane selected')); ?></p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="card mb-2 p-2" style="font-size: 12px; cursor:pointer">
                                    <div class="d-flex d-sm-flex flex-sm-column">
                                        <div class="row">
                                            <div class="col-sm-10 border-right">
                                                <div class="red-lighter-hover font-weight-bold"><?php echo e($truckscrane->serial); ?>  </div>
                                                <div><?php echo e($truckscrane->crane_model); ?></div>
                                                <div><?php echo e($truckscrane->plate); ?> - <?php echo e($truckscrane->brand); ?> - <?php echo e($truckscrane->truck_model); ?></div>
                                                <div class="red-lighter-hover font-weight-bold"><?php echo e($customer->name); ?></div>
                                                <div><?php echo e($customer->address); ?></div>
                                                <div><?php echo e($customer->zipcode); ?> - <?php echo e($customer->city); ?> - <?php echo e($customer->country); ?></div>
                                            </div>
                                            <div class="col-sm-2 d-flex d-sm-flex align-items-center"><a href="#" wire:click="removeTruckCrane()"><i class="fas fa-trash fa-2x" style="color: darkred !important;"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php $__errorArgs = ['worksheet.truckscrane_id'];
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

            <!-- TAB DATA -->

            <div class="tab-pane fade <?php if($tab_data): ?> show active <?php endif; ?>" id="data">

                <!-- Remarks -->
                <div class="form-group">
                    <label for="remarks"><?php echo e(__('Customer remarks')); ?></label>
                    <textarea id="remarks" name="remarks" rows="5" autocomplete="off" class="form-control form-control-sm" wire:model="worksheet.remarks"></textarea>
                </div>

                <!-- Work -->
                <div class="form-group">
                    <label for="work"><?php echo e(__('Work done')); ?></label>
                    <textarea id="work" name="work" rows="5" autocomplete="off" class="form-control form-control-sm" wire:model="worksheet.work"></textarea>
                </div>

                <div class="row">
                    <div class="col-4">

                        <!-- Oil replace -->
                        <div class="form-group">
                            <label for="oil_replace"><?php echo e(__('Oil replaced (liter)')); ?></label>
                            <input type="text" id="oil_replace" name="oil_replace" class="form-control form-control-sm" wire:model.debounce.5000ms="worksheet.oil_replace">
                            <?php $__errorArgs = ['worksheet.oil_replace'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="moco-error-small moco-color-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-2">

                        <!-- Oil filtered -->
                        <div class="form-group">
                            <label for="oil_filtered"><?php echo e(__('Oil filtered')); ?></label>
                            <select id="oil_filtered" name="oil_filtered" class="form-control form-control-sm" wire:model="oil_filtered">
                                <option value="1"><?php echo e(__('Yes')); ?></option>
                                <option value="0"><?php echo e(__('No')); ?></option>
                            </select>
                            <?php $__errorArgs = ['worksheet.oil_filtered'];
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
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
        </div>
        <div>
            <a href="<?php echo e(route('worksheet.index')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
        </div>
    </div>
</form>

<script src="<?php echo e(asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.fr.min.js')); ?>"></script>
<script src="<?php echo e(asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.nl-BE.min.js')); ?>"></script>

<script type="text/javascript">
    $(function () {
        var fields = [
            'number',
            'date',
            'crane_id',
            'customer_id',
            'serial',
            'model',
            'plate',
            'name',
            'address',
            'phone',
            'mail',
            'vat',
            'remarks',
            'work',
            'oil_replace',
            'oil_filtered',
            'warranty',
        ];

        $('#searchCrane').on('focusout', function () {
            Livewire.emit('eventSearchCraneFocusOut');
        })

        $('#date').datepicker({
            format: 'dd/mm/yyyy',
            orientation: 'bottom auto',
            language: 'fr',
            todayBtn: "linked",
            autoclose: true,
        }).on('changeDate',(event) => {
            livewire.emit('eventDatePickerChange',moment(event.date).format('DD/MM/YYYY'));
            //console.log(moment(event.date).format('DD/MM/YYYY'));
        });
    })
</script>

<?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/worksheet-livewire.blade.php ENDPATH**/ ?>