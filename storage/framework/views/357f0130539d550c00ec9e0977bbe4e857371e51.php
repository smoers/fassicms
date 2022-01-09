<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e($title); ?></h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="<?php echo e($_action); ?>" moco-validation>
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="id" name="id" value="<?php echo e($partmetadata->id); ?>">
                    <input type="hidden" id="cat_id" name="cat_id" value="<?php echo e($catalog->id); ?>">
                    <input type="hidden" id="new_provider_name" name="new_provider_name" value="<?php echo e(old('new_provider_name')); ?>">

                    <div class="row">
                        <div class="col-6">
                            <!-- Part Number-->
                            <div class="form-group">
                                <label for="part_number"><?php echo e(__('Part Number')); ?></label>
                                <input type="text" id="part_number" name="part_number" class="form-control"
                                       <?php if($partmetadata->id != null): ?> readonly
                                       <?php endif; ?> value="<?php echo e(old('part_number', $partmetadata->part_number)); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="part_numberError"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Bar Code-->
                            <div class="form-group">
                                <label for="part_number"><?php echo e(__('Bar Code')); ?></label>
                                <input type="text" id="bar_code" name="bar_code" class="form-control"
                                       value="<?php echo e(old('bar_code', $partmetadata->bar_code)); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="bar_codeError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <!-- Description -->
                            <div class="form-group">
                                <label for="description"><?php echo e(__('Description')); ?></label>
                                <input type="text" id="description" name="description" class="form-control"
                                       value="<?php echo e(old('description', $partmetadata->description)); ?>" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="descriptionError"></div>
                            </div>
                        </div>
                        <div class="col-2">
                            <!-- Electrical Part -->
                            <div class="d-flex flex-column">
                                <div><?php echo e(__('Electrical Part')); ?></div>
                                <div>
                                <select id="electrical_part" name="electrical_part" class="selectpicker form-control" data-width="fit" title="<?php echo e(__('Electrical')); ?>" moco-validation>
                                    <option value="1" <?php if(old('electrical_part',$partmetadata->electrical_part) == 1): ?> selected <?php endif; ?>><?php echo e(__('Yes')); ?></option>
                                    <option value="0" <?php if(old('electrical_part',$partmetadata->electrical_part) == 0): ?> selected <?php endif; ?>><?php echo e(__('No')); ?></option>
                                </select>
                                <div class="moco-error-small danger-darker-hover" id="electrical_partError"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- Reassort Level -->
                        <div class="col-2">
                            <div class="form-group">
                                <label for="reassort_level"><?php echo e(__('Reassort Level')); ?></label>
                                <input type="number" id="reassort_level" name="reassort_level" class="form-control" value="<?php echo e(old('reassort_level', $partmetadata->reassort_level)); ?>" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="reassort_levelError"></div>
                            </div>
                        </div>
                        <?php if($partmetadata->id == null): ?>
                            <!-- Quantity -->
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="qty"><?php echo e(__('Quantity')); ?></label>
                                        <input type="number" id="qty" name="qty" class="form-control" value="<?php echo e(old('qty', $store->qty)); ?>" moco-validation/>
                                        <div class="moco-error-small danger-darker-hover" id="qtyError"></div>
                                    </div>
                                </div>
                                <!-- Location -->
                                <div class="col-4">
                                    <div class="d-flex flex-column">
                                        <div><?php echo e(__('Location')); ?></div>
                                        <div>
                                            <select id="location_id" name="location_id" class="selectpicker form-control" data-width="fit" title="<?php echo e(__('Select a Location')); ?>" moco-validation>
                                                <?php $__currentLoopData = App\Models\Location::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($location->id); ?>" <?php if(old('location_id',$store->location_id) == $location->id): ?> selected <?php endif; ?>><?php echo e(__($location->location)." : ".__($location->description)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="moco-error-small danger-darker-hover" id="location_idError"></div>
                                        </div>
                                    </div>
                                </div>
                        <?php endif; ?>
                        <!-- Price -->
                        <div class="col-2">
                            <div class="form-group">
                                <label for="price"><?php echo e(__('Price')); ?></label>
                                <input type="text" id="price" name="price" class="form-control"
                                       value="<?php echo e(old('price', $catalog->price)); ?>" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="priceError"></div>
                            </div>
                        </div>
                        <!-- Year -->
                        <div class="col-2">
                            <div class="form-group">
                                <label for="year"><?php echo e(__('Year')); ?></label>
                                <input type="number" id="year" name="year" class="form-control"
                                       value="<?php echo e(old('year', $catalog->year)); ?>" readonly="readonly" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="yearError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <!-- Provider -->
                            <div class="form-group">
                                <label for="provider"><?php echo e(__('Provider')); ?> <a href="#" id="add_provider"><i class="fas fa-plus-square green-darker-hover"></i></a></label> </label>
                                <?php if($partmetadata->id != null): ?>
                                    <input type="text" id="provider" name="provider" class="form-control mt-2"
                                           value="<?php echo e(\App\Models\Provider::find($catalog->provider_id)->name); ?>"
                                           readonly="readonly" moco-validation />
                                <?php else: ?>
                                    <select id="provider" name="provider" class="selectpicker form-control" <?php if($partmetadata->id != null): ?> disabled <?php endif; ?> data-live-search="true" title="<?php echo e(__('Select a provider')); ?>" moco-validation>
                                        <?php $__currentLoopData = $_providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($_provider->id); ?>" <?php if($_provider->id == old('provider', $catalog->provider_id)): ?> selected <?php endif; ?>><?php echo e($_provider->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php endif; ?>
                                <div class="moco-error-small danger-darker-hover" id="providerError"></div>
                            </div>
                        </div>


                        <div class="col-2">
                            <!-- Enabled -->
                            <div class="form-group">
                                <label for="enabled"><?php echo e(__('Enabled')); ?></label>
                                <select id="enabled" name="enabled" class="selectpicker form-control" data-width="fit" moco-validation>
                                    <option value="1"
                                            <?php if(old('enabled',$partmetadata->enabled) == 1): ?> selected <?php endif; ?>><?php echo e(__('Yes')); ?></option>
                                    <option value="0"
                                            <?php if(old('enabled',$partmetadata->enabled) == 0): ?> selected <?php endif; ?>><?php echo e(__('No')); ?></option>
                                </select>
                                <div class="moco-error-small danger-darker-hover" id="enabledError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                        <div>
                            <a href="<?php echo e(route('store.index')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal message-->
    <div class="modal" id="modal_msg" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> <?php echo e(__('Enter new provider')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <input type="text" id="new_provider" class="form-control"/>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-md-between">
                            <div><button type="button" class="btn btn-primary" data-dismiss="modal" id="validate"><?php echo e(__('Validate')); ?></button></div>
                            <div><button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.ajax.validation.js')); ?>"></script>
    <script type="text/javascript">
        $(function (){
            var previousVal = '';
            $('#part_number').on('keyup',function () {
                if($('#bar_code').val() == previousVal){
                    previousVal = $('#part_number').val();
                    $('#bar_code').val(previousVal);
                }
            })
            $('#part-form').on('keypress', function (event) {
                var keyPressed = event.keyCode || event.which;
                if (keyPressed === 13) {
                    event.preventDefault();
                    return false;
                }
            })
            /** ouvre la fenetre modal pour ajouter un fournisseur **/
            $('#add_provider').on('click',() => {
                $('#modal_msg').modal('show');
            });
            /** action sur la validation du nouveau fournisseur **/
            $('#validate').on('click', () => {
                let value = $('#new_provider').val();
                if (value != ''){
                    /** on supprime la selection **/
                    $('#provider').selectpicker('deselectAll');
                    /** on retire le précédent nouveau fournisseur s'il existe **/
                    $('#provider').find('[value=0]').remove();
                    /** on crée une option avec le nom du nouveau fournisseur **/
                    $('#provider').append('<option value="0">'+value+'</option>');
                    /** on le selectionne **/
                    $('#provider').val(0);
                    /** on rafraichi le layout du select **/
                    $('#provider').selectpicker('refresh');
                    /** on charge le champ caché avec le nouveau nom du founisseur **/
                    $('#new_provider_name').val(value);
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/store-part-form.blade.php ENDPATH**/ ?>