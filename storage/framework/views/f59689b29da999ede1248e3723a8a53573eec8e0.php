<?php $__env->startSection('title',' Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<?php
$user = Auth::user();
$date = date('Y-m-d');
$clockInTime = App\ClockInOut::where('emp_id', $user['id'])->whereDate('created_at', $date)->orderBy('id', 'DESC')->first();
?>
<style>
	#clock_out {
		background: #000000;
	}
</style>
<style>
	.profile_img {
		position: absolute;
	}

	.profile_name {
		position: relative;
		top: 1px;
		font-size: 17px;
		color: #fff;
		left: 1px;
		font-weight: bold;
		text-transform: uppercase;
	}

	.widget-profile .profile-info-widget .booking-doc-img {
		background: none !important;
	}
</style>
<div class="col-xl-9 col-lg-8 col-md-12">
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm bg-white card grow">

		<div class="card-body">
			<ul class="list-group list-group-horizontal-lg">
				<!-- <li class="list-group-item text-center button-6"><a href="index.html" class="text-dark">Admin Dashboard</a></li> -->
				<li class="list-group-item text-center active button-5"><a class="text-white" href="https://meet.google.com/?hs=197&pli=1&authuser=0"  target="_blank">Schedule a Call</a></li>

			</ul>
			<span class="text-center clock_in_out"></span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-12 d-flex">
			<div class="card shadow-sm flex-fill grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Clock In/Clock Out Timing</h4>
					<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="fa fa-suitcase"></i></a>
				</div>
				<div class="card-body text-center">
					<div class="time-list">
						<div class="dash-stats-list">
							<span class="btn btn-outline-primary" id="clock_in_time"><?php echo e(isset($clockInTime['clock_in'])?date('h:i A', strtotime($clockInTime['clock_in'])):'00.00'); ?></span>
							<p class="mb-0">Clock IN</p>
						</div>
						<div class="dash-stats-list">
							<span class="btn btn-outline-primary" id="clock_out_time"><?php echo e(isset($clockInTime['clock_out'])?date('h:i A', strtotime($clockInTime['clock_out'])):'00.00'); ?></span>
							<p class="mb-0">Clock Out</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6  d-flex">
			<div class="card shadow-sm flex-fill grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Total Leaves</h4>
					<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="fa fa-suitcase"></i></a>
				</div>
				<div class="card-body text-center">
					<div class="time-list">
						<div class="dash-stats-list">
							<span class="btn btn-outline-primary"><?php echo e($cl); ?> Days</span>
							<p class="mb-0">CL</p>
							<span class="btn btn-outline-primary"><?php echo e($cl_remaining); ?> Days</span>
							<p class="mb-0">Remaining</p>
						</div>
						<div class="dash-stats-list">
							<span class="btn btn-outline-primary"><?php echo e($ml); ?> Days</span>
							<p class="mb-0">ML</p>
							<span class="btn btn-outline-primary"><?php echo e($ml_remaining); ?> Days</span>
							<p class="mb-0">Remaining</p>
						</div>
						<div class="dash-stats-list">
						<span class="btn btn-outline-primary">22 Days</span>
							<p class="mb-0">Total</p>
							<span class="btn btn-outline-primary"><?php echo e($total_Remaining); ?> Days</span>
							<p class="mb-0">Remaining</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 d-flex">
			<div class="card shadow-sm flex-fill grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Today</h4>
					<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="lnr lnr-sync"></i></a>
				</div>
				<div class="card-body recent-activ">
					<div class="recent-comment">
					    <?php if(!empty($todayevent)): ?> 
												<?php $__currentLoopData = $todayevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<a href="javascript:void(0)" class="dash-card text-dark">
													<div class="dash-card-container">
														<div class="dash-card-icon text-primary">
															<i class="fa fa-birthday-cake" aria-hidden="true"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0"> Today is <?php echo e($value['title']); ?>  </h6>
														</div>
													</div>
												</a>
												<hr>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												<?php endif; ?>
						<?php if(!empty($todaybirthday)): ?>
						<?php $__currentLoopData = $todaybirthday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-birthday-cake" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0"><?php echo e($value['emp_details']['name']); ?> Birthdays Today</h6>
								</div>
								<div class="dash-card-avatars">
									<div class="e-avatar"><img class="img-fluid" src="<?php echo e(isset($value['emp_details']['profile_image'])?url('public/profile/'.$value['emp_details']['profile_image']):url('public/assets/img/profiles/1613731537.png')); ?>" alt=""></div>
								</div>
							</div>
						</a>
						<hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
						<!-- <a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-birthday-cake" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0">No Birthdays Today</h6>
								</div>
							</div>
						</a> -->
						<?php endif; ?>
						<?php if(!empty($totalleave)): ?>

						<?php $__currentLoopData = $totalleave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-suitcase" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0"><?php echo e($value['employee']['name']); ?>&nbsp;<?php echo e($value['leavetype']['name']); ?> &nbsp;&nbsp;Today </h6>
								</div>
								<div class="dash-card-avatars">
									<div class="e-avatar"><img class="img-fluid" src="<?php echo e(isset($value['employee']['profile_image'])?url('public/profile/'.$value['employee']['profile_image']):url('public/assets/img/profiles/1613731537.png')); ?>" alt=""></div>
								</div>
							</div>
						</a>
						<hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
						<a href="javascript:void(0)" class="dash-card text-dark">
							<div class="dash-card-container">
								<div class="dash-card-icon text-primary">
									<i class="fa fa-suitcase" aria-hidden="true"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0">No one on leave today</h6>
								</div>
							</div>
						</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 d-flex">
			<div class="card flex-fill today-list shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Upcoming Event</h4>
					<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="fa fa-suitcase"></i></a>
				</div>
				<div class="card-body recent-activ">
					<div class="recent-comment">
						<?php if(!empty($upcomingevent)): ?>
						<?php $__currentLoopData = $upcomingevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="javascript:void(0)" class="dash-card text-danger">
							<div class="dash-card-container">
								<div class="dash-card-icon">
									<i class="fa fa-suitcase"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0"><?php echo e(date('D',strtotime($value->start))); ?>,<?php echo e(date('d M Y',strtotime($value->start))); ?> <?php echo e($value->title); ?></h6>
								</div>
							</div>
						</a>
						<hr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
						<a href="javascript:void(0)" class="dash-card text-danger">
							<div class="dash-card-container">
								<div class="dash-card-icon">
									<i class="fa fa-suitcase"></i>
								</div>
								<div class="dash-card-content">
									<h6 class="mb-0">No Upcomming Leaves</h6>
								</div>
							</div>
						</a>
						<hr>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12 d-flex">

			<!-- Team Leads List -->
			<div class="card flex-fill team-lead shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0 d-inline-block">Team Leads </h4>
					<a href="javascript:void(0)" class="dash-card float-right mb-0 text-primary">Manage Team </a>
				</div>
				<div class="card-body">
					<?php if(!empty($teamlead)): ?>
					<?php $__currentLoopData = $teamlead; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="media mb-3">
						<div class="e-avatar avatar-online mr-3 "><img class="profile_img" src="<?php if($lead->emp_details->profile_image): ?> <?php echo e(url('public/profile/'.$lead->emp_details->profile_image)); ?> <?php else: ?> <?php echo e(url('public/assets/img/profiles/1613731537.png')); ?> <?php endif; ?>" alt="" class="img-fluid">

							<!-- <span class="profile_name"><?php echo e(substr($lead->emp_details->name, 0, 2)); ?></span> -->

						</div>
						<div class="media-body">
							<h6 class="m-0"><?php echo e($lead->emp_details->name); ?></h6>
							<p class="mb-0 ctm-text-sm"><?php echo e($lead->departments->name); ?></p>
						</div>
					</div>
					<hr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
					<div class="media mb-3">
						<div class="e-avatar avatar-online mr-3"><img src="<?php echo e(isset($lead->emp_details->profile_image)?url('public/profile/'.$lead->emp_details->name):url('public/assets/img/profiles/1613731537.png')); ?>" alt="" class="img-fluid"></div>
						<div class="media-body">
							<h6 class="m-0">No team leads </h6>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="sidebar-overlay" id="sidebar_overlay"></div>

