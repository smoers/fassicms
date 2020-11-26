<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Stock restocking')); ?></h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="<?php echo e(route('reassort.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="id" name="id" value="<?php echo e($_store->id); ?>">
                    <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number"><?php echo e(__('Part Number')); ?></label>
                        <input type="text" id="part_number" name="part_number" class="form-control" readonly value="<?php echo e(old('part_number', $_store->part_number)); ?>">
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description"><?php echo e(__('Description')); ?></label>
                        <input type="text" id="description" name="description" class="form-control" readonly value="<?php echo e(old('description', $_store->description)); ?>"></input>
                    </div>

                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- qty-before -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_before"><?php echo e(__('Number of pieces in stock')); ?></label>
                                <input type="number" id="qty_before" name="qty_before" class="form-control" readonly value="<?php echo e(old('qty_before', $_store->qty)); ?>"></input>
                            </div>
                        </div>
                        <!-- qty-add -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_add"><?php echo e(__('Number of parts to add')); ?></label>
                                <input type="number" id="qty_add" name="qty_add" class="form-control" value="<?php echo e(old('qty_add')); ?>"></input>
                                <div class="moco-error-small danger-darker-hover" id="qty_addError"></div>
                            </div>
                        </div>
                        <!-- qty-new -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_new"><?php echo e(__('New stock')); ?></label>
                                <input type="number" id="qty_new" name="qty_new" class="form-control" readonly value="<?php echo e(old('qty_new')); ?>"></input>
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Reason -->
                            <div class="form-group">
                                <label for="reason"><?php echo e(__('Reason')); ?></label>
                                <select id="reason" name="reason" class="selectpicker form-control" data-live-search="true" title="<?php echo e(__('Select a reason')); ?>">
                                    <?php $__currentLoopData = $_reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($_reason->id); ?>" <?php if($_reason->id == old('reason')): ?> selected <?php endif; ?>><?php echo e(__($_reason->reason)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="moco-error-small danger-darker-hover" id="reasonError"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Note -->
                            <div class="form-group">
                                <label for="note"><?php echo e(__('Note')); ?></label>
                                <input type="text" id="note" name="note" class="form-control mt-2" value="<?php echo e(old('note')); ?>"></input>
                                <div class="moco-error-small danger-darker-hover" id="noteError"></div>
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
            var addValidation = 0;
            var reasonValidation = 0;
            var noteValidation = 0;

            /** calcule la nouvelle valeur du stock **/
            $('#qty_add').on('keyup', function (event) {
                clearTimeout(addValidation);
                add =  $('#qty_add').val();
                before = $('#qty_before').val();
                if(!isNaN(add) && !isNaN(before)) {
                    $('#qty_new').val(parseInt(before) + parseInt(add));
                }
                addValidation = setTimeout(reassortValidation,1000,'#qty_add');
            })

            /** validation du champ Reason **/
            $('#reason').on('change',function (event){
                clearTimeout(reasonValidation)
                pullValidation = setTimeout(reassortValidation,1000,'#reason');
            })
            /** Validation du champ Note **/
            $('#note').on('keyup', function (event) {
                clearTimeout(noteValidation);
                noteValidation = setTimeout(reassortValidation,1000,'#note');
            })

            var reassortValidation = function (selector) {
                console.log("Start AJAX");
                qty_add = $('#qty_add').val();
                reason = $('#reason').val();
                note = $('#note').val();
                $.ajax({
                    url: "<?php echo e(route('reassort.ajaxvalidation')); ?>",
                    type:"POST",
                    data:{
                        "_token": "<?php echo e(csrf_token()); ?>",
                        qty_add: qty_add,
                        reason: reason,
                        note: note,
                    },
                    success:function (response) {
                        console.log(response);
                        $(selector).removeClass('is-invalid').addClass('is-valid');
                        $(selector+'Error').text("");
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
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reassort/reassort-part-form.blade.php ENDPATH**/ ?>