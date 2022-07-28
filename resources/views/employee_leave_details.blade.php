@extends('master')
@section('title','Employee Leave Details')
@section('content')
<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [27])->get();
//    dd($permission)
?>
<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="card shadow-sm ctm-border-radius grow">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="card-title mb-0 d-inline-block">Employee Leave Details</h4>

			<a href="#" class="btn btn-theme button-1 ctm-border-radius text-white float-right" data-toggle="modal" data-target="#add-information"><span></span> <span class="fa fa-plus"></span>Add Leave Details</a>
		</div>
		<div class="card-header d-flex align-items-center justify-content-between">
		<form  action="{{url('assets_report')}}" method="get">
			<div class="row">
			<div class="input-group col-sm-6">
				<select class="form-control select select_employee" id="emp_id" name="emp_id[]" multiple="multiple">
					<option value="">Select Employee </option>
					@foreach($employee as $value)
					<option value="{{$value['id']}}"> {{strtoupper($value['name'])}}</option>
					@endforeach
				</select>
			</div>
			 <div class="col-sm-6">
				<button class="btn btn-theme button-1 ctm-border-radius text-white float-right" id=""><span></span> <span class="lnr lnr-paperclip"></span> Export Reports</button>
			</div>
			</div>
          </form>
		  </div>
		<div class="card-body align-center">
			<div class="tab-content" id="v-pills-tabContent">

				<div class="employee-office-table">
					<div class="table-responsive">
						<table class="table custom-table table-hover ">
							<thead>
								<tr>

									<th>Name</th>
									<th>Casual Leave</th>
									<th>Sick Leave</th>
									<th>CL In Bucket</th>
									<th>ML In Bucket</th>
									<!-- <th>Total Leave</th> -->
									<!-- <th>Total Taken</th> -->
									<!-- <th>Status</th>
									<th>Status Changed By</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="table_data">
								@foreach($emp_assets as $value)
								<tr>

									<td>{{$value['employee']['name']}}</td>
                                    <td>{{$value->casual_leave}}</td>
									<td>{{$value->sick_leave}}</td>
									
									<td>{{$value->cl_taken}}</td>
									<td>{{$value->ml_taken}}</td>
                                    <!-- <td>{{$value->total_leave}}</td> -->
									<!-- <td>{{$value->cl_taken + $value->ml_taken}}</td> -->
									<td>
										<a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets" data-toggle="modal" data-id="{{$value->id}}" data-target="#edit-information{{$value->id}}">
											<span class="lnr lnr-pencil"></span>Edit
										</a>
										<a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-leave" data-id="{{$value->id}}">
											<span class="lnr lnr-trash"></span>Delete
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>

						</table>
						{{ $emp_assets->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- add Model -->
	<div class="modal fade" id="add-information" role="document">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<!-- Modal body -->
				<div class="modal-body style-add-modal">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title mb-3">Assign Leave to employee</h4>
					<form method="POST" id="company_form">
						<div class="form-group">
							<div class="input-group mb-3">
								<select class="form-control" id="emp_id" name="emp_id">
									<option value="">Select Employee </option>
									@foreach($employee as $value)
									<option value="{{$value->id}}"> {{strtoupper($value->name)}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="casual_leave" placeholder="Casual Leave">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="sick_leave" min="1" placeholder="Sick Leave">
							</div>
						</div>
					
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="cl_taken" placeholder="Casual Leave In Bucket">
							</div>
						</div>

						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="ml_taken" placeholder="Sick Leave In Bucket">
							</div>
						</div>
						<button type="button" class="btn btn-danger text-white ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
						<button type="button" type="submit" class="btn btn-theme ctm-border-radius text-white float-right button-1" id="assing_leave">Add</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- edit modal -->
	<div class="modal fade update_ajax_modal" id="add-information" role="document">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content editmodal">
				<!-- Modal body -->

			</div>
		</div>
	</div>



	@endsection
	@section('javascript')
	<script>
		$(document).ready(function() {

			$(document).on('click', '#assing_leave', function(e) {

				$.ajax({
					Type: "GET",
					url: '{{url("assign_leave")}}',
					dataType: 'json',
					cache: false,
					data: $('#company_form').serialize(),
					success: function(response) {
						console.log(response);
						if (response.status == 200) {

							var html = '<tr>';
							html += '<td>' + response.last_data.employee.name + '</td>';
							html += '<td>' + response.last_data.product_name + '</td>';
							html += '<td>' + response.last_data.model_no + '</td>';
							html += '<td>' + response.last_data.quantity + '</td>';
							html += '<td>' + response.last_data.remarks + '</td>';
							html += '<td>' + response.last_data.allotted_date + '</td>';
							html += '<td>' + response.last_data.return_date + '</td>';
							html += '<td>' + response.last_data.action_by + '</td>';
							html += '<td><a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets " data-toggle="modal" data-id="' + response.last_data.id + '" data-target="#edit-information' + response.last_data.id + '"><span class="lnr lnr-pencil"></span>Edit</a><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-leave "  data-id="' + response.last_data.id + '" ><span class="lnr lnr-trash"></span>Delete</a></td></tr>';
							$('#table_data').prepend(html);
							toastr.success(response.success);
							$('.modal-backdrop').hide();
							$('.modal').hide();
							location.reload();
							// setTimeout(function(){ location.reload(); },1000);

						} else {
							toastr.error(response.error);
						}
					}
				})
			});

			$(document).on('click', '.update_assets', function(e) {
				var asset_id = $(this).data("asset_id");
				$.ajax({
					Type: "GET",
					url: '{{url("update_leave")}}',
					dataType: 'json',
					cache: false,
					data: $('#update_form' + asset_id).serialize(),
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


			$(document).on('click', '.edit_assets', function(e) {
				var id = $(this).data("id");
				$.ajax({
					Type: "GET",
					url: '{{url("update_modal_leave")}}',
					dataType: 'json',
					cache: false,
					data: {
						id: id
					},
					success: function(response) {
						console.log(response);
						$('.editmodal').html(response.html);
						$('.update_ajax_modal').modal('show');
					}
				})
			});

			$(document).on('click', '.delete-leave', function(e) {
				var assets_id = $(this).data("id");
				if (confirm("Do You Want to Remove The Assets")) {
					$(this).closest('tr').remove();
					$.ajax({
						Type: "GET",
						url: '{{url("delete_leaves")}}',
						dataType: 'json',
						cache: false,
						data: {
							assets_id: assets_id
						},
						success: function(response) {
							console.log(response);
							if (response.status == 200) {
								toastr.success(response.success);

								//   setTimeout(function(){ location.reload(); },1000);
							} else {
								toastr.error(response.error);
							}
						}
					})
				}
			});



		});
	</script>
	@stop