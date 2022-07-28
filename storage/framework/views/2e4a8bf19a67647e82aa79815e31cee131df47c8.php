<?php $__env->startSection('title',' Notification Deatils'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-xl-9 col-lg-8  col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-body">
                    <p class="font-weight-bold">Subject :<span class="font-weight-normal"><?php echo e($leave['leave_type']); ?></span></p>
                    <p class="font-weight-bold">To :<span class="font-weight-normal"> nikita@besthawk.com,vaidehi@besthawk.com</span></p>
                    <p class="font-weight-bold pb-3">From :<span class="font-weight-normal"> <?php echo e($leave['employee']['email']); ?></span></p>
                    <p class="font-weight-bold pb-2">Reason :<span class="font-weight-normal"> <?php echo e($leave['leave_reason']); ?></p>
                    <p class="font-weight-bold">Leave Date :<span class="font-weight-normal"> <?php echo e(date('d/m/y',strtotime($leave['from_date']))); ?> - <?php echo e(date('d/m/y',strtotime($leave['to_date']))); ?> </span></p>
                    <p class="font-weight-bold pb-3">Leave Day :<span class="font-weight-normal"><?php echo e($leave['leave_day']); ?></span></p>
                    <p class="font-weight-bold">Your Sincerly</p>
                    <p class="font-weight-bold"><span class="font-weight-normal"><?php echo e($leave['employee']['name']); ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/notification_details.blade.php ENDPATH**/ ?>