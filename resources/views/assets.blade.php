@extends('master')
@section('title','Assets Details')
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
			<h4 class="card-title mb-0 d-inline-block">Employee Assets Details</h4>

			<a href="#" class="btn btn-theme button-1 ctm-border-radius text-white float-right" data-toggle="modal" data-target="#add-information"><span></span> <span class="fa fa-plus"></span>Assign</a>
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
									<th>Product Name</th>
									<th>Model</th>
									<th>Quantity</th>
									<th>Remarks</th>
									<th>Allotted Date</th>
									<th>Return Date</th>
									<th>Status</th>
									<th>Status Changed By</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="table_data">
								@foreach($emp_assets as $value)
								<tr>

									<td>{{$value['employee']['name']}}</td>
									<td>{{$value->product_name}}</td>
									<td>{{$value->model_no}}</td>
									<td>{{$value->quantity}}</td>
									<td>{{$value->remarks}}</td>
									<td>{{date('d-m-Y',strtotime($value->allotted_date))}}</td>
									<td>{{$value->return_date}}</td>
									<td class="text-danger">
										@if(count($permission)>0)
										{{ Form::open(array('url' => '/update_assets_status')) }}
										<input type="hidden" name="assets_id" value="{{$value->id}}">
										<select name="status_change" class="btn btn-theme ctm-border-radius text-white btn-sm" data-style="btn-primary" onchange="this.form.submit()">
											@foreach($asset_status as $name)
											<option value="{{$name->id}}" @if($name->id == $value['status']){{'selected'}} @endif>{{$name->name}}</option>
											@endforeach
										</select>
										{{ Form::close() }}
										@else
										@foreach($asset_status as $name)
										@if($name->id == $value['status']){{$name->name}} @endif
										@endforeach
										@endif
									</td>
									<td>{{$value->action_by}}</td>
									<td>
										<a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets" data-toggle="modal" data-id="{{$value->id}}" data-target="#edit-information{{$value->id}}">
											<span class="lnr lnr-pencil"></span>Edit
										</a>
										<a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-assets" data-id="{{$value->id}}">
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
					<h4 class="modal-title mb-3">Assign assets to employee</h4>
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
								<input class="form-control" type="text" name="product_name" placeholder="Product Name">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="quantity" min="1" placeholder="Quantity">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control " type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="allotted_date" placeholder="Allotted Date">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="text" name="model_no" placeholder="Model Number">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control " type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="return_date" placeholder="Return Date">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="text" name="remarks" placeholder="Remarks">
							</div>
						</div>
						<button type="button" class="btn btn-danger text-white ctm-border-radius float-right ml-3" data-dismiss="modal">Cancel</button>
						<button type="button" type="submit" class="btn btn-theme ctm-border-radius text-white float-right button-1" id="assing_assets">Add</button>
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

			$(document).on('click', '#assing_assets', function(e) {

				$.ajax({
					Type: "GET",
					url: '{{url("assign_assets")}}',
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
							html += '<td><a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets " data-toggle="modal" data-id="' + response.last_data.id + '" data-target="#edit-information' + response.last_data.id + '"><span class="lnr lnr-pencil"></span>Edit</a><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-assets "  data-id="' + response.last_data.id + '" ><span class="lnr lnr-trash"></span>Delete</a></td></tr>';
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
					url: '{{url("update_assets")}}',
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
					url: '{{url("update_modal_assets")}}',
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

			$(document).on('click', '.delete-assets', function(e) {
				var assets_id = $(this).data("id");
				if (confirm("Do You Want to Remove The Assets")) {
					$(this).closest('tr').remove();
					$.ajax({
						Type: "GET",
						url: '{{url("delete_assets")}}',
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