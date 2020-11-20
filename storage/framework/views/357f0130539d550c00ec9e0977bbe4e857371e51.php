<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
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
                        <input type="text" id="part_number" name="part_number" class="form-control" value="<?php echo e(old('part_number')); ?>">
                        <div class="moco-error-small danger-darker-hover" id="part_numberError"></div>
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description"><?php echo e(__('Description')); ?></label>
                        <input type="text" id="description" name="description" class="form-control" value="<?php echo e(old('description')); ?>"></input>
                        <div class="moco-error-small danger-darker-hover" id="descriptionError"></div>
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- Quantity -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="qty"><?php echo e(__('Quantity')); ?></label>
                                <input type="number" id="qty" name="qty" class="form-control" value="<?php echo e(old('qty')); ?>"></input>
                                <div class="moco-error-small danger-darker-hover" id="qtyError"></div>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="location"><?php echo e(__('Location')); ?></label>
                                <input type="text" id="location" name="location" class="form-control" value="<?php echo e(old('location')); ?>"></input>
                                <div class="moco-error-small danger-darker-hover" id="locationError"></div>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price"><?php echo e(__('Price')); ?></label>
                                <input type="text" id="price" name="price" class="form-control" value="<?php echo e(old('price')); ?>"></input>
                                <div class="moco-error-small danger-darker-hover" id="priceError"></div>
                            </div>
                        </div>
                        <!-- Year -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="year"><?php echo e(__('Year')); ?></label>
                                <input type="number" id="year" name="year" class="form-control" value="<?php echo e(\Carbon\Carbon::now()->year); ?>" readonly="readonly"></input>
                                <div class="moco-error-small danger-darker-hover" id="yearError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <!-- Provider -->
                            <div class="form-group">
                                <label for="provider"><?php echo e(__('Provider')); ?></label>
                                <select id="provider" name="provider" class="selectpicker form-control" data-live-search="true" title="<?php echo e(__('Select a provider')); ?>">
                                    <?php $__currentLoopData = $_providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($_provider->id); ?>" ><?php echo e($_provider->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="moco-error-small danger-darker-hover" id="providerError"></div>
                            </div>
                        </div>
                        <div class="col-2">
                            <!-- Enabled -->
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="enabled"><?php echo e(__('Enabled')); ?></label>
                                    <select <?php if(isset($_enabled)): ?> <?php if(!is_null($_enabled)): ?> readonly <?php endif; ?> <?php endif; ?> id="enabled" name="enabled" class="selectpicker form-control" data-width="fit" data-style="btn-primary">
                                        <option value="1" <?php if(isset($_enabled)): ?> <?php if($_enabled == 1): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(__('Yes')); ?></option>
                                        <option value="0" <?php if(isset($_enabled)): ?> <?php if($_enabled == 0): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(__('No')); ?></option>
                                    </select>
                                    <div class="moco-error-small danger-darker-hover" id="enabledError"></div>
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
    </div>
    <script type="text/javascript">
        $(function () {
            $('#part_number').on('focusout', function () {
                storeValidation('#part_number');
            });
            $('#description').on('focusout', function (){
                storeValidation('#description');
            });
            $('#qty').on('focusout', function (){
                storeValidation('#qty');
            });
            $('#location').on('focusout', function (){
                storeValidation('#location');
            });
            $('#price').on('focusout', function (){
                storeValidation('#price');
            });
            $('#year').on('focusout', function (){
                storeValidation('#year');
            });
            $('#provider').on('focusout', function (){
                storeValidation('#provider');
            });
            $('#enabled').on('focusout', function (){
                storeValidation('#enabled');
            });

            function storeValidation(selector) {
                part_number = $('#part_number').val();
                description = $('#description').val();
                qty = $('#qty').val();
                loc = $('#location').val();
                price = $('#price').val();
                year = $('#year').val();
                provider = $('#provider').val();
                enabled = $('#enabled').val();
                $.ajax({
                    url: "<?php echo e(route('store.ajaxvalidation')); ?>",
                    type:"POST",
                    data:{
                        "_token": "<?php echo e(csrf_token()); ?>",
                        part_number: part_number,
                        description: description,
                        qty: qty,
                        location: loc,
                        price: price,
                        year: year,
                        provider: provider,
                        enabled: enabled,
                    },
                    success:function (response) {
                        console.log(response);
                    },
                    error:function (response) {
                        id = $(selector).attr('id');
                        message = response.responseJSON.errors[id];
                        if(message == null)
                        {
                            $(selector).removeClass('is-invalid').addClass('is-valid');
                            $(selector+'Error').text("");
                        }
                        else
                        {
                            console.log([id, 'not null']);
                            $(selector).removeClass('is-valid').addClass('is-invalid');
                            $(selector+'Error').text(response.responseJSON.errors[id]);
                        }
                    }
                })
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/store-part-form.blade.php ENDPATH**/ ?>