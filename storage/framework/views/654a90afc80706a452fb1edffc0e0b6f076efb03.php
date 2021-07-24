<!--
Company : Fassi Belgium
Developed : MO-Consult
Authority : Moers Serge
Date : 27-10-20
-->


<?php $__env->startSection('content'); ?>

    <div id="loginmodal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid w-100">
                        <div class="d-flex justify-content-between">
                            <div class="p-2"><img src="./images/logo.png"></div>
                            <div class="p-2">
                                <select id="lang" class="form-control-sm">
                                    <option value="en" <?php if($cookie == 'en'): ?> selected <?php endif; ?>>EN</option>
                                    <option value="fr" <?php if($cookie == 'fr'): ?> selected <?php endif; ?>>FR</option>
                                    <option value="nl" <?php if($cookie == 'nl'): ?> selected <?php endif; ?>>NL</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="p-2 blue-darker-hover" style="font-size: 34px; font-weight: bold; font-style: italic">Stock Management System</div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <!--
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>
                                <!--
                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                <?php endif; ?>
                                -->
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div>Developed by MO Consult <i class="fas fa-copyright"></i> <?php echo e(date('Y')); ?></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo e(asset('js/moco.redirect.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            /** Ouverture du formulaire de connexion en mode modal **/
            $('#loginmodal').modal('show');
            /** cookie pour la langue **/
            $('#lang').on('change',function(){
                let data = [];
                data['_token'] = $('meta[name="csrf-token"]').attr('content');
                data['lg'] = $('#lang').val();
                $.redirect({
                    url: '<?php echo e(route('login.setcookie')); ?>',
                    method: 'post',
                    data: data,
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/auth/login.blade.php ENDPATH**/ ?>