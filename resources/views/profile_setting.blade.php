@extends('master')
@section('title',' Profile Settings')
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
	@include('profile_header')
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

	</div>
</div>
@endsection
@section('javascript')
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