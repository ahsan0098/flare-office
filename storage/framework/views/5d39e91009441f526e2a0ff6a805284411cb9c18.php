 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>AdminLTE 3 | Log in</title>

     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>">
     <!-- icheck bootstrap -->
     <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
     <!-- Theme style -->
     <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/adminlte.min.css')); ?>">
     <?php echo \Livewire\Livewire::styles(); ?>

 </head>

 <body class="hold-transition login-page">

     <?php echo e($slot); ?>


     <!-- jQuery -->
     <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
     <!-- Bootstrap 4 -->
     <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
     <!-- AdminLTE App -->
     <script src="<?php echo e(asset('assets/dist/js/adminlte.min.js')); ?>"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="<?php echo e(asset('assets/functions.js')); ?>"></script>
     <?php echo \Livewire\Livewire::scripts(); ?>

 </body>

 </html>
<?php /**PATH C:\xampp\htdocs\flare-office\resources\views/layouts/login-base.blade.php ENDPATH**/ ?>