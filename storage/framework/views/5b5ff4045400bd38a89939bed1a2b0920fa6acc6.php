        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Add a part')); ?></h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="<?php echo e(route('store.store')); ?>">
                <?php echo csrf_field(); ?>
                <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number"><?php echo e(__('Part Number')); ?></label>
                        <input wire:model="part_number" type="text" id="part_number" name="part_number" class="form-control" value="<?php echo e($part_number); ?>">
                        <?php $__errorArgs = ['part_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  <?php echo e(__($message)); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description"><?php echo e(__('Description')); ?></label>
                        <input wire:model="description" type="text" id="description "name="description" class="form-control" value="<?php echo e(old('description')); ?>"></input>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  <?php echo e(__($message)); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- Quantity -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="qty"><?php echo e(__('Quantity')); ?></label>
                                <input wire:model="qty" type="number" id="qty "name="qty" class="form-control" value="<?php echo e(old('qty')); ?>"></input>
                                <?php $__errorArgs = ['qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  <?php echo e(__($message)); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="location"><?php echo e(__('Location')); ?></label>
                                <input wire:model="location" type="text" id="location "name="location" class="form-control" value="<?php echo e(old('location')); ?>"></input>
                                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  <?php echo e(__($message)); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price"><?php echo e(__('Price')); ?></label>
                                <input wire:model="price" type="text" id="price "name="price" class="form-control" value="<?php echo e(old('price')); ?>"></input>
                                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  <?php echo e(__($message)); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <!-- Year -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="year"><?php echo e(__('Year')); ?></label>
                                <input wire:model="year" type="number" id="year "name="year" class="form-control" value="<?php echo e($year); ?>" readonly="readonly"></input>
                                <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  <?php echo e(__($message)); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>
                    <div wire:ignore class="row">
                        <div class="col-10">
                            <!-- Provider -->
                            <div class="form-group">
                                <label for="provider"><?php echo e(__('Provider')); ?></label>
                                <select id="provider" name="provider" class="selectpicker form-control" data-live-search="true" title="<?php echo e(__('Select a provider')); ?>">
                                    <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($_provider->id); ?>" <?php if($_provider->id == $_provider): ?> selected <?php endif; ?>><?php echo e($_provider->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <!-- Enabled -->
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="enabled"><?php echo e(__('Enabled')); ?></label>
                                    <select <?php if(isset($enabled)): ?> <?php if(!is_null($enabled)): ?> readonly <?php endif; ?> <?php endif; ?> id="enabled" name="enabled" class="selectpicker form-control" data-width="fit" data-style="btn-primary">
                                        <option value="true" <?php if(isset($enabled)): ?> <?php if($enabled == 'true'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(__('Yes')); ?></option>
                                        <option value="false" <?php if(isset($enabled)): ?> <?php if($enabled == 'false'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(__('No')); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                        <div class="col-10">
                            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/store/store-part-form.blade.php ENDPATH**/ ?>