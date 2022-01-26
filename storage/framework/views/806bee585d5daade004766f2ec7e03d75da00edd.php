<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artisan ~ <?php echo e($name = config('app.name', 'Laravel')); ?></title>

    <?php echo $__env->make('gui::partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>
<body class="bg-gray-100 font-mono">

    <div id="app">
        <app home="<?php echo e(url(config('artisan-gui.home', '/'))); ?>" endpoint="<?php echo e(route('gui.index')); ?>" />
    </div>

    <?php echo $__env->make('gui::partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH /var/www/moco/fassicms/vendor/infureal/artisan-gui/resources/views/index.blade.php ENDPATH**/ ?>