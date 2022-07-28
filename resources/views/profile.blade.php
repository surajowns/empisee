@extends('master')
@section('title',' Profile')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
	@include('profile_header')
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
@endsection