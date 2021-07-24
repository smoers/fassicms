<div class="d-flex flex-column" id="addcard">
    <!-- s'il y a un Old Helper on affiche le contenu du old -->
    <?php if(old("contacts") === null): ?>
        <?php $__currentLoopData = $customer->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border rounded p-3 mb-2" id="delete">
                <input type="hidden" name="contacts[id][]" value="<?php echo e($contact->id); ?>">
                <div class="d-flex">
                    <div class="row w-100">
                        <!-- Firstname -->
                        <div class="form-group col-6">
                            <label for="firstname"><?php echo e(__('Firstname')); ?></label>
                            <input type="text" class="form-control form-control-sm" name="contacts[firstname][]" id="firstname" value="<?php echo e($contact->firstname); ?>" autocomplete="off" moco-validation-array="contacts"/>
                        </div>
                        <!-- Lastname -->
                        <div class="form-group col-6">
                            <label for="lastname"><?php echo e(__('Lastname')); ?></label>
                            <input type="text" class="form-control form-control-sm" name="contacts[lastname][]" id="lastname" value="<?php echo e($contact->lastname); ?>" autocomplete="off" moco-validation-array="contacts"/>
                        </div>

                    </div>
                    <div><a href="#" id="remove"><i class="fas fa-trash-alt text-danger ml-2"></i></a></div>
                </div>
                <div class="row">
                    <!-- Function -->
                    <div class="form-group col-4">
                        <label for="function"><?php echo e(__('Function')); ?></label>
                        <input type="text" class="form-control form-control-sm" name="contacts[function][]" id="function" value="<?php echo e($contact->function); ?>" autocomplete="off" moco-validation-array="contacts"/>
                    </div>
                    <!-- Phone -->
                    <div class="form-group col-4">
                        <label for="cphone"><?php echo e(__('Phone')); ?></label>
                        <input type="text" class="form-control form-control-sm" name="contacts[phone][]" id="phone" value="<?php echo e($contact->phone); ?>" autocomplete="off" moco-validation-array="contacts"/>
                    </div>
                    <!-- Mobile -->
                    <div class="form-group col-4">
                        <label for="cmobile"><?php echo e(__('Mobile')); ?></label>
                        <input type="text" class="form-control form-control-sm" name="contacts[mobile][]" id="mobile" value="<?php echo e($contact->mobile); ?>" autocomplete="off" moco-validation-array="contacts"/>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <?php for($index = 0; $index < count(old('contacts')['id']); $index++): ?>
            <div class="border rounded p-3 mb-2" id="delete">
                <input type="hidden" name="contacts[id][]" value="<?php echo e(old('contacts')['id'][$index]); ?>">
                <div class="d-flex">
                    <div class="row w-100">
                        <!-- Firstname -->
                        <div class="form-group col-6">
                            <label for="firstname"><?php echo e(__('Firstname')); ?></label>
                            <input type="text" class="form-control form-control-sm" name="contacts[firstname][]" id="firstname" value="<?php echo e(old('contacts')['firstname'][$index]); ?>" autocomplete="off" moco-validation-array="contacts"/>
                        </div>
                        <!-- Lastname -->
                        <div class="form-group col-6">
                            <label for="lastname"><?php echo e(__('Lastname')); ?></label>
                            <input type="text" class="form-control form-control-sm" name="contacts[lastname][]" id="lastname" value="<?php echo e(old('contacts')['lastname'][$index]); ?>" autocomplete="off" moco-validation-array="contacts"/>
                        </div>

                    </div>
                    <div><a href="#" id="remove"><i class="fas fa-trash-alt text-danger ml-2"></i></a></div>
                </div>
                <div class="row">
                    <!-- Function -->
                    <div class="form-group col-4">
                        <label for="function"><?php echo e(__('Function')); ?></label>
                        <input type="text" class="form-control form-control-sm" name="contacts[function][]" id="function" value="<?php echo e(old('contacts')['function'][$index]); ?>" autocomplete="off" moco-validation-array="contacts"/>
                    </div>
                    <!-- Phone -->
                    <div class="form-group col-4">
                        <label for="cphone"><?php echo e(__('Phone')); ?></label>
                        <input type="text" class="form-control form-control-sm" name="contacts[phone][]" id="phone" value="<?php echo e(old('contacts')['phone'][$index]); ?>" autocomplete="off" moco-validation-array="contacts"/>
                    </div>
                    <!-- Mobile -->
                    <div class="form-group col-4">
                        <label for="cmobile"><?php echo e(__('Mobile')); ?></label>
                        <input type="text" class="form-control form-control-sm" name="contacts[mobile][]" id="mobile" value="<?php echo e(old('contacts')['mobile'][$index]); ?>" autocomplete="off" moco-validation-array="contacts"/>
                    </div>
                </div>
            </div>

        <?php endfor; ?>
    <?php endif; ?>
