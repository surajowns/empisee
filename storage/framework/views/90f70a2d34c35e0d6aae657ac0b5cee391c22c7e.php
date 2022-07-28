<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
    $query->where('parent_id', 0)->get();
}])->where('emp_id', $id)->get()->toArray();

?>
<div class="sidebar-wrapper d-lg-block d-md-none d-none">
    <div class="card ctm-border-radius shadow-sm border-none grow">
        <div class="card-body">
            <div class="row no-gutters">

                <div class="col-6 align-items-center text-center">
                    <a href="<?php echo e(Auth::user()->role==1?url('/dashboard'):url('emp_dashboard')); ?>" class=" <?php echo e(Request::segment(1)=='dashboard'?'active text-white ':'text-dark'); ?> p-4 first-slider-btn ctm-border-right ctm-border-left ctm-border-top"><span class="lnr lnr-home pr-0 pb-lg-2 font-23"></span><span class="">Dashboard</span></a>
                </div>
                <?php $i = 0 ?>
                <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value['sidebar']): ?>
                <div class="col-6 align-items-center shadow-none text-center">
                    <a href="<?php echo e(url($value['sidebar'][0]['slug'])); ?>" class=" p-4  <?php echo e(Request::segment(1)==$value['sidebar'][0]['slug']?'active text-white':'text-dark'); ?>  <?php echo e($i==0?'second-slider-btn':''); ?>  ctm-border-right ctm-border-top"><span class="lnr <?php echo e($value['sidebar'][0]['sidebar_class']); ?> pr-0 pb-lg-2 font-23"></span><span class=""><?php echo e($value['sidebar'][0]['name']); ?></span></a>
                </div>
                <?php endif; ?>
                <?php $i++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\empisee\resources\views/sidebar.blade.php ENDPATH**/ ?>