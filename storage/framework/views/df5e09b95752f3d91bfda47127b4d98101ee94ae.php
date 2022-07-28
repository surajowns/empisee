
<?php $__env->startSection('title',' Leave'); ?>
<?php $__env->startSection('content'); ?>
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
<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [19])->get();
//    dd($permission)
?>
<div class="col-xl-9 col-lg-8 col-md-12">

	<div class="row">
		<div class="col-md-12">
			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0">Apply Leaves</h4>
				</div>
				<div class="card-body">
					<form method="post" id="leave_form">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="_token" , value="<?php echo e(csrf_token()); ?>">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>
										Leave Type
										<span class="text-danger">*</span>
									</label>
									<select class="form-control select" name="leave_type">
										<option value="">Select Leave</option>
										<!-- <option value="Working From Home">Working From Home</option> -->
										<option value="1">Casual Leave</option>
										<option value="2">Sick Leave</option>
										<!-- <option value="Annual Leave">Annual Leave</option> -->
										<!-- <option value="Normal Leave">Normal Leave</option> -->
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>
										Day
										<span class="text-danger">*</span>
									</label>
									<select class="form-control select" name="leave_day" id="leave_day">
										<option value="">Select</option>
										<option value="Full Day">Full Day</option>
										<option value="First Half">First Half</option>
										<option value="Second Half">Second Half</option>
									</select>
								</div>
							</div>
							<!-- <div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Remaining Leaves</label>
															<input type="text" class="form-control" placeholder="10" disabled>
														</div>
													</div> -->
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>From</label>
									<input type="date" name="from_date" class="form-control ">
								</div>
							</div>
							<div class="col-sm-6 leave-col">
								<div class="form-group">
									<label>To</label>
									<input type="date" name="to_date" class="form-control ">
								</div>
							</div>
						</div>
						<div class="row">
							<!-- <div class="col-sm-6">
														<div class="form-group">
															<label>
															Half Day
															<span class="text-danger">*</span>
															</label>
															<select class="form-control select">
																<option>Select</option>
                                                                <option value="Full Day">Full Day</option>
																<option value="First Half">First Half</option>
																<option value="Second Half">Second Half</option>
															</select>
														</div>
													</div> -->
							<!-- <div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Number of Days Leave</label>
															<input type="text" class="form-control" placeholder="2" disabled>
														</div>
													</div> -->
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group mb-0">
									<label>Reason</label>
									<textarea class="form-control" name="leave_reason" rows=4></textarea>
								</div>
							</div>
						</div>
						<div class="text-center">
							<button class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Apply</button>
							<!-- <button class="btn btn-danger text-white ctm-border-radius mt-4">Cancel</button> -->
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0">Leave Details</h4>
				</div>
				<div class="card-body">
					<div class="employee-office-table">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Date</th>
										<th>Total Employees</th>
										<th>Full Day</th>
										<th>First Half</th>
										<th>Second Half</th>
										<th>Approved</th>
										<th>Not Approved</th>

									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo e(date('d M Y')); ?></td>
										<td><?php echo e($totalleaves->total); ?></td>
										<td><?php echo e($totalleaves->fullday); ?></td>
										<td><?php echo e($totalleaves->firsthalf); ?></td>
										<td><?php echo e($totalleaves->secondhalf); ?></td>
										<td><?php echo e($totalleaves->approved); ?></td>
										<td><?php echo e($totalleaves->not_approved); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0">Today Leaves</h4>
				</div>
				<div class="card-body">
					<div class="employee-office-table">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Employee</th>
										<th>Leave Type</th>
										<th>From</th>
										<th>To</th>
										<!-- <th>Days</th> -->
										<th>Notes</th>
										<th>Status</th>
										<th>Approved By</th>
										<!-- <th class="text-right">Action</th> -->
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $empleaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<a href="javascript:void(0)" class="avatar">
												<img class="profile_img" alt="avatar image" src="<?php if($value['employee']['profile_image']): ?> <?php echo e(url('public/profile/'.$value['employee']['profile_image'])); ?> <?php else: ?> <?php echo e(url('public/assets/img/profiles/profile.png')); ?> <?php endif; ?>" class="img-fluid">
												<span class="profile_name"><?php echo e(substr($value['employee']['name'], 0, 2)); ?></span>
											</a>
											<h2><a href="javascript:void(0)"><?php echo e($value['employee']['name']); ?></a></h2>
										</td>
										<td><?php echo e($value['leavetype']['name']); ?></td>
										<td><?php echo e(date('d M Y',strtotime($value['from_date']))); ?></td>
										<td><?php echo e(date('d M Y',strtotime($value['to_date']))); ?></td>
										<?php $totaldays = (int)(date('d', strtotime($value['to_date'])) - date('d', strtotime($value['from_date']))); ?>
										<!-- <td><?php echo e($totaldays==0?1:$totaldays); ?></td> -->

										<td><?php echo e($value['leave_reason']); ?></td>
										<td class="text-danger">
											<?php if(count($permission)>0): ?>
											<?php echo e(Form::open(array('url' => '/updatestatus'))); ?>

											<input type="hidden" name="leave_id" value="<?php echo e($value['id']); ?>">
											<select name="status_change" class="btn btn-theme ctm-border-radius text-white btn-sm" data-style="btn-primary" onchange="this.form.submit()">
												<?php $__currentLoopData = $leavestatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($name->id); ?>" <?php if($name->id == $value['status']): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($name->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
											<?php echo e(Form::close()); ?>

											<?php else: ?>
											<?php $__currentLoopData = $leavestatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($name->id == $value['status']): ?><?php echo e($name->name); ?> <?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>

										</td>
										<td><?php echo e($value['approved_by']); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="sidebar-overlay" id="sidebar_overlay"></div>

<!--Delete The Modal -->
<div class="modal fade" id="delete">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<!-- Modal body -->
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mb-3">Are You Sure Want to Delete?</h4>
				<button type="button" class="btn btn-danger ctm-border-radius text-white text-center mb-2 mr-3" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-theme ctm-border-radius text-white text-center mb-2 button-1" data-dismiss="modal">Delete</button>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
	$(document).ready(function() {
		if ($("#leave_form").length > 0) {
			$("#leave_form").validate({

				rules: {
					leave_type: {
						required: true,
					},
					leave_day: {
						required: true,

					},
					from_date: {
						required: true,

					},
					to_date: {
						required: true,

					},
					leave_reason: {
						required: true,
					},
				},
				messages: {
					leave_type: {
						required: "Please select leave type",
					},
					leave_day: {
						required: "Please select valid day",

					},
					from_date: {
						required: "Please select  valid date ",
					},
					to_date: {
						required: "Please select  valid date",
					},
					leave_reason: {
						required: "Please give proper reason",
					},
				},
			})
		}
		$('#leave_form').submit(function(e) {
			e.preventDefault();
			$.ajax({
				Type: "POST",
				url: '<?php echo e(url("apply_leave")); ?>',
				dataType: 'json',
				cache: false,
				data: $('#leave_form').serialize(),
				success: function(response) {
					if (response.status == 200) {
						toastr.success(response.success);
						setTimeout(function() {
							location.reload();
						}, 1000);

					} else {
						toastr.error(response.error);
					}
				}
			})
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/leave.blade.php ENDPATH**/ ?>