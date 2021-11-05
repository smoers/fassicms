    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark position-sticky fixed-top " style="z-index:9999">
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>"><img src="<?php echo e(asset('./images/logo.png')); ?>"></a>
        <!-- Navbar-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if( Route::is('dashboard')): ?> active <?php endif; ?>">
                    <a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?> <span class="sr-only">(current)</span></a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['list customer','create customer','list crane','create crane','list technician','create technician'])): ?>
                <li class="nav-item dropdown  <?php if( Route::is('crane.*') || Route::is('customer.*') || Route::is('technician.*')): ?> active <?php endif; ?>">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><?php echo e(__('Company data')); ?></a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['list customer','create customer'])): ?>
                        <li><a class="dropdown-item" href="<?php echo e(route('customer.index')); ?>"> <?php echo e(__('Customers')); ?>   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list customer')): ?><li><a class="dropdown-item" href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('List')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create customer')): ?><li><a class="dropdown-item" href="<?php echo e(route('customer.create')); ?>"><?php echo e(__('Add')); ?></a></li><?php endif; ?>
                            </ul>
                        </li>
                        <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['list crane','create crane'])): ?>
                        <li><a class="dropdown-item" href="<?php echo e(route('crane.index')); ?>"> <?php echo e(__('Cranes')); ?>   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list crane')): ?><li><a class="dropdown-item" href="<?php echo e(route('crane.index')); ?>"><?php echo e(__('List')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create crane')): ?><li><a class="dropdown-item" href="<?php echo e(route('crane.create')); ?>"><?php echo e(__('Add')); ?></a></li><?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['list technician','create technician'])): ?>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="<?php echo e(route('technician.index')); ?>"> <?php echo e(__('Technicians')); ?>   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list technician')): ?><li><a class="dropdown-item" href="<?php echo e(route('technician.index')); ?>"><?php echo e(__('List')); ?></a></li><?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create technician')): ?><li><a class="dropdown-item" href="<?php echo e(route('technician.create')); ?>"><?php echo e(__('Add')); ?></a></li><?php endif; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list provider')): ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo e(route('provider.index')); ?>"><?php echo e(__('Providers')); ?></a>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['list worksheet','create worksheet','clocking worksheet'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('Worksheet')); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list worksheet')): ?><a class="dropdown-item" href="<?php echo e(route('worksheet.index')); ?>"><?php echo e(__('List')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create worksheet')): ?><a class="dropdown-item" href="<?php echo e(route('worksheet.create')); ?>"><?php echo e(__('Add')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create worksheet')): ?><a class="dropdown-item" href="<?php echo e(route('worksheet.template.create')); ?>"><?php echo e(__('Template creation')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clocking worksheet')): ?><div class="dropdown-divider"></div><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clocking technician')): ?><a class="dropdown-item" href="<?php echo e(route('clocking.technician')); ?>"><?php echo e(__('Technician clocking')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clocking correction')): ?><a class="dropdown-item" href="<?php echo e(route('clocking.correct')); ?>"><?php echo e(__('Technician clocking correction')); ?></a><?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['list catalog','create catalog','list stock','reassort worksheet stock','out worksheet stock'])): ?>
                <li class="nav-item dropdown <?php if( Route::is('store.*')): ?> active <?php endif; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('Stocks')); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list catalog')): ?><a class="dropdown-item" href="<?php echo e(route('store.index')); ?>"><?php echo e(__('Catalog')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create catalog')): ?><a class="dropdown-item" href="<?php echo e(route('store.create')); ?>"><?php echo e(__('Add a part to the catalog')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list stock')): ?><div class="dropdown-divider"></div><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('list stock')): ?><a class="dropdown-item" href="<?php echo e(route('reassort.index')); ?>"><?php echo e(__('Movement of stock')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['out worksheet stock','reassort worksheet stock'])): ?>
                        <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('out worksheet stock')): ?><a class="dropdown-item" href="<?php echo e(route('outworksheet.out')); ?>"><?php echo e(__('Out on worksheet')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reassort worksheet stock')): ?><a class="dropdown-item" href="<?php echo e(route('outworksheet.in')); ?>"><?php echo e(__('In on worksheet')); ?></a><?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>
                <li class="nav-item dropdown <?php if( Route::is('reporting.*')): ?> active <?php endif; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('Reporting')); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('reporting.from')); ?>"><?php echo e(__('From Partmetadatas')); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('reporting.from')); ?>"><?php echo e(__('From Worksheets')); ?></a>
                    </div>
                </li>
            </ul>
            <div class="navbar-nav ml-auto ml-md-0 text-white-50"><?php echo e(Auth()->user()->firstname); ?> <?php echo e(Auth()->user()->lastname); ?></div>

            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('password change')): ?><a class="dropdown-item" href="#" id="change_password"><?php echo e(__('Change Password')); ?></a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?><a class="dropdown-item" href="#"><?php echo e(__('Administration')); ?></a><?php endif; ?>
                            <a class="dropdown-item" href="https://mo-consult.myjetbrains.com/hub/auth/login?response_type=token&client_id=00c92140-2f38-435b-8aa2-d04f6c33f390&redirect_uri=https:%2F%2Fmo-consult.myjetbrains.com%2Fyoutrack%2Foauth&scope=00c92140-2f38-435b-8aa2-d04f6c33f390%20Upsource%20TeamCity%20YouTrack%2520Slack%2520Integration%200-0-0-0-0&state=2e3e4e9a-184d-4b12-b04a-8da173066702" target="_blank">Bug Tracker</a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admin','password change'])): ?><div class="dropdown-divider"></div><?php endif; ?>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


<?php /**PATH /var/www/moco/fassicms/resources/views/menus/navbar.blade.php ENDPATH**/ ?>