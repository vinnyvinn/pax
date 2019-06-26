<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('css'); ?>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body>
    <div id="app">
        <loader v-if="isLoading"></loader>
        <?php echo $__env->make('layouts.partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <?php if(session('flash_message')): ?>
    <script>
        toastr.options.closeButton = true;
        toastr['<?php echo e(session('flash_status')); ?>']('<?php echo e(session('flash_message')); ?>')
    </script>
    <?php endif; ?>

    <?php if(session('print_file')): ?>
        <script>
            window.open('<?php echo e(session('print_file')); ?>');
        </script>
    <?php endif; ?>
    <?php echo $__env->yieldContent('footer'); ?>

</body>
</html>
