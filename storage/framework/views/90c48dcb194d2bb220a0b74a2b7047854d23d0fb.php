<!--
Company : Fassi Belgium
Developed : MO-Consult
Authority : Moers Serge
Date : 27-10-20
-->

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" <?php if(! \Illuminate\Support\Facades\Auth::check()): ?> class="fassi-background" <?php endif; ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fassi Belgium CMS</title>
        <link href="/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="<?php echo e(asset('3rd/fontawesome-free-5.15.1-web/css/all.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/all.css')); ?>" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito';
            }

        </style>

        <!-- Script -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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
<?php /**PATH /var/www/Moco/fassicms/resources/views/layouts/layout.blade.php ENDPATH**/ ?>
