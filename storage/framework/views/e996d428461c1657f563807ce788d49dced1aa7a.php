
<?php $__env->startSection('title',' Notifications'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-xl-9 col-lg-8  col-md-12">
    <div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white p-4 mb-4 card">
        <h4 class="card-title float-left mb-0 mt-2">Notifications</h4>
    </div>
    <?php if(!empty($notification)): ?>
    <div class="row">
        <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12">
            <div class="<?php echo e(!in_array($emp_id,json_decode($val->seen_by))?'card':''); ?> ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-body">
                    <p><?php echo e($val->content); ?>. <a href="<?php echo e(url('notification_details/'.$val->type)); ?>">Read More....</a></p>
                    <span class="text-danger" style="font-size:10px;"> 
                        <?php echo e(date('d/m/y',strtotime($val->created_at))); ?>

                        ( <?php echo e(date('l',strtotime($val->created_at))); ?> ) - 
                        <?php echo e(date('h:s A',strtotime($val->created_at))); ?>

                    </span>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php echo e($notification->links()); ?>

    <?php else: ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-body">
                    <p>There is no notifications</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/notification.blade.php ENDPATH**/ ?>