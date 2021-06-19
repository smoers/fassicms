<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height" style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e($title); ?></h2>
            </div>
            <div class="card-body">
                <form name="worksheet-form" id="worksheet-form" method="post" action="<?php echo e($action); ?>" moco-validation>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-4">
                        <!-- Date -->
                        <div class="form-group">
                            <label for="date"><?php echo e(__('Date')); ?></label>
                            <div class="input-group mb-3">
                                <input type="text" id="date" name="date" class="form-control mt-2" placeholder="<?php echo e(__('DD/MM/YYYY')); ?>" aria-label="date" aria-describedby="basic-addon1" value="<?php echo e(old('date', $worksheet->date)); ?>" moco-validation/>
                                <div class="input-group-prepend">
                                    <span class="input-group-text mt-2" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                </div>
                            </div>
                            <div class="moco-error-small danger-darker-hover" id="dateError"></div>
                        </div>
                        </div>
                        <div class="col-4">
                        <!-- Number -->
                        <div class="form-group">
                            <label for="number"><?php echo e(__('Number')); ?></label>
                            <input type="text" id="number" name="number" class="form-control mt-2" readonly value="<?php echo e(old('number', $worksheet->number)); ?>" moco-validation/>
                        </div>
                        </div>
                        <div class="col-2">
                        <!-- Warranty -->
                        <div class="form-group">
                            <label for="warranty"><?php echo e(__('Warranty')); ?></label>
                            <select id="warranty" name="warranty" class="selectpicker form-control" data-width="fit" moco-validation>
                                <option value="1"
                                        <?php if(old('enabled',$worksheet->warranty) == 1): ?> selected <?php endif; ?>><?php echo e(__('Yes')); ?></option>
                                <option value="0"
                                        <?php if(old('enabled',$worksheet->warranty) == 0): ?> selected <?php endif; ?>><?php echo e(__('No')); ?></option>
                            </select>
                            <div class="moco-error-small danger-darker-hover" id="warrantyError"></div>
                        </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#general" class="nav-link active" data-toggle="tab"><?php echo e(__('General data')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="#data" class="nav-link" data-toggle="tab"><?php echo e(__('Data')); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <!-- TAB GENERAL-->
                            <div class="tab-pane fade show active" id="general">
                                <div class="row">

                                    <!-- Crane selector -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="crane_id"><?php echo e(__('Crane')); ?> <a href="#" id="add_crane"><i class="fas fa-truck-moving" style="color: red !important;"></i></a> </label>
                                            <select id="crane_id" class="selectpicker with-ajax form-control" name="crane_id" data-live-search="true" data-abs-lang-code="fr">
                                                <?php if($info_fields['crane_id'] != null): ?><option selected value="<?php echo e($info_fields['crane_id']); ?>"><?php echo e($info_fields['serial']); ?></option><?php endif; ?>
                                            </select>
                                            <div class="moco-error-small danger-darker-hover" id="crane_idError"></div>
                                        </div>
                                    </div>

                                    <!-- Customer selector -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="customer_id"><?php echo e(__('Customer')); ?> <a href="#" id="add_customer"><i class="fas fa-address-card" style="color: red !important;"></i></a> </label>
                                            <select id="customer_id" class="selectpicker with-ajax form-control" name="customer_id" data-live-search="true" data-abs-lang-code="fr">
                                                <?php if($info_fields['customer_id'] != null): ?><option selected value="<?php echo e($info_fields['customer_id']); ?>"><?php echo e($info_fields['name']); ?></option><?php endif; ?>
                                            </select>
                                            <div class="moco-error-small danger-darker-hover" id="customer_idError"></div>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">

                                    <!-- Serial -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="serial"><?php echo e(__('Serial number')); ?></label>
                                            <input type="text" id="serial" name="serial" class="form-control" readonly value="<?php echo e(old('serial', $info_fields['serial'])); ?>">
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="name"><?php echo e(__('Company name')); ?></label>
                                            <input type="text" id="name" name="name" class="form-control" readonly value="<?php echo e(old('name', $info_fields['name'])); ?>">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <!-- Model -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="model"><?php echo e(__('Model')); ?></label>
                                            <input type="text" id="model" name="model" class="form-control" readonly value="<?php echo e(old('model', $info_fields['model'])); ?>">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="address"><?php echo e(__('Address')); ?></label>
                                            <input type="text" id="address" name="address" class="form-control" readonly value="<?php echo e(old('address', $info_fields['address'])); ?>">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <!-- Plate -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="plate"><?php echo e(__('Numberplate')); ?></label>
                                            <input type="text" id="plate" name="plate" class="form-control" readonly value="<?php echo e(old('plate', $info_fields['plate'])); ?>">
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="phone"><?php echo e(__('Phone')); ?></label>
                                            <input type="text" id="phone" name="phone" class="form-control" readonly value="<?php echo e(old('phone', $info_fields['phone'])); ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!-- Nothing -->
                                    <div class="col-4">

                                    </div>

                                    <!-- Email -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="mail"><?php echo e(__('Email address')); ?></label>
                                            <input type="text" id="mail" name="mail" class="form-control" readonly value="<?php echo e(old('mail', $info_fields['mail'])); ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!-- Nothing -->
                                    <div class="col-4">

                                    </div>

                                    <!-- VAT -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="vat"><?php echo e(__('VAT')); ?></label>
                                            <input type="text" id="vat" name="vat" class="form-control" readonly value="<?php echo e(old('vat', $info_fields['vat'])); ?>">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- TAB DATA -->

                            <div class="tab-pane fade" id="data">

                                <!-- Remarks -->
                                <div class="form-group">
                                    <label for="remarks"><?php echo e(__('Customer remarks')); ?></label>
                                    <textarea id="remarks" name="remarks" rows="5" autocomplete="off" class="form-control"><?php echo e(old('remarks', $worksheet->remarks)); ?></textarea>
                                </div>

                                <!-- Work -->
                                <div class="form-group">
                                    <label for="work"><?php echo e(__('Work done')); ?></label>
                                    <textarea id="work" name="work" rows="5" autocomplete="off" class="form-control"><?php echo e(old('work', $worksheet->work)); ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-4">

                                        <!-- Oil replace -->
                                        <div class="form-group">
                                            <label for="oil_replace"><?php echo e(__('Oil replaced (liter)')); ?></label>
                                            <input type="text" id="oil_replace" name="oil_replace" class="form-control mt-2" value="<?php echo e(old('oil_replace', $worksheet->oil_replace)); ?>" moco-validation >
                                            <div class="moco-error-small danger-darker-hover" id="oil_replaceError"></div>
                                        </div>
                                    </div>
                                    <div class="col-2">

                                        <!-- Oil filtered -->
                                        <div class="form-group">
                                            <label for="oil_filtered"><?php echo e(__('Oil filtered')); ?></label>
                                            <select id="oil_filtered" name="oil_filtered" class="selectpicker form-control" data-width="fit" moco-validation>
                                                <option value="1"
                                                        <?php if(old('enabled',$worksheet->oil_filtered) == 1): ?> selected <?php endif; ?>><?php echo e(__('Yes')); ?></option>
                                                <option value="0"
                                                        <?php if(old('enabled',$worksheet->oil_filtered) == 0): ?> selected <?php endif; ?>><?php echo e(__('No')); ?></option>
                                            </select>
                                            <div class="moco-error-small danger-darker-hover" id="oil_filteredError"></div>
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
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.fr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.nl-BE.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.ajax.validation.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.selectpicker.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.redirect.js')); ?>"></script>

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

            $('#date').datepicker({
                format: 'dd/mm/yyyy',
                orientation: 'bottom auto',
                language: 'fr',
                todayBtn: "linked",
                autoclose: true,
            });

            /*
            * definition de l'objet selectPickerOptions pour les cranes
             */
            var optionsCrane = jQuery.extend(true,{},selectPickerOtions);
            optionsCrane.whatIs = 'crane';
            optionsCrane.ajax.url = '<?php echo e(route('worksheet.ajaxselect')); ?>';
            optionsCrane.ajax.data = function () {
                var params = {
                    whatIs: 'crane',
                    serial:  $('#crane_id').data().selectpicker.$searchbox.val()
                };
                return params;
            };
            optionsCrane.language('fr');
            optionsCrane.select = function(obj){
                return {
                    'value': obj.id,
                    'text': obj.serial,
                    'data': {
                        'subtext': obj.model+', '+obj.plate,
                    },
                    'disabled': false,
                }
            }

            /*
            * definition de l'objet selectPickerOptions pour les customers
             */
            var optionsCustomer = jQuery.extend(true,{},selectPickerOtions);
            optionsCustomer.whatIs = 'customer';
            optionsCustomer.ajax.url = '<?php echo e(route('worksheet.ajaxselect')); ?>';
            optionsCustomer.ajax.data = function () {
                var params = {
                    whatIs: 'customer',
                    name:  $('#customer_id').data().selectpicker.$searchbox.val()
                };
                return params;
            };
            optionsCustomer.language('fr');
            optionsCustomer.select = function(obj){
                return {
                    'value': obj.id,
                    'text': obj.name,
                    'data': {
                        'subtext': obj.city,
                    },
                    'disabled': false,
                }
            }

            /**
             * configuration du selectpicker customers
             */
            $('#customer_id').selectpicker().ajaxSelectPicker(optionsCustomer);
            /**
             * configuration du selectpicker cranes
             */
            $('#crane_id').selectpicker().ajaxSelectPicker(optionsCrane);
            $('select').trigger('change');

            /**
             * Charge les champs du formulaire avec les valeurs du client
             */
            $('#customer_id').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                _id = $(this).selectpicker().val()
                _array = $(this).selectpicker().data('AjaxBootstrapSelect').options._data;
                if (_array.length > 0 && _id != null) {
                    _obj = _array.find(_obj => _obj.id === parseInt(_id));
                    $('#name').val(_obj.name);
                    $('#address').val(_obj.address + ', ' + _obj.zipcode + ' ' + _obj.city);
                    $('#mail').val(_obj.mail);
                    $('#phone').val(_obj.phone);
                    $('#vat').val(_obj.vat);
                }
            });

            /**
             * Charge le formulaire avec les valeurs de la grue
             */
            $('#crane_id').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                _id = $(this).selectpicker().val()
                _array = $(this).selectpicker().data('AjaxBootstrapSelect').options._data;
                if (_array.length > 0 && _id != null) {
                    _obj = _array.find(_obj => _obj.id === parseInt(_id));
                    $('#serial').val(_obj.serial);
                    $('#model').val(_obj.model);
                    $('#plate').val(_obj.plate);
                }
            });

            /**
             * Ouvre le formulaire permettant d'ajouter une grue/ un client
             * et permet de sauvegarder les valeurs du formulaire
             */
            $('#add_crane,#add_customer').on('click', function (event) {
                var data = $.redirect.data(fields);
                data['_token'] = $('meta[name="csrf-token"]').attr('content');
                data['whatIs'] = (this.id);
                $.redirect({
                    url : '<?php echo e(route('worksheet.add.option')); ?>',
                    method : 'post',
                    data : data,
                });
            })


        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/worksheet-form.blade.php ENDPATH**/ ?>