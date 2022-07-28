@extends('master')
@section('title','Your Profile')
@section('content')
<style>
	.profile-pic {
		max-width: 150px;
		max-height: 150px;
		margin-left: auto;
		margin-right: auto;
		display: block;
	}

	.file-upload {
		display: none;
	}

	.circle {
		border-radius: 50%;
		overflow: hidden;
		width: 150px;
		height: 150px;
		border: 8px solid rgb(230 46 45);
		/*position: absolute;*/
		/*top: 72px;*/
		transition: all .3s;
	}

	.circle:hover {
		background-color: #909090;
		cursor: pointer
	}
</style>
<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="card ctm-border-radius shadow-sm grow">
		<div class="card-header">
			<h4 class="card-title mb-0 d-inline-block">{{$employee['roles']['name']}}</h4>
			<a href="{{url('edit_employee/'.$employee['id'])}}" class="btn btn-theme button-1 text-white ctm-border-radius p-2 add-person ctm-btn-padding float-right"><i class="fa fa-plus"></i>Update Details</a>

		</div>
		<div class="card-body">
			<a class="mb-0 cursor-pointer d-block">
				<span class="avatar" data-toggle="tooltip" data-placement="top" title="{{$employee['name']}}"><img src="{{isset($employee['profile_image'])?url('public/profile/'.$employee['profile_image']):url('public/profile/')}}" alt="{{$employee['name']}}" class="img-fluid"></span>
				<span class="ml-4">{{$employee['name']}}</span>
			</a>
		</div>
	</div>
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
		<div class="card-body">
			<div class="list-group list-group-horizontal-lg" id="v-pills-tab" role="tablist">
				<a class=" active list-group-item" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Details</a>
				<a class="list-group-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Attendences</a>
				<a class="list-group-item" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Leaves</a>
				<a class="list-group-item" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Documents</a>
				<a class="list-group-item" id="v-pills-settings-tab1" data-toggle="pill" href="#v-pills-settings1" role="tab" aria-controls="v-pills-settings1" aria-selected="false">Profile Settings</a>
				<a class="list-group-item" id="v-pills-salary-tab1" data-toggle="pill" href="#v-pills-salary" role="tab" aria-controls="v-pills-salary" aria-selected="false">Salary details </a>

			</div>
		</div>
	</div>
	<div class="tab-content" id="v-pills-tabContent">

		<!-- Tab1-->
		<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
					<div class="card flex-fill ctm-border-radius shadow-sm grow">
						<div class="card-header">
							<h4 class="card-title mb-0">Basic Information</h4>
						</div>
						<div class="card-body text-center">
							<p class="card-text mb-3"><span class="text-primary">Name :</span> {{$data['name']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Nationality :</span> Indian</p>
							<p class="card-text mb-3"><span class="text-primary">Date of Birth :</span>{{ date('d-m-Y',strtotime($data['emp_details'][0]['d_o_b']))}}</p>
							<p class="card-text mb-3"><span class="text-primary">Gender : </span>{{ucfirst($data['emp_details'][0]['gender'])}}</p>
							<p class="card-text mb-3"><span class="text-primary">Permanent Address : </span> {{$data['emp_details'][0]['per_address']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Present Address : </span> {{$data['emp_details'][0]['pres_address']}}</p>

							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#add_basicInformation"><i class="fa fa-plus" aria-hidden="true"></i></a> -->
							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#edit_basicInformation"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
					<div class="card flex-fill  ctm-border-radius shadow-sm grow">
						<div class="card-header">
							<h4 class="card-title mb-0">Personal Details</h4>
						</div>
						<div class="card-body ">
							<p class="card-text mb-3"><span class="text-primary">Guardian Name : </span>{{$data['emp_details'][0]['guardian']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Guardian Contact : </span>{{$data['emp_details'][0]['guardian_cont']}}</p>

							<p class="card-text mb-3"><span class="text-primary">Relation : </span>{{$data['emp_details'][0]['relation']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Family Members : </span>{{$data['emp_details'][0]['fami_members']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Emegency Contact : </span>{{$data['emp_details'][0]['emeg_contact']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Blood Group : </span>{{$data['emp_details'][0]['blood_group']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Birth Marks: </span>{{$data['emp_details'][0]['birth_marks']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Status : </span>{{$data['emp_details'][0]['marital_status']}}</p>

							<!-- <p class="card-text mb-3"><span class="text-primary">Linkedin : </span>#mariacotton</p> -->
							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#add_Contact"><i class="fa fa-plus" aria-hidden="true"></i></a> -->
							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#edit_Contact"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
					<div class="card flex-fill  ctm-border-radius shadow-sm grow">
						<div class="card-header">
							<h4 class="card-title mb-0">Contact</h4>
						</div>
						<div class="card-body text-center">
							<p class="card-text mb-3"><span class="text-primary">Phone Number : </span>{{$data['mobile']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Email : </span>{{$data['email']}}</p>
					<p class="card-text mb-3"><span class="text-primary">Personal Email : </span>{{$data['emp_details'][0]['personal_email']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Websites : </span></p>
					<a class="btn btn-theme ctm-border-radius text-white btn-sm"  href="https://www.besthawk.com/" target="_blank"> Best Hawk</a>
					<a class="btn btn-theme ctm-border-radius text-white btn-sm"  href="https://shoppershawk.com" target="_blank"> Shoppers Hawk</a>
							<!-- <p class="card-text mb-3"><span class="text-primary">Linkedin : </span>#mariacotton</p> -->
							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#add_Contact"><i class="fa fa-plus" aria-hidden="true"></i></a> -->
							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#edit_Contact"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
					<div class="card flex-fill ctm-border-radius shadow-sm grow">
						<div class="card-header">
							<h4 class="card-title mb-0">Previous Company Information</h4>
						</div>
						<div class="card-body ">
							<p class="card-text mb-3"><span class="text-primary">Company Name :</span> {{ isset($data['last_comapny_details']['company_name'])?ucfirst($data['last_comapny_details']['company_name']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Designation :</span> {{ isset($data['last_comapny_details']['designation'])?ucfirst($data['last_comapny_details']['designation']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Company Contact :</span> {{ isset($data['last_comapny_details']['com_contact'])?ucfirst($data['last_comapny_details']['com_contact']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Reason to leave the Company :</span> {{ isset($data['last_comapny_details']['reason_for_left'])?ucfirst($data['last_comapny_details']['reason_for_left']):'N/A'}}</p>

							<p class="card-text mb-3"><span class="text-primary">Hr Name :</span> {{ isset($data['last_comapny_details']['hr_name'])?ucfirst($data['last_comapny_details']['hr_name']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Hr Contact :</span> {{ isset($data['last_comapny_details']['hr_contact'])?ucfirst($data['last_comapny_details']['hr_contact']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Hr Email :</span> {{ isset($data['last_comapny_details']['hr_email'])?ucfirst($data['last_comapny_details']['hr_email']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Reporting Manager Name :</span> {{ isset($data['last_comapny_details']['tl_name'])?ucfirst($data['last_comapny_details']['tl_name']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Reporting Manager Contact :</span> {{ isset($data['last_comapny_details']['tl_contact'])?ucfirst($data['last_comapny_details']['tl_contact']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Reporting Manager Email:</span> {{ isset($data['last_comapny_details']['tl_email'])?ucfirst($data['last_comapny_details']['tl_email']):'N/A'}}</p>

							<p class="card-text mb-3"><span class="text-primary">Company Address :</span> {{isset($data['last_comapny_details']['com_address'])?ucfirst($data['last_comapny_details']['com_address']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Joining Date :</span>{{ isset($data['last_comapny_details']['com_joining_date'])?ucfirst($data['last_comapny_details']['com_joining_date']):'N/A'}}</p>
							<p class="card-text mb-3"><span class="text-primary">Last Date: </span>{{isset($data['last_comapny_details']['com_last_date'])?ucfirst($data['last_comapny_details']['com_last_date']):'N/A'}}</p>

							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#add_basicInformation"><i class="fa fa-plus" aria-hidden="true"></i></a> -->
							<!-- <a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm" data-toggle="modal" data-target="#edit_basicInformation"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
						</div>
					</div>
				</div>


			</div>
		</div>
		<!-- /Tab1-->

		<!-- Tab2-->
		<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
		<div class="card ctm-border-radius shadow-sm grow">
		<div class="card-header">
		<form  action="{{url('generate_attendence_report')}}" method="get">
			<div class="row">
			<input type="hidden" class="form-control" name="emp_id[]" id="emp_id" value="{{$employee['id']}}">

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
	<div class="card ctm-border-radius shadow-sm grow">	
	<div class="card-header">
		<div class="table-responsive">
				<table class="table custom-table table-hover">
					<thead>
						<tr>
							<th>Sr.No</th>
							<th>Date</th>
							<th>Status</th>
							<th>Clock In</th>
							<th>Clock Out</th>
							<th>Work Duration</th>
							<th>Message</th>
							<!-- <th>Actions</th> -->
						</tr>
					</thead>
					<tbody>
						@foreach($report as $value)
						<tr>
                            <td>{{$loop->iteration}}</td>
							<td>{{date('d-m-Y' ,strtotime($value->created_at))}} ({{date('D' ,strtotime($value->created_at))}})</td>
							<td>
								<h2>{{$value->attendence_status->name}}</h2>
							</td>
							<td>{{isset($value->clock_in)?date('h:i A' ,strtotime($value->clock_in)):'_'}}</td>
							<td>{{ isset($value->clock_out)?date('h:i A' ,strtotime($value->clock_out)):'_'}}</td>
							<td>@if($value->clock_out) {{date('H' ,strtotime($value->clock_out))-date('H' ,strtotime($value->clock_in))}}&nbsp;&nbsp;Hours {{date('i' ,strtotime($value->clock_out))-date('i' ,strtotime($value->clock_in))}}&nbsp;&nbsp;Mins @else - @endif</td>
							<td>
								{{$value->comment}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
</div>
</div>
		<!-- /Tab2 -->

		<!-- Tab3 -->
		<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
			<div class="employee-office-table">
			<div class="card ctm-border-radius shadow-sm grow">	
	         <div class="card-header">	
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
							@foreach($empleaves as $value)
							<tr>
								<td>
									<a href="javascript:void(0)" class="avatar">
										<img class="profile_img" alt="avatar image" src="@if($value['employee']['profile_image']) {{url('public/profile/'.$value['employee']['profile_image'])}} @else {{url('public/assets/img/profiles/profile.png')}} @endif" class="img-fluid">
										<span class="profile_name">{{substr($value['employee']['name'], 0, 2)}}</span>
									</a>
									<h2><a href="javascript:void(0)">{{$value['employee']['name']}}</a></h2>
								</td>
								<td>{{$value['leave_type']}}</td>
								<td>{{date('d M Y',strtotime($value['from_date']))}}</td>
								<td>{{date('d M Y',strtotime($value['to_date']))}}</td>
								<?php $totaldays = (int)(date('d', strtotime($value['to_date'])) - date('d', strtotime($value['from_date']))); ?>
								<!-- <td>{{$totaldays==0?1:$totaldays}}</td> -->

								<td>{{$value['leave_reason']}}</td>
								<td class="text-danger">

									@foreach($leavestatus as $name)
									@if($name->id == $value['status']){{$name->name}} @endif
									@endforeach


								</td>
								<td>{{$value['approved_by']}}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
</div>
</div>
				</div>
			</div>
		</div>
		<!-- /Tab3 -->

		<!-- Tab4 -->
		<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title doc d-inline-block mb-0">Documents({{$employee['name']}})</h4>
					<a href="javascript:void(0)" class="float-right doc-fold text-primary d-inline-block text-info" data-toggle="modal" data-target="#add-document">Add Document</a>
				</div>
				<div class="card-body doc-boby">
					@if(!empty($document))
					@foreach($document as $value)
					<div class="card shadow-none">
						<div class="card-header">
							<div class="row">
								<div class="col-12">
									<span class="card-title text-primary mb-0 col-6">{{$value['doc_name']}}</span>

									<a class="float-right " href="{{url('public/document/'.$value['document'])}}" download>Download</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<div class="document-up">
										<embed src="{{url('public/document/'.$value['document'])}}" type="application/pdf" width="100%" height="600" />

										<!--<span class="float-right text-primary" data-toggle="modal" data-target="#update-document{{$value['id']}}">Edit</span>-->
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>

			<div class="sidebar-overlay" id="sidebar_overlay"></div>

			<!-- Add a Key Date Modal-->
			<div class="modal fade" id="add-document">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<!-- Modal body -->
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title mb-3">Add Document</h4>
							<form method="POST" enctype="multipart/form-data" id="document-upload">
								<input type="hidden" name="csrf-token" value="{{csrf_token()}}">
								<input type="hidden" name="emp_id" value="{{Auth::user()->id}}">

								<div class="form-group">
									<div class="input-group mb-3">
										<input class="form-control date-enter" type="text" name="doc_name" placeholder="Document Name" required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<input class="form-control date-enter" type="file" name="document" required>
									</div>
								</div>
								<button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-theme text-white ctm-border-radius float-right button-1">Add Document</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- New Team The Modal -->
			@if(!empty($document))
			@foreach($document as $value)
			<div class="modal fade" id="update-document{{$value['id']}}">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<!-- Modal body -->
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title mb-3">Edit {{$value['doc_name']}}</h4>

							<form method="POST" enctype="multipart/form-data" id="document-update">
								<input type="hidden" name="csrf-token" value="{{csrf_token()}}">
								<input type="hidden" name="id" value="{{$value['id']}}" id="id">
								<input type="hidden" name="emp_id" value="{{Auth::user()->id}}" id="emp_id">


								<div class="form-group">
									<div class="input-group mb-3">
										<input class="form-control date-enter" type="text" name="doc_name" value="{{$value['doc_name']}}" placeholder="Document Name" required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<input class="form-control date-enter" type="file" name="document" value="{{$value['document']}}" placeholder="Document">
									</div>
								</div>
								<button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-theme text-white ctm-border-radius float-right button-1">Update Document</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			@endif
		</div>
		<!-- /Tab4 -->

		<!-- Tab5 -->
		<div class="tab-pane fade" id="v-pills-settings1" role="tabpanel" aria-labelledby="v-pills-settings-tab1">
			<div class="row">
				<div class="col-lg-12 d-flex">
					<div class="card ctm-border-radius shadow-sm grow flex-fill">
						<div class="card-header">
							<h4 class="card-title mb-0">Update Profile Picture</h4>
							<span class="ctm-text-sm">Your Profile Always Up to Date.</span>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-4 d-flex"></div>
								<div class="col-lg-4 d-flex">
									<div class="circle upload-button">
										<!-- User Profile Image -->
										@if($data['profile_image'])
										<img class="profile-pic" src="{{url('public/profile/'.$data['profile_image'])}}">
										@else
										<img class="profile-pic" src="{{url('public/assets/img/profiles/profile.png')}}">
										@endif
										<!-- Default Image -->
										<!-- <i class="fa fa-user fa-5x"></i> -->
									</div>
									<form method="POST" enctype="multipart/form-data" id="image-upload">
										<input type="hidden" name="csrf-token" value="{{csrf_token()}}">
										<input class="file-upload" type="file" name="profile_image" id="profile_image">
										<button type="submit" class="bg-gradient-primary text-white" id="formsubmmit"></button>

									</form>
								</div>
								<div class="col-lg-4 d-flex"></div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 d-flex">
					<div class="card ctm-border-radius shadow-sm grow flex-fill">
						<div class="card-header">
							<h4 class="card-title mb-0">Update Profile</h4>
							<span class="ctm-text-sm">Your Profile Always Up to Date.</span>
						</div>

						<div class="card-body">
							<span class="error"></span>
							<div class="form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$data['name']}}">
							</div>
							<div class="form-group">
								<input type="mail" class="form-control" id="email" name="email" placeholder="Enter Email address" value="{{$data['email']}}">
							</div>
							<div class="form-group">
								<input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile No." value="{{$data['mobile']}}">
							</div>
							<div class="text-center">
								<a href="javascript:void(0)" class="btn btn-theme button-1 ctm-border-radius text-white text-center" id="update_profile">Update Profile</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 d-flex">
					<div class="card ctm-border-radius shadow-sm grow flex-fill">
						<div class="card-header">
							<h4 class="card-title mb-0">Change Password</h4>
							<span class="ctm-text-sm">Your password needs to be at least 8 characters long.</span>
						</div>
						<div class="card-body">
							<span class="password_error text-danger"></span>
							<div class="form-group">
								<input type="text" class="form-control" id="current_password" placeholder="Current Password" value="">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="New Password" id="password">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Repeat Password" id="repeat_password">
							</div>
							<div class="text-center">
								<a href="javascript:void(0)" class="btn btn-theme button-1 ctm-border-radius text-white text-center" id="change_password">Change My Password</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 d-flex">
					<div class="card ctm-border-radius shadow-sm grow flex-fill">
						
						<div class="card-header">
							<h4 class="card-title doc d-inline-block mb-0">Employee Signature</h4>
							<a href="javascript:void(0)" class="float-right doc-fold text-primary d-inline-block text-info" data-toggle="modal" data-target="#add-signature">Update Signature</a>
						</div>
						@if(!empty($data['signature']))
					<div class="card shadow-none">
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<div class="document-up">
										<img src="{{url('public/signature/'.$data['signature'])}}"  />

									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
					    	<!-- Add a Key Date Modal-->
							<div class="modal fade" id="add-signature">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<!-- Modal body -->
										<div class="modal-body">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title mb-3">Update Signature</h4>
											<form method="POST" enctype="multipart/form-data" id="signature-upload">
												<input type="hidden" name="csrf-token" value="{{csrf_token()}}">
												<input type="hidden" name="emp_id" value="{{Auth::user()->id}}">					
												<div class="form-group">
													<div class="input-group mb-3">
														<input class="form-control date-enter" type="file" name="signature" required>
													</div>
												</div>
												<button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-theme text-white ctm-border-radius float-right button-1">Update Signature</button>
											</form>
										</div>
									</div>
								</div>
							</div>

					
						
					</div>
				</div>

			</div>
		</div>

		<!-- /Tab5 -->
			<!-- Tab6-->
			<div class="tab-pane fade " id="v-pills-salary" role="tabpanel" aria-labelledby="v-pills-salary-tab">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
					<div class="card flex-fill ctm-border-radius shadow-sm grow">
						<div class="card-header">
							<h4 class="card-title mb-0">Bank Account Details</h4>
						</div>
						@if(!empty($emp_bank_account))
						<div class="card-body">
							<p class="card-text mb-3"><span class="text-primary">Account Full Name :</span> {{ucfirst($emp_bank_account['account_full_name'])}}</p>
							<p class="card-text mb-3"><span class="text-primary">Bank Account No :</span> {{$emp_bank_account['bank_account_no']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Bank Name :</span> {{$emp_bank_account['bank_name']}}</p>

							<p class="card-text mb-3"><span class="text-primary">IFSC Code :</span>{{ $emp_bank_account['ifsc_code']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Branch Name : </span>{{ucfirst($emp_bank_account['branch_name'])}}</p>
							<p class="card-text mb-3"><span class="text-primary">address :</span> {{$emp_bank_account['address']}}</p>

							<p class="card-text mb-3"><span class="text-primary">Pan Card No : </span> {{$emp_bank_account['pan_card_no']}}</p>
							<p class="card-text mb-3"><span class="text-primary">PF/UAN No : </span> {{$emp_bank_account['pf_or_uan_no']}}</p>
							<p class="card-text mb-3"><span class="text-primary">ESIC No : </span> {{$emp_bank_account['esic_no']}}</p>

						</div>
						@else
						 <p class="card-text mb-3 text-center">No Bank Account Details Available</p>
						@endif
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
					<div class="card flex-fill  ctm-border-radius shadow-sm grow">
						<div class="card-header">
							<h4 class="card-title mb-0">Salary Details</h4>
						</div>
						@if(!empty($emp_salary))
						<div class="card-body ">
							<p class="card-text mb-3"><span class="text-primary">Gross Salary : </span>{{$emp_salary['emp_salary']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Basic Salary : </span>{{$emp_salary['basic_salary']}}</p>

							<p class="card-text mb-3"><span class="text-primary">HRA : </span>{{$emp_salary['hra']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Medical Allowance : </span>{{$emp_salary['medical_allowance']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Conveyance : </span>{{$emp_salary['conveyance']}}</p>
							<p class="card-text mb-3"><span class="text-primary">Other Allowance : </span>{{$emp_salary['mix_allowance']}}</p>
							<!-- <p class="card-text mb-3"><span class="text-primary">Mobile Expenses: </span>{{$emp_salary['mobile_expenses']}}</p> -->
							<p class="card-text mb-3"><span class="text-primary">TDS : </span>{{$emp_salary['tds']}}</p>
							<p class="card-text mb-3"><span class="text-primary">PF : </span>{{$emp_salary['pf']}}</p>
							<p class="card-text mb-3"><span class="text-primary">ESIC : </span>{{$emp_salary['esic']}}</p>

						</div>
						@else
						   <p class="card-text mb-3 text-center">No Salary Details Available</p>
						@endif
					</div>
				</div>
				<div class="col-xl-12 col-lg-12 col-md-12 d-flex">
					<div class="card flex-fill  ctm-border-radius shadow-sm grow">
						<div class="card-header">
							<h4 class="card-title mb-0">Salary Slip</h4>
						</div>
						<div class="card-body">
						<div class="table-responsive">
					<table class="table custom-table mb-0">
						<thead>
							<tr>
								<th>Month</th>
								<th>Action</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($emp_payment as $value)
							<tr>
								<td>{{date('F Y',strtotime($value['month']))}}</td>
								<td>
									<a href="{{url('emp_salary_slip/'.$value->id)}}" class="btn btn-sm btn-outline-success" >
											<span class="lnr lnr-download"></span>Download
									</a>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>

										</div>
					</div>
				</div>
			


			</div>
		</div>
		<!-- /Tab6-->

	</div>
</div>
@endsection

@section('javascript')
<script>
	$(document).ready(function() {
		$(document).on('click', '.permission', function(e) {
			e.preventDefault();
			var sidebar_id = $(this).val();
			var emp_id = $(this).data('emp_id');
			$.ajax({
				Type: "POST",
				url: '{{url("/update/permission")}}',
				dataType: 'json',
				cache: true,
				data: {
					emp_id: emp_id,
					sidebar_id: sidebar_id
				},
				success: function(response) {
					if (response.status == 400) {
						toastr.error(response.error);

					} else {
						location.reload();
						toastr.success(response.success);

					}
				}
			})


		});

	});
</script>

<script>
	$(document).ready(function(e) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
			}
		});
		$(document).on('submit', '#signature-upload', function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			// alert(formData);
			$.ajax({
				type: 'POST',
				url: "{{url('update_signature')}}",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					this.reset();
					if (data.status == 200) {
						toastr.success(data.success);
						$('.modal-backdrop').hide();
						$('.modal').hide();
						setTimeout(function() {
							location.reload();
						}, 1000);
					} else {
						toastr.error(data.error);

					}
				},
			});
		});
		$(document).on('submit', '#document-upload', function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			// alert(formData);
			$.ajax({
				type: 'POST',
				url: "{{url('upload_document')}}",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					this.reset();
					if (data.status == 200) {
						toastr.success(data.success);
						$('.modal-backdrop').hide();
						$('.modal').hide();
						setTimeout(function() {
							location.reload();
						}, 1000);
					} else {
						toastr.error(data.error);

					}
				},
			});
		});

		$(document).on('submit', '#document-update', function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				type: 'POST',
				url: "{{url('update_document')}}",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					this.reset();
					if (data.status == 200) {
						toastr.success(data.success);
						$('.modal-backdrop').hide();
						$('.modal').hide();
						setTimeout(function() {
							location.reload();
						}, 1000);
					} else {
						toastr.error(data.error);
					}
				},
			});
		});





	});
</script>
<script>
	$(document).ready(function() {


		var readURL = function(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('.profile-pic').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}


		$(".file-upload").on('change', function(e) {
			readURL(this);
			$('#formsubmmit').click();
		});

		$(".upload-button").on('click', function() {
			$(".file-upload").click();
		});
	});
</script>

<script>
	$(document).ready(function() {

		$(document).on('click', '#update_profile', function() {
			var name = $('#name').val();
			var email = $('#email').val();
			var mobile = $('#mobile').val();
			$.ajax({
				Type: "GET",
				url: '{{url("update_profile")}}',
				dataType: 'json',
				cache: false,
				data: {
					name: name,
					email: email,
					mobile: mobile
				},
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

		$(document).on('click', '#change_password', function() {
			var current_password = $('#current_password').val();
			var password = $('#password').val();
			var repeat_password = $('#repeat_password').val();
			$.ajax({
				Type: "GET",
				url: '{{url("update_password")}}',
				dataType: 'json',
				cache: false,
				data: {
					current_password: current_password,
					password: password,
					repeat_password: repeat_password
				},
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

		$(document).on('submit', '#image-upload', function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			console.log(formData);
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
				}
			});
			$.ajax({
				type: 'POST',
				url: "{{url('update_profile_image')}}",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					this.reset();
					if (data.status == 200) {
						toastr.success(data.success);

						// setTimeout(function(){ location.reload(); },1000);
					} else {
						toastr.error(data.error);

					}
				},
			});
		});

	});
</script>
@stop