</div>
<a href="#" class="btn btn-success moco-btn-sm" id="addcontact"><?php echo e(__('Add contact')); ?></a>

<script id="template" type="text/html">
    <div class="border rounded p-3 mb-2" id="delete">
        <input type="hidden" name="contacts[id][]" value="">
        <div class="d-flex">
            <div class="row w-100">
                <!-- Firstname -->
                <div class="form-group col-6">
                    <label for="firstname"><?php echo e(__('Firstname')); ?></label>
                    <input type="text" class="form-control form-control-sm" name="contacts[firstname][]" id="firstname_{{ uid }}" value="" autocomplete="off" moco-validation-array="contacts.firstname"/>
                </div>
                <!-- Lastname -->
                <div class="form-group col-6">
                    <label for="lastname"><?php echo e(__('Lastname')); ?></label>
                    <input type="text" class="form-control form-control-sm" name="contacts[lastname][]" id="lastname_{{ uid }}" value="" autocomplete="off" moco-validation-array="contacts.lastname"/>
                </div>

            </div>
            <div><a href="#" id="remove"><i class="fas fa-trash-alt text-danger ml-2"></i></a></div>
        </div>
        <div class="row">
            <!-- Function -->
            <div class="form-group col-4">
                <label for="function"><?php echo e(__('Function')); ?></label>
                <input type="text" class="form-control form-control-sm" name="contacts[function][]" id="function_{{ uid }}" value="" autocomplete="off" moco-validation-array="contacts.function"/>
            </div>
            <!-- Phone -->
            <div class="form-group col-4">
                <label for="cphone"><?php echo e(__('Phone')); ?></label>
                <input type="text" class="form-control form-control-sm" name="contacts[phone][]" id="phone_{{ uid }}" value="" autocomplete="off" moco-validation-array="contacts.phone"/>
            </div>
            <!-- Mobile -->
            <div class="form-group col-4">
                <label for="cmobile"><?php echo e(__('Mobile')); ?></label>
                <input type="text" class="form-control form-control-sm" name="contacts[mobile][]" id="mobile_{{ uid }}" value="" autocomplete="off" moco-validation-array="contacts.mobile"/>
            </div>
        </div>
    </div>
</script>

<script type="text/javascript">
    $(function (){
        /** event sur le bouton ajouter un contact **/
        $('#addcontact').on('click',() => {
            let uid = $.random();
            console.log(uid);
            let data = {uid: uid};
            let source = $('#template').html()
            let template = Handlebars.compile(source);
            $('#addcard').append(template(data));
        });
        /** event sur le bouton remove **/
        $(document).on('click','#remove',function () {
            $(this).closest('#delete').remove();
        });

        $(document).on('keyup','#firstname',function() {
            let selector = $.escapeSelector("contacts.firstname");
            $('[firstname]').each(function(index) { console.log($(this).val());});
        })
    });
</script>
<?php /**PATH /var/www/moco/fassicms/resources/views/customer/customer-contact-form.blade.php ENDPATH**/ ?>