@extends('master')
@section('title',' Employee')
@section('content')

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

	@if(count($permission)>0)
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
		<div class="card-body">
			<ul class="list-group list-group-horizontal-lg">
				@foreach($permission as $value)
				@if($value->sidebar_id==10 || $value->sidebar_id==11)
				<li class="list-group-item text-center button-6"><a class="text-dark" href="{{url($value->sidebar[0]['slug'])}}">{{$value->sidebar[0]['name']}}</a></li>
				@endif
				@endforeach
			</ul>
		</div>
	</div>
	@endif
	<div class="card shadow-sm grow ctm-border-radius">
		<div class="card-body align-center">
			<h4 class="card-title float-left mb-0 mt-2">{{count($employee)}} Employees</h4>
			<ul class="nav nav-tabs float-right border-0 tab-list-emp">
				<li class="nav-item pl-3">
					@if($permission)
					@foreach($permission as $value)
					@if($value->sidebar_id ==12 )
					<a href="{{isset($value->sidebar[0])?url($value->sidebar[0]['slug']):'javascript:void(0)'}}" class="btn btn-theme button-1 text-white ctm-border-radius p-2 add-person ctm-btn-padding"><i class="fa fa-plus"></i> {{$value->sidebar[0]['name']}}</a>
					@endif
					@endforeach
					@endif
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
			{{ $employee->links() }}
			<hr>
			<div class="row people-grid-row">
				@foreach($employee as $value)
				<div class="col-md-6 col-lg-6 col-xl-4" id="myDIV">
					<div class="card widget-profile">
						<div class="card-body">
							<div class="pro-widget-content text-center">
								<div class="profile-info-widget">
								    
								    @if(count($permission)>0)
									@foreach($permission as $permissionvalue)
									@if($permissionvalue->sidebar_id ==28)
							     	<div class="custom-control custom-switch float-left">
											<input type="checkbox" class="custom-control-input permission" id="view{{$value['id']}}" data-emp_id="{{$value['id']}}"  value="{{$value['status']}}" @if($value['status']==1) checked @endif>
											<label class="custom-control-label" for="view{{$value['id']}}"></label>
								   </div>
                                   @endif
								   @endforeach
								   @endif
									@if(count($permission)>0)
									@foreach($permission as $permissionvalue)
									@if($permissionvalue->sidebar_id ==13 )
									<a href="{{isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'}}" class="booking-doc-img">
										<img class="profile_img" src="{{isset($value['profile_image'])?url('public/profile/'.$value['profile_image']):url('public/assets/img/profiles/profile.png')}}" alt="{{$value['name']}}">
										<span class="profile_name">{{substr($value['name'], 0, 2)}}</span>
									</a>
									@endif
									@endforeach
									@else
									<a href="{{isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'}}" class="booking-doc-img">
										<img class="profile_img" src="{{isset($value['profile_image'])?url('public/profile/'.$value['profile_image']):url('public/assets/img/profiles/profile.png')}}" alt="{{$value['name']}}">
										<span class="profile_name">{{substr($value['name'], 0, 2)}}</span>
									</a>
									@endif
									@if($permission)
									@foreach($permission as $permissionvalue)
									@if($permissionvalue->sidebar_id == 14)
									<div class="team-action-icon float-right">
										<span data-toggle="modal" data-target="#edit">
											<a href="{{isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'}}" class="btn btn-theme text-white ctm-border-radius" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
										</span>
									</div>
									@endif
									@endforeach
									@endif
									<div class="profile-det-info">
										@if(count($permission)>0)
										@foreach($permission as $permissionvalue)
										@if($permissionvalue->sidebar_id == 13)
										<h4><a href="{{isset($permissionvalue->sidebar[0])?url($permissionvalue->sidebar[0]['slug'].'/'.$value['id']):'javascript:void(0)'}}" class="text-primary">{{$value['name']}}</a></h4>
										@else
										@endif
										@endforeach
										@else
										<h4><a href="javascript:void(0)" class="text-primary">{{$value['name']}}</a></h4>

										@endif
										<div>
											<p class="mb-0"><b>{{$value['emp_details'][0]['job_title']}}</b></p>
											<p class="mb-0 ctm-text-sm">{{$value['email']}}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>

		</div>
	</div>
</div>
@endsection
@section('javascript')
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
				url: '{{url("/update/employee/status")}}',
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
@stop