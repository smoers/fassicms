<!--
Company : Fassi Belgium
Developed : MO-Consult
Authority : Moers Serge
Date : 27-10-20
-->

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" <?php if(! \Illuminate\Support\Facades\Auth::check()): ?> class="moco-background" <?php endif; ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>Fassi Belgium CMS</title>
        <link href="<?php echo e(asset('/images/favicon.ico')); ?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <!-- Bootstrap-Select -->
        <link href="<?php echo e(asset('3rd/bootstrap-select-1.13.18/css/bootstrap-select.min.css')); ?>" rel="stylesheet">
        <!-- Ajax Bootstrap Select-->
        <link href="<?php echo e(asset('3rd/Ajax-Bootstrap-Select-1.4.5/dist/css/ajax-bootstrap-select.min.css')); ?>" rel="stylesheet">
        <!-- CSS MOCO -->
        <link href="<?php echo e(asset('css/all.css')); ?>" rel="stylesheet">

        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
        <!-- Bootstrap-Select -->
        <script type="text/javascript" src="<?php echo e(asset('3rd/bootstrap-select-1.13.18/js/bootstrap-select.min.js')); ?>"></script>
        <!-- Ajax Bootstrap Select -->
        <script type="text/javascript" src="<?php echo e(asset('3rd/Ajax-Bootstrap-Select-1.4.5/dist/js/ajax-bootstrap-select.min.js')); ?>"></script>
        <!-- Livewire -->
        <?php echo \Livewire\Livewire::styles(); ?>




    </head>
    <body>
    <!-- affichez uniquement si l'utilisateur est authentifié -->
    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
        <?php echo $__env->make('menus.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="container-fluid">
        <?php echo $__env->make('root.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- affichez uniquement si l'utilisateur est authentifié -->
    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
    <div class="d-flex justify-content-center">
        <div>Developed by MO Consult <i class="fas fa-copyright"></i> <?php echo e(date('yy')); ?></div>
    </div>
    <?php endif; ?>
    <?php echo \Livewire\Livewire::scripts(); ?>

    </body>
</html>
<?php /**PATH /var/www/moco/fassicms/resources/views/layouts/layout.blade.php ENDPATH**/ ?>