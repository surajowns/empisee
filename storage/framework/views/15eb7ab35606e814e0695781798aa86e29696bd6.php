<?php $__env->startSection('title',' Employee'); ?>
<?php $__env->startSection('content'); ?>

<style>
	.profile_img {
		position: absolute;
	}

	.profile_name {
		position: relative;
		top: 3px;
		font-size: 30px;
		color: #fff;
		left: 11px;
		font-weight: bold;
		text-transform: uppercase;
	}

	.widget-profile .profile-info-widget .booking-doc-img {
		background: none !important;
	}
</style>
<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [10, 11, 12, 13, 14,20,28])->get();
//    dd($permission)


?>
<div class="col-xl-9 col-lg-8 col-md-12">

	<?php if(count($permission)>0): ?>
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
		<div class="card-body">
			<ul class="list-group list-group-horizontal-lg">
				<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($value->sidebar_id==10 || $value->sidebar_id==11): ?>
				<li class="list-group-item text-center button-6"><a class="text-dark" href="<?php echo e(url($value->sidebar[0]['slug'])); ?>"><?php echo e($value->sidebar[0]['name']); ?></a></li>
				<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>
	<div class="card shadow-sm grow ctm-border-radius">
		<div class="card-body align-center">
			<h4 class="card-title float-left mb-0 mt-2"><?php echo e(count($employee)); ?> Employees</h4>
			<ul class="nav nav-tabs float-right border-0 tab-list-emp">
				<li class="nav-item pl-3">
					<?php if($permission): ?>
					<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($value->sidebar_id ==12 ): ?>
					<a href="<?php echo e(isset($value->sidebar[0])?url($value->sidebar[0]['slug']):'javascript:void(0)'); ?>" class="btn btn-theme button-1 text-white ctm-border-radius p-2 add-person ctm-btn-padding"><i class="fa fa-plus"></i> <?php echo e($value->sidebar[0]['name']); ?></a>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
	<div class="ctm-border-radius shadow-sm grow card">
		<div class="card-body">
			<div class="mb-5">
			    <input class="form-control float-right" id="myInput" type="text" placeholder="Search..">
			</div>
			<!--Content tab-->
			<?php echo e($employee->links()); ?>

			<hr>
			<div class="row people-grid-row">
				<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-6 col-lg-6 col-xl-4" id="myDIV">
					<div class="card widget-profile">
						<div class="card-body">
							<div class="pro-widget-content text-center">
								<div class="profile-info-widget">
								    
								    <?php if(count($permission)>0): ?>
									<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissionvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($permissionvalue->sidebar_id ==28): ?>
							     	<div class="custom-control custom-switch float-left">
											<input type="checkbox" class="custom-control-input permission" id="view<?php echo e($value['id']); ?>" data-emp_id="<?php echo e($value['id']); ?>"  value="<?php echo e($value['status']); ?>" <?php if($value['status']==1): ?> checked <?php endif; ?>>
											<label class="custom-control-label" for="view<?php echo e($value['id']); ?>"></label>
								   </div>
                                   <?php endif; ?>
								   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								   <?php endif; ?>
									<?php if(count($permission)>0): ?>
									<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissionvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($permissionvalue->sidebar_id ==13 ): ?>
									<a href="<?php echo e(isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'); ?>" class="booking-doc-img">
										<img class="profile_img" src="<?php echo e(isset($value['profile_image'])?url('public/profile/'.$value['profile_image']):url('public/assets/img/profiles/profile.png')); ?>" alt="<?php echo e($value['name']); ?>">
										<span class="profile_name"><?php echo e(substr($value['name'], 0, 2)); ?></span>
									</a>
									<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?>
									<a href="<?php echo e(isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'); ?>" class="booking-doc-img">
										<img class="profile_img" src="<?php echo e(isset($value['profile_image'])?url('public/profile/'.$value['profile_image']):url('public/assets/img/profiles/profile.png')); ?>" alt="<?php echo e($value['name']); ?>">
										<span class="profile_name"><?php echo e(substr($value['name'], 0, 2)); ?></span>
									</a>
									<?php endif; ?>
									<?php if($permission): ?>
									<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissionvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($permissionvalue->sidebar_id == 14): ?>
									<div class="team-action-icon float-right">
										<span data-toggle="modal" data-target="#edit">
											<a href="<?php echo e(isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'); ?>" class="btn btn-theme text-white ctm-border-radius" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
										</span>
									</div>
									<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
									<div class="profile-det-info">
										<?php if(count($permission)>0): ?>
										<?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissionvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($permissionvalue->sidebar_id == 13): ?>
										<h4><a href="<?php echo e(isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'); ?>" class="text-primary"><?php echo e($value['name']); ?></a></h4>
										<?php else: ?>
										<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
										<h4><a href="javascript:void(0)" class="text-primary"><?php echo e($value['name']); ?></a></h4>

										<?php endif; ?>
										<div>
											<p class="mb-0"><b><?php echo e($value['emp_details'][0]['job_title']); ?></b></p>
											<p class="mb-0 ctm-text-sm"><?php echo e($value['email']); ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>

		</div>
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
<script>
	$(document).ready(function() {
		$(document).on('click', '.permission', function(e) {
			e.preventDefault();
			var status = $(this).val();
			var emp_id = $(this).data('emp_id');
			if (confirm("Do you want to change the employee status?")) {
			$.ajax({
				Type: "POST",
				url: '<?php echo e(url("/update/employee/status")); ?>',
				dataType: 'json',
				cache: true,
				data: {
					emp_id: emp_id,
					status: status
				},
				success: function(response) {
					if (response.status == 400) {
						toastr.error(response.error);

					} else {
						 if(response.checked){
							$('#view'+emp_id).prop('checked', true);

						 }else{
							$('#view'+emp_id).prop('checked', false);
						 }
						$('#view'+emp_id).val(response.checked);
						toastr.success(response.success);

					}
				}
			})
			}


		});

	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/employee.blade.php ENDPATH**/ ?>