
<?php $__env->startSection('title',' Attendance'); ?>
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
		left: 0px;
		font-weight: bold;
		text-transform: uppercase;
	}

	.widget-profile .profile-info-widget .booking-doc-img {
		background: none !important;
	}

	.widget-profile .profile-info-widget .booking-doc-img img {
		left: 40%;
	}
</style>

<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="card shadow-sm ctm-border-radius grow">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="card-title mb-0 d-inline-block">Attendance Reports</h4>
			<input class="form-control float-right col-6" id="myInput" type="text" placeholder="Search..">
		</div>
		<div class="card-header d-flex align-items-center justify-content-between">
			<form  action="<?php echo e(url('generate_attendence_report')); ?>" method="get">
				<div class="row">
					<div class="input-group col-sm-3">
						<select class="form-control select select_employee" id="emp_id" name="emp_id[]" multiple="multiple">
							<option value="">Select Employee </option>
							<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($value['id']); ?>"> <?php echo e(strtoupper($value['name'])); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
					<div class="input-group col-sm-6 input-daterange">
						<input type="date" class="form-control" name="from" id="from" required>
						<div class="input-group-addon">to</div>
						<input type="date" class="form-control" name="to" id="to" required>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-theme button-1 ctm-border-radius text-white float-right" id=""><span></span> <span class="lnr lnr-paperclip"></span> Export Reports</button>
					</div>
				</div>
			</form>
		</div>
		<div class="card-body align-center">
			<div class="row people-grid-row">
				<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-6 col-lg-6 col-xl-4" id="myDIV">
					<div class="card widget-profile">
						<div class="card-body">
							<div class="pro-widget-content text-center">
								<div class="profile-info-widget " >
									<a href="<?php echo e(url('/attendence_report/'.$value['id'])); ?>" class="booking-doc-img">
										<?php if($value['profile_image']): ?>
										<img src="<?php echo e(url('public/profile/'.$value['profile_image'])); ?>" alt="User Image">
										<?php else: ?>
										<img class="profile_img" src="<?php echo e(url('public/assets/img/profiles/profile.png')); ?>" alt="<?php echo e($value['name']); ?>">
										<span class="profile_name"><?php echo e(substr($value['name'], 0, 2)); ?></span>
										<?php endif; ?>
									</a>

									<div class="profile-det-info">
										<h4><a  href="<?php echo e(url('/attendence_report/'.$value['id'])); ?>" class="text-primary"><?php echo e(ucfirst($value['name'])); ?></a></h4>
										<div>
											<p class="mb-0"><b><?php echo e($value['emp_details'][0]['job_title']); ?>


											</b></p>
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

		$("#report").on("click", function() {
			var emp_id=$('#emp_id').val();
			var from=$('#from').val();
			var to=$('#to').val();
			if(from.length==0 || to.length==0){
				alert('Please select date');

			}else{

				$.ajax({
					Type: "GET",
					url: '<?php echo e(url("generate_attendence_report")); ?>',
					dataType: 'json',
					cache: false,
					data: {emp_id: emp_id,from:from,to:to},
					success: function(response) {
						console.log(response);
					}
				})
			}

		});


		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myDIV ").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});

	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/attendence.blade.php ENDPATH**/ ?>