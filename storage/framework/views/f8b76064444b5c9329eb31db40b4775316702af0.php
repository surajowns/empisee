<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [13, 15, 16, 18, 20])->get();


?>
<?php if(count($permission)>0): ?>
<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white p-4 mb-4 card">
	<ul class="list-group list-group-horizontal-lg">
		<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li class="list-group-item text-center  <?php echo e(Request::segment(1)==$value->sidebar[0]['slug']?'active button-5':'button-6'); ?>"><a href="<?php echo e(url($value->sidebar[0]['slug'].'/'.Session::get('emp_id'))); ?>" class="<?php echo e(Request::segment(1)==$value->sidebar[0]['slug']?'text-white':'text-dark'); ?>"><?php echo e($value->sidebar[0]['name']); ?></a></li>
		<!-- <li class="list-group-item text-center button-6"><a href="details.html" class="text-dark">Detail</a></li> -->
		<!-- <li class="list-group-item text-center  <?php echo e(Request::segment(1)=='document' ? ' active button-5':'button-6'); ?>"><a href="<?php echo e(url('/document/'.Session::get('emp_id'))); ?>" class="<?php echo e(Request::segment(1)=='document'?'text-white':'text-dark'); ?>">Document</a></li> -->
		<!-- <li class="list-group-item text-center <?php echo e(Request::segment(1)=='employee_leave' ? ' active button-5':'button-6'); ?>"><a href="<?php echo e(url('/employee_leave/'.Session::get('emp_id'))); ?>" class="<?php echo e(Request::segment(1)=='employee_leave'?'text-white':'text-dark'); ?>">Leaves</a></li> -->
		<!-- <li class="list-group-item text-center button-6"><a href="profile-reviews.html" class="text-dark">Reviews</a></li> -->
		<!-- <li class="list-group-item text-center  <?php echo e(Request::segment(1)=='profile_setting' ? ' active button-5':'button-6'); ?> "><a class="<?php echo e(Request::segment(1)=='profile_setting'?'text-white':'text-dark'); ?>" href="<?php echo e(url('/profile_setting/'.Session::get('emp_id'))); ?>">Settings</a></li> -->
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
	<ul>

	</ul>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/profile_header.blade.php ENDPATH**/ ?>