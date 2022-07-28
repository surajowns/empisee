@extends('master')
@section('title','Account Details')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="card shadow-sm ctm-border-radius grow">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="card-title mb-0 d-inline-block">Bank Account Details</h4>

			<a href="#" class="btn btn-theme button-1 ctm-border-radius text-white float-right" data-toggle="modal" data-target="#add-information"><span></span> <span class="fa fa-plus"></span>Add Account Details</a>
		</div>
			<div class="card-header d-flex align-items-center justify-content-between">
		<form class="input-group" action="{{url('bank_details_report')}}" method="get" >
			<div class="container row">
			<div class="input-group col-sm-6">
				<select class="form-control select select_employee" id="emp_id" name="emp_id[]" multiple="multiple">
					<!-- <option value="">Select Employee </option> -->
					@foreach($employee as $value)
					<option value="{{$value['id']}}"> {{strtoupper($value['name'])}}</option>
					@endforeach
				</select>
			</div>
			
			 <div class="input-group col-sm-6">
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

									<th>Emp. Name</th>
									<th>Account Full Name</th>
									<th>Bank Account No.</th>
									<th>Bank Name</th>
									<th>IFSC Code</th>
									<th>Branch Name</th>
									<th>Address</th>
									<th>Pan Card No.</th>
									<th>PF/UAN No.</th>
									<th>ESIC No.</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="table_data">
								@foreach($emp_assets as $value)
								<tr>

									<td>{{$value['employee']['name']}}</td>
									<td>{{$value->account_full_name}}</td>
									<td>{{$value->bank_account_no}}</td>
									<td>{{$value->bank_name}}</td>
									<td>{{$value->ifsc_code}}</td>
									<td>{{$value->branch_name}}</td>
									<td>{{$value->address}}</td>
									<td>{{$value->pan_card_no}}</td>
									<td>{{$value->pf_or_uan_no}}</td>
									<td>{{$value->esic_no}}</td>
									<td>
										<a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets" data-toggle="modal" data-id="{{$value->id}}" data-target="#edit-information{{$value->id}}">
											<span class="lnr lnr-pencil"></span>Edit
										</a>
										<!-- <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger delete-assets"  data-id="{{$value->id}}">
												<span class="lnr lnr-trash"></span>Delete
											</a> -->
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
					<h4 class="modal-title mb-3"> Employee Bank Account Details</h4>
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
								<input class="form-control" type="text" name="account_full_name" min="1" placeholder="Account Full Name">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="number" name="bank_account_no" min="1" maxlength="4" placeholder="Bank Account No">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control ifsc_code" type="text" name="ifsc_code"   pattern="^[A-Z]{4}0[A-Z0-9]{6}$" min="1" placeholder="IFSC Code">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control bank_name" type="text" name="bank_name"    min="1" placeholder="Bank Name">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control branch_name" type="text" name="branch_name" min="1" placeholder="Branch Name">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control address" type="text" name="address" min="1" placeholder="Address">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="text" name="pan_card_no" min="1" placeholder="Pan Card No.">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="text" name="pf_or_uan_no" min="1" placeholder="PF/UAN">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="text" name="esic_no" min="1" placeholder="ESIC No">
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="input-group mb-3">
								<input class="form-control" type="text" name="remarks" placeholder="Remarks">
							</div>
						</div> -->
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
					url: '{{url("add_bank_account")}}',
					dataType: 'json',
					cache: false,
					data: $('#company_form').serialize(),
					success: function(response) {
						console.log(response);
						if (response.status == 200) {

							var html = '<tr>';
							html += '<td>' + response.last_data.employee.name + '</td>';
							html += '<td>' + response.last_data.account_full_name + '</td>';
							html += '<td>' + response.last_data.bank_account_no + '</td>';
							html += '<td>' + response.last_data.bank_name + '</td>';
							html += '<td>' + response.last_data.ifsc_code + '</td>';
							html += '<td>' + response.last_data.branch_name + '</td>';
							html += '<td>' + response.last_data.address + '</td>';
							html += '<td>' + response.last_data.pan_card_no + '</td>';
							html += '<td>' + response.last_data.pf_or_uan_no + '</td>';
                            html += '<td>' + response.last_data.esic_no + '</td>';
							html += '<td><a href="javascript:void(0);" class="btn btn-sm btn-outline-success edit_assets " data-toggle="modal" data-id="' + response.last_data.id + '" data-target="#edit-information' + response.last_data.id + '"><span class="lnr lnr-pencil"></span>Edit</a></td></tr>';
							$('#table_data').prepend(html);
							toastr.success(response.success);
							$('.modal-backdrop').hide();
							$('.modal').hide();
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
					url: '{{url("update_bank_account")}}',
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
					url: '{{url("updatemodal_bank_account")}}',
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



			$(document).on('keyup', '.ifsc_code', function(e) {
				var ifsc_code = $(this).val();
				if(ifsc_code.length==11){
				const Http = new XMLHttpRequest();
					const url='https://ifsc.razorpay.com/'+ifsc_code;
					Http.open("GET", url);
					Http.send();
					Http.onreadystatechange = (e) => {
						var response=$.parseJSON(Http.responseText);
						console.log(response);
					    $('.branch_name').val(response.BRANCH);
						$('.bank_name').val(response.BANK);
						$('.address').val(response.ADDRESS);


						
					}
			      }else{
					$('.branch_name').val('');
					$('.bank_name').val(''); 
					$('.address').val('');
 
				  }
			});



		});
	</script>
	@stop