<?php $__env->startSection('title',' Manage'); ?>
<?php $__env->startSection('content'); ?>

<div class="col-xl-9 col-lg-8 col-md-12">
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
		<div class="card-body">
	   	<div class="mb-5">
			    <input class="form-control float-right" id="myInput" type="text" placeholder="Search..">
			</div>
		</div>
	</div>
	<div class=" row people-grid-row">
		<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
			<div class="card ctm-border-radius shadow-sm grow flex-fill" id="myDIV">
				<div class="card-header">
					<h4 class="card-title mb-0"><?php echo e($value['name']); ?></h4>
				</div>
				<div class="card-body">
					<div class="mt-2">
					             <a href="javascript:void(0)" class="avatar">
												<img class="profile_img" alt="avatar image" src="<?php if($value['profile_image']): ?> <?php echo e(url('public/profile/'.$value['profile_image'])); ?> <?php else: ?> <?php echo e(url('public/assets/img/profiles/profile.png')); ?> <?php endif; ?>" class="img-fluid">
												<span class="profile_name"><?php echo e(substr($value['name'], 0, 2)); ?></span>
											</a>
						<a href="<?php echo e(url('/manage/permission/'.$value['id'])); ?>" class="btn btn-theme button-1 ctm-border-radius text-white float-right text-white">View Permissions</a>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myDIV ").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/manage.blade.php ENDPATH**/ ?>