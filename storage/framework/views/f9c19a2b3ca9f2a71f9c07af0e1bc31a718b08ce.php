<?php $__env->startSection('title',' Add Employee'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-xl-9 col-lg-8  col-md-12">
	<form method="post" action="" id="employee_form" enctype="multipart/form-data" autocomplete="off">
		<?php echo csrf_field(); ?>
		<div class="accordion add-employee" id="accordion-details">
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="basic1">
					<h4 class="cursor-pointer mb-0">
						<a class=" coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#basic" aria-expanded="true">
							Basic Details
							<!-- <br><span class="ctm-text-sm">Organized and secure.</span> -->
						</a>
					</h4>
				</div>
				<div class="card-body p-0">
					<div id="basic-one" class="collapse show ctm-padding" aria-labelledby="basic1" data-parent="#details">

						<div class="row">
							<div class="col-6 form-group">
								<input type="text" name="name" class="form-control" placeholder="Name" required>
							</div>
							<div class="col-6 form-group">
								<input type="email" name="email" class="form-control" placeholder="Email" id="email" required autocomplete="off">
								<span class="text-danger" id="check_email"></span>
							</div>
							<div class="col-6 form-group">
								<input type="text" name="mobile" class="form-control" id="mobile" placeholder="Contact Number" required autocomplete="off">
								<!-- <span class="text-danger" id="check_mobile"></span> -->
							</div>
							<div class="col-6 form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
							<div class="col-md-12">
								<div class=" custom-control custom-checkbox mb-0">
									<input type="checkbox" id="send-email" name="send-email" class="custom-control-input">
									<label class="mb-0 custom-control-label" for="send-email">Send them an invite email so they can log in immediately</label>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="previous">
					<h4 class="cursor-pointer mb-0">
						<a class=" coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#previous2" aria-expanded="true">
							Personal Details
							<!-- <br><span class="ctm-text-sm">Organized and secure.</span> -->
						</a>
					</h4>
				</div>

				<div class="card-body p-0">
					<div id="basic-one" class="collapse show ctm-padding" aria-labelledby="previous1" data-parent="#details">

						<div class="row">
							<div class="col-6 form-group">
								<input type="email" name="personal_email" class="form-control" placeholder="Personal Email" id="personal_email" required autocomplete="off">
							</div>
							<div class="col-md-6 form-group">
								<input class="form-control  cal-icon-input" type="text" name="d_o_b" id="d_o_b" onmouseover="(this.type='date')" onmouseout="(this.type='text')" placeholder="Date Of Birth" required>
							</div>
							<div class="col-md-6 form-group">
								<select class="form-control select" id="marital_status" name="marital_status">
									<option value="">Select status </option>
									<option value="Single">Single</option>
									<option value="Married">Married</option>
									<option value="Divorced">Divorced</option>
									<option value="Widowed">Widowed</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<select class="form-control select" id="gender" name="gender">
									<option value="">Select gender </option>
									<option value="male">Male</option>
									<option value="female">Female</option>
									<option value="other">Other</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control" name="pres_address" placeholder="Present Address">
							</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control" name="location" placeholder="Permanent Address (As Per Aadhar Card)">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="guardian" class="form-control" placeholder="Guardian Name">
							</div>
							<div class="col-6 form-group">
								<select class="form-control select" id="relation" name="relation">
									<option value="">Select Relation </option>
									<option value="Parent">Parent</option>
									<option value="Spouse">Spouse</option>
								</select>
								<!--<input type="text" name="relation" class="form-control" placeholder="Guardian Relation">-->
							</div>
							<div class="col-6 form-group">
								<input type="text" name="guardian_cont" class="form-control" placeholder="Guardian Contact Number">
							</div>
							<div class="col-6 form-group">
								<input type="number" name="fami_members" min="0" class="form-control" placeholder="Family Members">
							</div>
							<div class="col-6 form-group">
								<input type="number" class="form-control" min="0" maxlength="10" minlength="10" name="emeg_contact" placeholder="Emergency Mobile  Number">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="birth_marks" placeholder="Visible Identification Marks">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="blood_group" placeholder="Blood Group">
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="previous">
					<h4 class="cursor-pointer mb-0">
						<a class=" coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#previous2" aria-expanded="true">
							Previous Company Details
							<!-- <br><span class="ctm-text-sm">Organized and secure.</span> -->
						</a>
					</h4>
				</div>

				<div class="card-body p-0">
					<div id="basic-one" class="collapse show ctm-padding" aria-labelledby="previous1" data-parent="#details">

						<div class="row">
							<div class="col-6 form-group">
								<input type="text" name="company_name" class="form-control" placeholder="Company Name">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="designation" class="form-control" placeholder="Your Designation">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="hr_name" class="form-control" placeholder="HR Name">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="hr_contact" class="form-control" placeholder="HR Contact">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="hr_email" class="form-control" placeholder="HR Email">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="tl_name" class="form-control" placeholder="Reporting Manager Name">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="tl_contact" class="form-control" placeholder="Reporting Manager Contact">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="tl_email" class="form-control" placeholder="Reporting Manager Email">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="com_contact" class="form-control" placeholder="Company Contact Number">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control datetimepicker cal-icon-input" name="com_joining_date" class="form-control" placeholder="Joining date" id="com_joining_date" autocomplete="off">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control datetimepicker cal-icon-input" name="com_last_date" class="form-control" id="com_last_date" placeholder="Last date" autocomplete="off">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="com_address" placeholder="Company Address">
							</div>
							<div class="col-6 form-group">
								<textarea class="form-control" name="reason_for_left" placeholder="Reason for left" style="height:100px"></textarea>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="headingTwo">
					<h4 class="cursor-pointer mb-0">
						<a class="coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#emp">
							Employment Details
							<!-- <br><span class="ctm-text-sm">Let everyone know the essentials so they're fully prepared.</span> -->
						</a>
					</h4>
				</div>
				<div class="card-body p-0">
					<div id="employee-det" class="collapse show ctm-padding" aria-labelledby="headingTwo" data-parent="#accordion">

						<div class="row">

							<div class="col-md-6 form-group">
								<select class="form-control select" id="department" name="department">
									<option value="">Select department </option>

									<?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<select class="form-control select" id="role" name="role">
									<option value="">Select role </option>
									<?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<select class="form-control select" id="company_id" name="company_id" disabled>
									<option value="">Select Company </option>

									<?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value->id); ?>"><?php echo e($value->company_name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<div class="cal-icon">
									<input class="form-control datetimepicker cal-icon-input" type="text" name="joining_date" placeholder="Joining Date">
								</div>
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="job_title" placeholder="Job Title">
							</div>


							<div class="col-6 form-group mb-0 mt-3">
								<p class="mb-2">Upload Address Proof</p>
								<div class="">
									<input type="file" class="form-control" name="address_prof" placeholder="Upload Address Proof">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="headingFour">
					<h4 class="cursor-pointer mb-0">
						<a class="coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#salary">
							Salary Details
							<!-- <br><span class="ctm-text-sm">Stored securely, only visible to Super Admins, Payroll Admins, and themselves.</span> -->
						</a>
					</h4>
				</div>
				<div class="card-body p-0">
					<div id="salary_det" class="collapse show ctm-padding" aria-labelledby="headingFour" data-parent="#accordion-details">
						<div class="row">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="emp_salary" placeholder="Gross Amount">
							</div>

							<div class="col-md-6 form-group mb-0">
								<div class="cal-icon">
									<input class="form-control datetimepicker cal-icon-input" type="text" name="start_date" placeholder="Start Date">
								</div>
							</div>
							<div class="col-md-6 form-group mb-0">
								<div class="cal-icon">
									<input class="form-control datetimepicker cal-icon-input" type="text" name="end_date" placeholder="End Date">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="submit-section text-center btn-add">
					<button class="btn btn-theme text-white ctm-border-radius button-1">Add Employee</button>
				</div>
			</div>
		</div>
	</form>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
	$(document).ready(function() {
		if ($("#employee_form").length > 0) {
			$("#employee_form").validate({

				rules: {
					name: {
						required: true,
						maxlength: 50
					},

					email: {
						required: true,
						maxlength: 50,
						email: true,
					},

					mobile: {
						required: true,
						minlength: 10,
						maxlength: 10,
						number: true,
					},
					password: {
						required: true,
						minlength: 6,

					},
					gender: {
						required: true,
					},
					location: {
						required: true,
					},
					pres_address: {
						required: true,
					},
					personal_email: {
						required: true,
					},
					d_o_b: {
						required: true,
					},
					joining_date: {
						required: true,
					},
					job_title: {
						required: true,
					},
					department: {
						required: true,
					},
					role: {
						required: true,
					},
					emp_salary: {
						required: true,
						number: true,
					}
				},
				messages: {

					name: {
						required: "Please enter  name",
					},

					email: {
						required: "Please enter valid email",
						email: "Please enter valid email",
						maxlength: "The email  should less than or equal to 50 characters",
					},
					mobile: {
						required: "Please enter mobile no.",
						maxlength: "The mobile number should not be greater than 10 digit"
					},
					password: {
						required: "Please enter  password",
					},
					gender: {
						required: "Please select gender",
					},
					location: {
						required: "Please enter Permanent Address",
					},
					pres_address: {
						required: "Please enter Present Address",
					},
					personal_email: {
						required: "Please enter your personal email",
					},
					d_o_b: {
						required: "Please select date of birth",
					},
					joining_date: {
						required: "Please select joining date",
					},
					job_title: {
						required: "Please enter job title",
					},
					department: {
						required: "Please select department"
					},
					role: {
						required: "please select role",
					},
					emp_salary: {
						required: "Please enter salary",
						number: "Salery should be number",
					}

				},
			})
		}
		$('#email').on('keyup', function() {
			var email = $('#email').val();
			$.ajax({
				type: 'GET',
				url: "<?php echo e(url('check_email')); ?>",
				dataType: 'json',
				data: {
					email: email
				},
				cache: false,
				contentType: false,
				success: (data) => {
					if (data.status == 400) {
						$('#check_email').removeClass('text-success');
						$('#check_email').addClass('text-danger');
						$('#check_email').text(data.error);
					} else {
						$('#check_email').removeClass('text-danger');
						$('#check_email').addClass('text-success');
						$('#check_email').text('');

					}
				},
			});
		})

		$('#mobile').on('keyup', function() {
			var mobile = $('#mobile').val();
			$.ajax({
				type: 'GET',
				url: "<?php echo e(url('check_mobile')); ?>",
				dataType: 'json',
				data: {
					mobile: mobile
				},
				cache: false,
				contentType: false,
				success: (data) => {
					if (data.status == 400) {
						$('#check_mobile').removeClass('text-success');
						$('#check_mobile').addClass('text-danger');
						$('#check_mobile').text(data.error);
					} else {
						$('#check_mobile').removeClass('text-danger');
						$('#check_mobile').addClass('text-success');
						$('#check_mobile').text('');
					}
				},
			});
		})


	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\empisee\resources\views/add_employee.blade.php ENDPATH**/ ?>