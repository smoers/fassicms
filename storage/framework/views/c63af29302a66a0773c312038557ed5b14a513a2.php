    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark position-sticky fixed-top " style="z-index:9999">
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>"><img src="<?php echo e(asset('./images/logo.png')); ?>"></a>
        <!-- Navbar-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if( Route::is('dashboard')): ?> active <?php endif; ?>">
                    <a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?> <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown  <?php if( Route::is('crane.*')): ?> active <?php endif; ?>">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><?php echo e(__('Company data')); ?></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"> <?php echo e(__('Customers')); ?>   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href=""><?php echo e(__('List')); ?></a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('customer.create')); ?>"><?php echo e(__('Add')); ?></a></li>
                                <li><a class="dropdown-item" href=""><?php echo e(__('Modify')); ?></a></li>
                                <li><a class="dropdown-item" href=""><?php echo e(__('Remove')); ?></a></li>
                            </ul>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="#"> <?php echo e(__('Cranes')); ?>   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href=""><?php echo e(__('List')); ?></a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('crane.create')); ?>"><?php echo e(__('Add')); ?></a></li>
                                <li><a class="dropdown-item" href=""><?php echo e(__('Modify')); ?></a></li>
                                <li><a class="dropdown-item" href=""><?php echo e(__('Remove')); ?></a></li>
                            </ul>

                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('Worksheet')); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><?php echo e(__('List')); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('worksheet.create')); ?>"><?php echo e(__('Add')); ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Item 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if( Route::is('store.*')): ?> active <?php endif; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('Stocks')); ?>

                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('store.index')); ?>"><?php echo e(__('Catalog')); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('store.create')); ?>"><?php echo e(__('Add a part to the catalog')); ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo e(route('reassort.index')); ?>"><?php echo e(__('Movement of stock')); ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo e(route('outworksheet.index')); ?>"><?php echo e(__('Out on worksheet')); ?></a>
                    </div>
                </li>

            </ul>
            <div class="navbar-nav ml-auto ml-md-0 text-white-50"><?php echo e(Auth()->user()->firstname); ?> <?php echo e(Auth()->user()->lastname); ?></div>

            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#"><?php echo e(__('Settings')); ?></a>
                        <div class="dropdown-divider"></div>
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