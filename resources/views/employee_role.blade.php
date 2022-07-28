@extends('master')
@section('title','Employee Role')
@section('content')
<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [10, 11])->get()->toArray();
//    dd($permission)

?>
<div class="col-xl-9 col-lg-8  col-md-12">
	@if($permission)
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
		<div class="card-body">
			<ul class="list-group list-group-horizontal-lg">
				@foreach($permission as $value)

				<li class="list-group-item text-center   {{Request::segment(1)==$value['sidebar'][0]['slug']?'active button-5':'button-6'}}"><a class="{{Request::segment(1)==$value['sidebar'][0]['slug']?'text-white':'text-dark'}}" href="{{url($value['sidebar'][0]['slug'])}}">{{$value['sidebar'][0]['name']}}</a></li>

				@endforeach
				<!-- <li class="list-group-item text-center button-6"><a class="text-dark" href="{{url('/department')}}">Department</a></li> -->
				<!-- <li class="list-group-item text-center button-6"><a class="text-dark" href="{{url('/role')}}">Role</a></li> -->
			</ul>
		</div>
	</div>
	@endif
	<div class="card shadow-sm grow ctm-border-radius">
		<div class="card-body align-center">
			<h4 class="card-title float-left mb-0 mt-2">{{count($data)}} Role</h4>
			<h6 class="error"></h6>
			<ul class="nav nav-tabs float-right border-0 tab-list-emp">
				<li class="nav-item pl-3">
					<a href="javascript:void(0)" class="btn btn-theme button-1 text-white ctm-border-radius p-2 add-person ctm-btn-padding" data-toggle="modal" data-target="#addTeam"><i class="fa fa-plus"></i> Add Role</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		@foreach($data as $value)
		<div class="col-md-6">
			<div class="ctm-border-radius shadow-sm grow card">
				<div class="card-header">
					<h4 class=" card-title d-inline-block mb-0 mt-2" id="{{$value->name}}">{{$value->name}}</h4>
					<div class="team-action-icon float-right">
						<span data-toggle="modal" data-target="#edit{{$value->id}}">
							<a href="javascript:void(0)" class="btn btn-theme text-white ctm-border-radius" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
						</span>
						<span data-toggle="modal" data-target="#delete">
							<a href="javascript:void(0)" class="btn btn-theme text-white ctm-border-radius" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
						</span>
					</div>
				</div>
				<div class="card-body">
					<span class="avatar" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$value->name}}"><img src="{{isset($value->profile_image)?url('public/profile/'.$value->profile_image):url('public/assets/img/profiles/1613731537.png')}}" alt="Maria Cotton" class="img-fluid"></span>

				</div>
			</div>
		</div>
		@endforeach

	</div>
</div>
<!-- The Modal -->
<div class="modal fade" id="addTeam">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mb-3">Create New Role</h4>
				<form action="" id="addepartment">
					<div class="form-group">
						<input type="text" class="form-control" name="name" id="role" placeholder="Name" required>
						<span class="text-danger error"></span>
					</div>

					<button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-theme button-1 ctm-border-radius text-white float-right" id="add_role">Add</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Add Members The Modal -->
<div class="modal fade" id="addmembers">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mb-3">Add Members</h4>
				<div class="form-group">
					<div class="input-group mb-3">
						<input class="form-control date-enter" type="text" placeholder="Name">
					</div>
				</div>
				<button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-theme button-1 text-white ctm-border-radius float-right">Add</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Modal -->
@foreach($data as $value)
<div class="modal fade" id="edit{{$value->id}}">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mb-3">Edit Role</h4>
				<div class="form-group">
					<input class="form-control" type="text" name="name" value="{{$value->name}}">
				</div>
				<button type="button" class="btn btn-danger ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-theme button-1 ctm-border-radius text-white float-right change_role" data-role_id="{{$value->id}}" data-role_name="{{$value->name}}">Save</button>
			</div>
		</div>
	</div>
</div>
@endforeach

<!--Delete The Modal -->
<div class="modal fade" id="delete">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<!-- Modal body -->
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title mb-4">Are You Sure Want to Delete?</h4>

				<button type="button" class="btn btn-danger ctm-border-radius text-center mb-2 mr-3" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-theme ctm-border-radius text-white text-center mb-2 button-1" data-dismiss="modal">Delete</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script>
	$(document).ready(function() {
		$(document).on('click', '#add_role', function() {
			var name = $('#role').val();
			$.ajax({
				Type: "GET",
				url: '{{url("add_role")}}',
				dataType: 'json',
				cache: false,
				data: {
					name: name
				},
				success: function(response) {
					console.log(response);
					if (response.status == 200) {
						toastr.success(response.success);
						$('.modal-backdrop').hide();
						$('.modal').hide();
						setTimeout(function() {
							location.reload();
						}, 1000);


					} else {
						toastr.error(response.error);
					}
				}
			})
		});


		$(document).on('click', '.change_role', function(e) {
			e.preventDefault();
			var role_name = $(this).data("role_name");
			var role_id = $(this).data("role_id");
			var name = $(this).prev().prev().children().val();
			$.ajax({
				Type: "GET",
				url: '{{url("change_role_name")}}',
				dataType: 'json',
				cache: false,
				data: {
					role_id: role_id,
					name: name
				},
				success: function(response) {
					console.log(response);
					if (response.status == 200) {
						toastr.success(response.success);
						$('.modal-backdrop').hide();
						$('.modal').hide();
						$('#' + role_name).text(name);

					} else {
						toastr.error(response.error);
					}
				}
			})
		});



	});
</script>
@stop