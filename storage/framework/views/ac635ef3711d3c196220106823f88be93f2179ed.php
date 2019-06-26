<?php $__env->startComponent('mail::message'); ?>
#### Dear <?php echo e(ucwords(strtolower($user->name))); ?>,

We have received your shipment and below is your clearance proforma invoice.


<?php echo $__env->make('emails.invoice.invoice-partial', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