<!-- Add a Key Date Modal-->
<div class="modal fade" id="add-comment">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mb-3">You are late</h4>
				<form method="post" id="comment">
					<div class="form-group">
						<div class="input-group mb-3">
							<input class="form-control date-enter" type="text" name="comment" placeholder="Comment " id="comments" required>
						</div>
					</div>
					<button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-theme text-white ctm-border-radius float-right button-1">Comment</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>

<script>
	$(document).ready(function() {
		$(document).on('click', '#clock_in', function() {
			var dt = new Date($.now());
			var clock_in ="<?php echo e(date('H', time())); ?>";
			var clock_in_time ="<?php echo e(date('h:i', time())); ?>";
			if (clock_in > 9) {
				$('#add-comment').modal('show');
			} else {
			$('#clock_in').prop('disabled', true);
			$('#clock_in').text('Wait a minute');
				$.ajax({
					Type: "GET",
					url: '<?php echo e(url("employee_clock_in")); ?>',
					dataType: 'json',
					cache: false,
					data: {
						clock_in: clock_in
					},
					success: function(response) {
						console.log(response.status);
						if (response.status == 200) {
						setTimeout(() => {
								$('#clock_in').attr("id", "clock_out");
								$('#clock_out').text('Clock Out')
								$('#clock_out').prop('disabled', false);

							}, 50000);
							toastr.success(response.success);
							$('#clock_in_time').text(clock_in_time);
						} else {
							toastr.error(response.error);
						}
					}
				})
			}
		});
		$(document).on('click', '#clock_out', function() {
			var dt = new Date($.now());
            
            if (confirm('Are you sure you want to clock out?')) {

			var clock_out = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			$.ajax({
				Type: "GET",
				url: '<?php echo e(url("employee_clock_out")); ?>',
				dataType: 'json',
				cache: false,
				data: {
					clock_out: clock_out
				},
				success: function(response) {
					console.log(response.status);
					if (response.status == 200) {
						$('#clock_out').text("Clock In");
						$('#clock_out').attr("id", "clock_in");
						toastr.success(response.success);
						$('#clock_in_time').text('00:00');
						$('#clock_out_time').text('00:00');
					} else {
						toastr.error(response.error);

					}
				}
			})
		  }
		});
		$(document).on('submit', '#comment', function(e) {
			e.preventDefault();
			$('#clock_in').prop('disabled', true);
			$('#clock_in').text('Wait a minute')
			var dt = new Date($.now());
			// var clock_in = dt.getHours() + ":" + dt.getMinutes();
			var clock_in ="<?php echo e(date('h:i', time())); ?>";
			comment = $('#comments').val();
			$.ajax({
				Type: "POST",
				url: '<?php echo e(url("employee_clock_in")); ?>',
				dataType: 'json',
				cache: false,
				data: {
					clock_in: clock_in,
					comment: comment
				},
				success: function(response) {
					console.log(response.status);
					if (response.status == 200) {
						$('#add-comment').modal('hide');
					setTimeout(() => {
								$('#clock_in').attr("id", "clock_out");
								$('#clock_out').text('Clock Out')
								$('#clock_out').prop('disabled', false);

							}, 50000);
						toastr.success(response.success);
						$('#clock_in_time').text(clock_in);

					} else {
						toastr.error(response.error);
					}
				}
			})
		});

	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/emp_dashboard.blade.php ENDPATH**/ ?>