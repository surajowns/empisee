<?php $__env->startSection('title',' Expense'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-xl-9 col-lg-8 col-md-12">

	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-body align-center">
					<h4 class="card-title float-left mb-0 mt-2">Expense</h4>
								<form  action="<?php echo e(url('users/export/')); ?>" method="get">
			<div class="row">
			<input type="hidden" class="form-control" name="emp_id" id="emp_id" value="<?php echo e(Auth::user()->id); ?>">

			<div class="input-group col-sm-8 input-daterange">
				<input type="date" class="form-control" name="from" id="from" required>
				<div class="input-group-addon">to</div>
				<input type="date" class="form-control" name="to" id="to" required>
			</div>
			 <div class="col-sm-4">
				<button class="btn btn-theme button-1 ctm-border-radius text-white" id=""><span></span> <span class="lnr lnr-paperclip"></span> Export Reports</button>
			</div>
			</div>
          </form>
				</div>
			</div>

		</div>
		<div class="col-md-12">
			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0">Apply Expense</h4>
				</div>
				<div class="card-body">
					<form method="POST" action="<?php echo e(url('add_expense')); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="token" value="<?php echo e(@csrf_token()); ?>">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Expense Type</label>
									<input type="text" name="exp_type" class="form-control" required>
								</div>
							</div>
							<div class="col-sm-6 leave-col">
								<div class="form-group">
									<label>Date of Expense</label>
									<input type="text" name="exp_date" class="form-control datetimepicker" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>From</label>
									<input type="text" name="from" class="form-control">
								</div>
							</div>
							<div class="col-sm-6 leave-col">
								<div class="form-group">
									<label>To</label>
									<input type="text" name="to" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Amount</label>
									<input type="number" name="amount" class="form-control" required>
								</div>
							</div>
							<div class="col-sm-6 leave-col">
								<div class="form-group">
									<label>Vendor Name</label>
									<input type="text" name="vendor_name" class="form-control">
								</div>
							</div>
						</div>
						<!-- <div class="row">
													<div class="col-sm-6">
														<div class="form-group mb-0">
															<label>Did u have invoice or Payment Screensort ?</label><br>
															<input type="file" name="invoice">
															<input type="radio" name="no"> No
														</div>
													</div>
													<div class="col-sm-6"></div>
												</div> -->
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Purpose</label>
									<textarea class="form-control" name="purpose" rows=4 required></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 ">
								<div class="form-group">
									<label>Have You invoice or Payment Screensort ?</label>
									<input type="file" name="exp_invoice" class=" form-control mt-2">
								</div>
							</div>
							<div class="col-sm-6"></div>
						</div>
						<div class="row">
							<div class="col-sm-12 mt-2">
								<div class="form-group">
									<label>Describe Expense</label>
									<textarea class="form-control" name="notes" rows=4 required></textarea>
								</div>
							</div>
						</div>
						<div class="text-center">
							<button class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Submit</button>
							<!-- <a href="javascript:void(0);" class="btn btn-danger text-white ctm-border-radius mt-4">Cancel</a> -->
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0">Expense Reports</h4>
				</div>
				<div class="card-body">
					<div class="employee-office-table">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Date</th>
										<th>Expense Type</th>
										<th>Purpose</th>
										<th>Amount</th>
										<th>Vendor Name</th>
										<th>Description</th>
										<th>Invoice</th>
										<th>Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<tr>
										<td><?php echo e(Carbon\Carbon::createFromFormat('d/m/Y', $value->exp_date)->format('d M Y')); ?></td>

										<td><?php echo e($value->exp_type); ?></td>
										<td><?php echo e($value->purpose); ?></td>
										<!-- <td>
																	<a href="javascript::void(0)" class="avatar">																	
																		<img alt="avatar image" src="<?php echo e(url('public/profile/'.$value->employee->profile_image)); ?>" class="img-fluid">
																	    <div></div>
																	</a>
																	<h2><a href="javascript::void(0)"><?php echo e($value->employee->name); ?></a></h2>
																</td> -->
										<td><?php echo e($value->amount); ?></td>
										<td><?php echo e($value->vendor_name); ?></td>
										<td><?php echo e($value->notes); ?></td>
										<td>
										 <a href="<?php echo e(url('public/expense/'.$value->exp_invoice)); ?>" class="without-caption image-link" target="_blank">
                                              <img src="<?php echo e(url('public/expense/'.$value->exp_invoice)); ?>" width="172" height="115" />  
                                             </a>
										</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm">Approved</a>

										</td>
										<td class="text-right text-danger"><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete">
												<span class="lnr lnr-trash"></span> Delete
											</a></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="drift-zoom"></div>

		</div>


		<?php $__env->stopSection(); ?>
		<?php $__env->startSection('javascript'); ?>
		<script>
			$(document).ready(function() {
				var driftAll = document.querySelectorAll('img');
				var pane = document.querySelector('.drift-zoom');
				$(driftAll).each(function(i, el) {
					let drift = new Drift(
						el, {
							zoomFactor: 6,
							paneContainer: pane,
							inlinePane: false,
							handleTouch: false
						}
					);
				});
				// 	 if ($("#employee_form").length > 0) {
				// $("#employee_form").validate({

				// 	rules: {
				// 		name: {
				// 			required: true,
				// 			maxlength: 50
				// 		},

				// 		email: {
				// 			required: true,
				// 			maxlength: 50,
				// 			email: true,
				// 		},

				// 		mobile: {
				// 			required: true,
				// 			minlength:10,
				// 			maxlength:10,
				// 			number:true,
				// 		},
				// 		password: {
				// 			required: true,
				// 			minlength:6,

				// 		},
				// 		gender:{
				// 			required:true,
				// 		},
				// 		d_o_b:{
				// 			required: true,
				// 		},
				// 		joining_date:{
				// 			required: true,
				// 		},
				// 		job_title:{
				// 			required:true,
				// 		},
				// 		department:{
				// 			required:true,
				// 		},
				// 		role:{
				// 			required:true,
				// 		},
				// 		emp_salary:{
				// 			required:true,
				// 			number:true,
				// 		}
				// 	},
				// 	messages: {

				// 		name: {
				// 			required: "Please enter  name",
				// 		},

				// 		email: {
				// 			required: "Please enter valid email",
				// 			email: "Please enter valid email",
				// 			maxlength: "The email  should less than or equal to 50 characters",
				// 		},
				// 		mobile: {
				// 			required: "Please enter mobile no.",
				// 			maxlength:"The mobile number should not be greater than 10 digit"
				// 		},
				// 		password: {
				// 			required: "Please enter  password",
				// 		},
				// 		gender:{
				// 			required:"Please select gender",
				// 		},
				// 		d_o_b:{
				// 			required:"Please select date of birth",
				// 		},
				// 		joining_date:{
				// 			required: "Please select joining date",
				// 		},
				// 		job_title:{
				// 			required: "Please enter job title",
				// 		},
				// 		department:{
				// 			required:"Please select Department"
				// 		},
				// 		role:{
				// 			required:"please select Role",
				// 		},
				// 		emp_salary:{
				// 			required:"Please enter salary",
				// 			number:"Salery should be number",
				// 		}

				// 	},
				// })
				// }

				$('#expense_report').on('submit', function(e) {
					e.preventDefault();
					var formData = new FormData(this);
					alert(formData);
					alert($('form').serialize());
					$.ajaxSetup({
						header: {
							'X-CSRF-TOKEN': $("input[name='token]").attr('value'),
							'Content-Type': 'multipart/form-data',
						}
					});
					$.ajax({
						Type: "POST",
						url: '<?php echo e(url("add_expense")); ?>',
						enctype: 'multipart/form-data',
						data: formData,
						cache: false,
						processData: false,
						contentType: false,
						success: function(response) {
							console.log(response);
							if (response.status == 200) {
								toastr.success(response.success);

							} else {
								toastr.error(response.error);
							}
						}
					})
				});

			});
		</script>


		<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/expense.blade.php ENDPATH**/ ?>