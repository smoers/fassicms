<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Add customer')); ?></h2>
            </div>
            <div class="card-body">
                <form name="customer-form" id="customer-form" method="post" action="<?php echo e(route('customer.store')); ?>" moco-validation>
                    <?php echo csrf_field(); ?>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name"><?php echo e(__('Company name')); ?></label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name')); ?>" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="nameError"></div>
                    </div>

                    <!-- address -->
                    <div class="form-group">
                        <label for="address"><?php echo e(__('Address')); ?></label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo e(old('address')); ?>" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="addressError"></div>
                    </div>

                    <!-- address optional-->
                    <div class="form-group">
                        <label for="address_optional"><?php echo e(__('Address (optional)')); ?></label>
                        <input type="text" id="address_optional" name="address_optional" class="form-control" value="<?php echo e(old('address_optional')); ?>" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="address_optionalError"></div>
                    </div>

                    <div class="row">
                        <!--Zipcode -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="zipcode"><?php echo e(__('Zipcode')); ?> <a href="#" id="flipflap"><i class="fas fa-ellipsis-h" style="color: #00aa00 !important;"></i></a> </label>
                                <select id="_zipcode" class="selectpicker with-ajax form-control" data-live-search="true" data-abs-lang-code="fr"></select>
                                <input type="text" id="zipcode" name="zipcode" class="form-control mt-2" value="<?php echo e(old('zipcode')); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="zipcodeError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- City-->
                            <div class="form-group">
                                <label for="city"><?php echo e(__('City')); ?></label>
                                <input type="text" id="city" name="city" class="form-control mt-2" value="<?php echo e(old('city')); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="cityError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- address Country-->
                            <div class="form-group">
                                <label for="country"><?php echo e(__('Country')); ?></label>
                                <input type="text" id="country" name="country" class="form-control mt-2" value="<?php echo e(old('country')); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="countryError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- email -->
                    <div class="form-group">
                        <label for="mail"><?php echo e(__('Email address')); ?></label>
                        <input type="text" id="mail" name="mail" class="form-control" value="<?php echo e(old('mail')); ?>" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="emailError"></div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <!-- phone -->
                            <div class="form-group">
                                <label for="phone"><?php echo e(__('Phone')); ?></label>
                                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="phoneError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- mobile -->
                            <div class="form-group">
                                <label for="mobile"><?php echo e(__('Mobile')); ?></label>
                                <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo e(old('mobile')); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="mobileError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- vat -->
                            <div class="form-group">
                                <label for="vat"><?php echo e(__('VAT')); ?></label>
                                <input type="text" id="vat" name="vat" class="form-control" value="<?php echo e(old('vat')); ?>" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="vatError"></div>
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
    <script type="text/javascript" src="<?php echo e(asset('js/moco.ajax.validation.js')); ?>"></script>
    <script type="text/javascript">
        $(function (){
            $('#zipcode').hide();
        })
        var zipcode = [];
        var options = {

            ajax          : {
                url     : '<?php echo e(route('customer.ajaxselect')); ?>',
                type    : 'POST',
                dataType: 'json',
                data    :  function () {
                    var params = {
                        zipcode:  $('#_zipcode').data().selectpicker.$searchbox.val()
                    };
                    return params;
                }
            },
            locale        : {
                currentlySelected: "<?php echo e(__('Currently selected')); ?>",
                emptyTitle: "<?php echo e(__('Select and Begin Typing')); ?>",
                errorText: "<?php echo e(__('Unable to retrieve results')); ?>",
                searchPlaceholder: "<?php echo e(__('Search...')); ?>",
                statusInitialized: "<?php echo e(__('Start typing a search query')); ?>",
                statusNoResults: "<?php echo e(__('No Results')); ?>",
                statusSearching:"<?php echo e(__('Searching...')); ?>",
                statusTooShort: "<?php echo e(__('Please enter more characters')); ?>",
            },
            log           : 3,
            preprocessData: function (data) {
                zipcode = [];
                $.each(data, function (key, obj){
                   zipcode.push(
                       {
                           'value': obj.id,
                           'text': obj.zipcode,
                           'data': {
                               'subtext': obj.locality,
                           },
                           'disabled': false,
                       }
                   );
                });
                console.log(zipcode);
                return zipcode;
            }
        };
        $('#_zipcode').selectpicker().ajaxSelectPicker(options);
        $('select').trigger('change');
        //mise à jour du champ City
        $('#_zipcode').on('change',function(event){
            let selected = $('#_zipcode').val();
            let obj = null;
            if(selected != "") {
                obj = zipcode.find(function (o, index) {
                    if (o.value == selected)
                        return true;
                });
            }
            if(obj != null) {
                $('#city').val(obj.data.subtext);
                $('#zipcode').val(obj.text);
            }
        })

        //flipflap
        $('#flipflap').on('click', function (){
            if($('#_zipcode').parent().is(":visible")){
                $('#_zipcode').parent().hide();
                $('#zipcode').show();
            } else {
                $('#_zipcode').parent().show();
                $('#zipcode').hide();
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/customer/customer-form.blade.php ENDPATH**/ ?>