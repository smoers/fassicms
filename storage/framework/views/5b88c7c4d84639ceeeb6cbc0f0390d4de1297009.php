<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Stock restocking')); ?></h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="<?php echo e(route('reassort.update')); ?>" moco-validation>
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="id" name="id" value="<?php echo e($_store->id); ?>">
                    <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number"><?php echo e(__('Part Number')); ?></label>
                        <input type="text" id="part_number" name="part_number" class="form-control" readonly value="<?php echo e(old('part_number', $_partmetadata->part_number)); ?>" moco-validation />
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <div class="col-8">
                            <!-- Description -->
                            <div class="form-group">
                                <label for="description"><?php echo e(__('Description')); ?></label>
                                <input type="text" id="description" name="description" class="form-control" readonly value="<?php echo e(old('description', $_partmetadata->description)); ?>" moco-validation />
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- Location -->
                            <div class="form-group">
                                <label for="description"><?php echo e(__('Location')); ?></label>
                                <input type="text" id="location" name="location" class="form-control" readonly value="<?php echo e(old('location', $_store->location()->first()->location.' : '.$_store->location()->first()->description)); ?>" moco-validation />
                            </div>
                        </div>
                    </div>


                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- qty-before -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_before"><?php echo e(__('Number of pieces in stock')); ?></label>
                                <input type="number" id="qty_before" name="qty_before" class="form-control" readonly value="<?php echo e(old('qty_before', $_store->qty)); ?>" moco-validation />
                            </div>
                        </div>
                        <!-- qty-add -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_add"><?php echo e(__('Number of parts to add')); ?></label>
                                <input type="number" id="qty_add" name="qty_add" class="form-control" value="<?php echo e(old('qty_add')); ?>" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="qty_addError"></div>
                            </div>
                        </div>
                        <!-- qty-new -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_new"><?php echo e(__('New stock')); ?></label>
                                <input type="number" id="qty_new" name="qty_new" class="form-control" readonly value="<?php echo e(old('qty_new')); ?>" moco-validation />
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Reason -->
                            <div class="d-flex flex-column">
                                <div><?php echo e(__('Reason')); ?></div>
                                <div>
                                    <select id="reason" name="reason" class="selectpicker form-control" data-live-search="true" title="<?php echo e(__('Select a reason')); ?>" moco-validation>
                                        <?php $__currentLoopData = $_reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($_reason->id); ?>" <?php if($_reason->id == old('reason')): ?> selected <?php endif; ?>><?php echo e(__($_reason->reason)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="moco-error-small danger-darker-hover" id="reasonError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Note -->
                            <div class="form-group note_area">
                                <label for="note"><?php echo e(__('Note')); ?></label>
                                <input type="text" id="note" name="note" class="form-control" value="<?php echo e(old('note')); ?>" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="noteError"></div>
                            </div>
                            <!-- Location -->
                            <div class="d-flex flex-column location_area">
                                <div class="location_area"><?php echo e(__('Location from')); ?></div>
                                <div class="location_area">
                                    <select id="location_id" name="location_id" disabled class="selectpicker form-control" data-width="fit" title="<?php echo e(__('Select a Location')); ?>" moco-validation>
                                        <?php $__currentLoopData = App\Models\Location::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($location->id); ?>" <?php if(old('location_id',$_store->location_id) == $location->id): ?> selected <?php endif; ?>><?php echo e(__($location->location)." : ".__($location->description)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="moco-error-small danger-darker-hover" id="location_idError"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                        <div>
                            <a href="<?php echo e(route('reassort.index')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.ajax.validation.js')); ?>"></script>
    <script type="text/javascript">
        $(function () {
            /** Cache le champ location **/
            $('.location_area').hide();
            $('#location_id').find('[value=<?php echo e($_store->location()->first()->id); ?>]').remove();
            /** event sur le changement de raison **/
            $('#reason').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
                if($('#reason').val() == <?php echo e($_move_from); ?>){
                    $('.note_area').hide();
                    $('.location_area').show();
                    $('#location_id').prop('disabled', false);
                    $('#location_id').selectpicker('refresh');
                } else {
                    $('.note_area').show();
                    $('.location_area').hide();
                };
            });
            /** calcule la nouvelle valeur du stock **/
            $('#qty_add').on('keyup', function (event) {
                add =  $('#qty_add').val();
                before = $('#qty_before').val();
                if(!isNaN(add) && !isNaN(before)) {
                    $('#qty_new').val(parseInt(before) + parseInt(add));
                }
            });
            /**
             * Disabled la touche enter pour pouvoir utiliser un scanner
             */
            $('#part-form').on('keypress', function (event) {
                var keyPressed = event.keyCode || event.which;
                if (keyPressed === 13) {
                    event.preventDefault();
                    return false;
                }
            })

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reassort/reassort-part-form.blade.php ENDPATH**/ ?>