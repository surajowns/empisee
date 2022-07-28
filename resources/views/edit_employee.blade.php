@extends('master')
@section('title',' Edit Employee')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
	<form method="post" action="" id="employee_form" enctype="multipart/form-data">
		@csrf
		<input type="hidden" value="{{$employee->id}}" name="id">
		<div class="accordion add-employee" id="accordion-details">
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="basic1">
					<h4 class="cursor-pointer mb-0">
						<a class=" coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#basic-oe" aria-expanded="false">
							Basic Details
							<!-- <br><span class="ctm-text-sm">Organized and secure.</span> -->
						</a>
					</h4>
				</div>
				<div class="card-body p-0">
					<div id="basic-one" class="collapse show ctm-padding" aria-labelledby="basic1" data-parent="#accordion-details">

						<div class="row">
							<div class="col-6 form-group">
								<input type="text" name="name" class="form-control" value="{{$employee->name}}" placeholder="Name" required>
							</div>
							<div class="col-6 form-group">
								<input type="email" name="email" class="form-control" placeholder="Email" value="{{$employee->email}}" required>
							</div>
							<div class="col-6 form-group">
								<input type="text" name="mobile" class="form-control" value="{{$employee->mobile}}" placeholder="Contact Number" required>
							</div>
							<!-- <div class="col-6 form-group">
						<input type="password" class="form-control" name="password"  placeholder="Password" required>
					</div> -->
							<div class="col-md-12">
								<div class=" custom-control custom-checkbox mb-0">
									<input type="checkbox" id="send-email" name="send-email" class="custom-control-input">
									<!--<label class="mb-0 custom-control-label" for="send-email">Send them an invite email so they can log in immediately</label>-->
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
								<input type="email" name="personal_email" class="form-control" placeholder="Personal Email" id="personal_email" value="{{$employee->emp_details[0]->personal_email}}" required autocomplete="off">
							</div>
							<div class="col-md-6 form-group">
								<div class="cal-icon">
									<input class="form-control  cal-icon-input" type="date" name="d_o_b" value="{{date('Y-m-d',strtotime($employee->emp_details[0]->d_o_b))}}"  placeholder="date of birth">
								</div>
							</div>
							<div class="col-md-6 form-group">
								<select class="form-control select" id="marital_status" name="marital_status">
									<option value="">Select status </option>
									<option value="Single" @if($employee->emp_details[0]->marital_status=='Single'){{'selected'}} @endif>Single</option>
									<option value="Married" @if($employee->emp_details[0]->marital_status=='Married'){{'selected'}} @endif>Married</option>
									<option value="Divorced" @if($employee->emp_details[0]->marital_status=='Divorced'){{'selected'}} @endif>Divorced</option>
									<option value="Widowed" @if($employee->emp_details[0]->marital_status=='Widowed'){{'selected'}} @endif>Widowed</option>
								</select>
							</div>

							<div class="col-md-6 form-group">
								<select class="form-control select" id="gender" name="gender" required>
									<option value="">Select gender </option>
									<option value="male" @if($employee->emp_details[0]->gender=='male'){{'selected'}} @endif>Male</option>
									<option value="female" @if($employee->emp_details[0]->gender=='female'){{'selected'}} @endif>Female</option>
									<option value="other" @if($employee->emp_details[0]->gender=='other'){{'selected'}} @endif>Other</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control" name="location" value="{{$employee->emp_details[0]->per_address}}" placeholder="Permanent Address (As Per Aadhar Card)">
							</div>
							<div class="col-md-6 form-group">
								<input type="text" class="form-control" name="pres_address" value="{{$employee->emp_details[0]->pres_address}}" placeholder="Present Address">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="guardian" class="form-control" value="{{$employee->emp_details[0]->guardian}}" placeholder="Guardian Name">
							</div>
							<div class="col-6 form-group">
							      <select class="form-control select" id="relation" name="relation">
									<option value="">Select Relation </option>
									<option value="Parent" @if($employee->emp_details[0]->relation=='Parent'){{'selected'}} @endif>Parent</option>
									<option value="Spouse" @if($employee->emp_details[0]->relation=='Spouse'){{'selected'}} @endif>Spouse</option>
								</select>
								<!--<input type="text" name="relation" class="form-control" value="{{$employee->emp_details[0]->relation}}" placeholder="Guardian Relation">-->
							</div>
							<div class="col-6 form-group">
								<input type="text" name="guardian_cont" min="0" maxlength="10" minlength="10" class="form-control" value="{{$employee->emp_details[0]->guardian_cont}}" placeholder="Guardian Contact Number">
							</div>
							<div class="col-6 form-group">
								<input type="number" name="fami_members" min="0" class="form-control" value="{{$employee->emp_details[0]->fami_members}}" placeholder="Family Members">
							</div>
							<div class="col-6 form-group">
								<input type="number" class="form-control" min="0" maxlength="10" minlength="10" value="{{$employee->emp_details[0]->emeg_contact}}" name="emeg_contact" placeholder="Emergency Mobile  Number">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="blood_group" value="{{$employee->emp_details[0]->blood_group}}" placeholder="Blood Group">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="birth_marks" value="{{$employee->emp_details[0]->birth_marks}}" placeholder="Visible Identification Marks">
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
								<input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{$employee->last_comapny_details->company_name}}" >
							</div>
							<div class="col-6 form-group">
								<input type="text" name="designation" class="form-control" value="{{$employee->last_comapny_details->designation}}" placeholder="Your Designation">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="hr_name" class="form-control" value="{{$employee->last_comapny_details->hr_name}}" placeholder="HR Name">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="hr_contact" class="form-control" value="{{$employee->last_comapny_details->hr_contact}}" placeholder="HR Contact">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="hr_email" class="form-control" value="{{$employee->last_comapny_details->hr_email}}" placeholder="HR Email">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="tl_name" class="form-control" value="{{$employee->last_comapny_details->tl_name}}" placeholder="Reporting Manager Name">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="tl_contact" class="form-control" value="{{$employee->last_comapny_details->tl_contact}}" placeholder="Reporting Manager Contact">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="tl_email" class="form-control" value="{{$employee->last_comapny_details->tl_email}}" placeholder="Reporting Manager Email">
							</div>
							<div class="col-6 form-group">
								<input type="text" name="com_contact" class="form-control" value="{{$employee->last_comapny_details->com_contact}}" placeholder="Company Contact Number">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control datetimepicker cal-icon-input" name="com_joining_date" class="form-control" value="{{$employee->last_comapny_details->com_joining_date}}" placeholder="Joining date" id="com_joining_date" autocomplete="off">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control datetimepicker cal-icon-input" name="com_last_date" class="form-control" id="com_last_date" value="{{$employee->last_comapny_details->com_last_date}}" placeholder="Last date" autocomplete="off">
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="com_address" placeholder="Company Address" value="{{$employee->last_comapny_details->com_address}}">
							</div>
							<div class="col-6 form-group">
								<textarea class="form-control" name="reason_for_left" placeholder="Reason for left" style="height:100px">{{$employee->last_comapny_details->reason_for_left}}</textarea>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="headingTwo">
					<h4 class="cursor-pointer mb-0">
						<a class="coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#employ-det">
							Employment Details
							<!-- <br><span class="ctm-text-sm">Let everyone know the essentials so they're fully prepared.</span> -->
						</a>
					</h4>
				</div>
				<div class="card-body p-0">
					<div id="employee-det" class="collapse show ctm-padding" aria-labelledby="headingTwo" data-parent="#accorn-details">

						<div class="row">

							<div class="col-md-6 form-group">
								<select class="form-control select" id="company_id" name="company_id" disabled>
									<option value="">Select Company </option>

									@foreach($company as $value)
									<option value="{{$value->id}}" @if($value->id == $employee->emp_details[0]->company_id){{'selected'}} @endif>{{$value->company_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 form-group">
								<select class="form-control select" id="department" name="department">
									<option value="">Select department </option>

									@foreach($department as $value)
									<option value="{{$value->id}}" @if($value->id == $employee->emp_details[0]->department){{'selected'}} @endif>{{$value->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 form-group">
								<select class="form-control select" id="role" name="role">
									<option value="">Select role </option>
									@foreach($role as $value)
									<option value="{{$value->id}}" @if($value->id == $employee->role){{'selected'}} @endif>{{$value->name}}</option>
									@endforeach
								</select>
							</div>


							<div class="col-md-6 form-group">
								<div class="cal-icon">
								<input class="form-control  cal-icon-input" type="date" value="{{date('Y-m-d',strtotime($employee->emp_details[0]->joining_date))}}" name="joining_date" placeholder="Joining Date">
								</div>
							</div>
							<div class="col-6 form-group">
								<input type="text" class="form-control" name="job_title" value="{{$employee->emp_details[0]->job_title}}" placeholder="Job Title">
							</div>

							<!-- <div class="col-12 form-group mb-0 mt-3">
						<p class="mb-2">Upload Address Proof</p>
						<div class="">
							<input type="file" class="form-control" name="address_prof"  value="{{$employee->emp_details[0]->address_prof}}" placeholder="Upload Address Proof">
						</div>
					</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-header" id="headingFour">
					<h4 class="cursor-pointer mb-0">
						<a class="coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#sal_det">
							Salary Details
							<br><span class="ctm-text-sm">Stored securely, only visible to Super Admins, Payroll Admins, and themselves.</span>
						</a>
					</h4>
				</div>
				<div class="card-body p-0">
					<div id="salary_det" class="collapse show ctm-padding" aria-labelledby="headingFour" data-parent="#accordion-details">
						<div class="row">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="emp_salary" value="{{$employee->emp_salary[0]->emp_salary}}" placeholder="Gross Amount">
							</div>

							<div class="col-md-6 form-group mb-0">
								<div class="cal-icon">
									<input class="form-control datetimepicker cal-icon-input" type="text" name="start_date" value="{{$employee->emp_salary[0]->start_date}}" placeholder="Start Date">
								</div>
							</div>
							<div class="col-md-6 form-group mb-0">
								<div class="cal-icon">
									<input class="form-control datetimepicker cal-icon-input" type="text" name="end_date" value="{{$employee->emp_salary[0]->end_date}}" placeholder="End Date">
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
					<button class="btn btn-theme text-white ctm-border-radius button-1">Update Details</button>
				</div>
			</div>
		</div>
	</form>
</div>

@endsection
@section('javascript')
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
						required: "Please enter permanent address",
					},
					pres_address: {
						required: "Please enter present address",
					},
					joining_date: {
						required: "Please select joining date",
					},
					job_title: {
						required: "Please enter job title",
					},
					department: {
						required: "Please select Department"
					},
					role: {
						required: "please select Role",
					},
					emp_salary: {
						required: "Please enter salary",
						number: "Salery should be number",
					}

				},
			})
		}
	});
</script>
@stop