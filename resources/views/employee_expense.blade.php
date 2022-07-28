@extends('master')
@section('title',' Employee Expense')
@section('content')
<?php
     $id=Auth::user()->id;
	 $permission=App\SidebarPermission::with(['sidebar'=>function($query){$query->where('parent_id','!=',0)->get();}])->where('emp_id',$id)->whereIn('sidebar_id',[22])->get();
 //    dd($permission)
?>
<div class="col-xl-9 col-lg-8 col-md-12">
	@include('profile_header')

	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card shadow-sm grow ctm-border-radius">
				<div class="card-body align-center">
					<h4 class="card-title float-left mb-0 mt-2">{{$employee['name']}} &nbsp;&nbsp;{{$employee['roles']['name']}} ({{$employee['emp_details'][0]['job_title']}})</h4>
					<ul class="nav nav-tabs float-right border-0 tab-list-emp">
						<li class="nav-item pl-3">
							<a href="{{url('users/export/')}}" class="btn btn-theme button-1 text-white ctm-border-radius p-2 add-person ctm-btn-padding"><i class="fa fa-cloud-upload"></i> Export</a>
						</li>
					</ul>
				</div>
			</div>

		</div>

		<div class="col-md-12">
			<div class="card ctm-border-radius shadow-sm grow">
				<div class="card-header">
					<h4 class="card-title mb-0">Expense Reports</h4>
				</div>
				<div class="card-body">
					<div class="employee-office-table">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Date</th>
										<th>Expense Type</th>
										<th>Amount</th>
										<th>Vendor Name</th>
										<th>Description</th>
										<th>Invoice</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($expense as $value)

									<tr>
										<td>{{Carbon\Carbon::createFromFormat('d/m/Y', $value->exp_date)->format('d M Y')}}</td>

										<td>{{$value->exp_type}}</td>
										<td>{{$value->amount}}</td>
										<td>{{$value->vendor_name}}</td>
										<td>{{$value->notes}}</td>
										<td>
											   <a href="{{url('public/expense/'.$value->exp_invoice)}}" class="without-caption image-link" target="_blank">
                                              <img src="{{url('public/expense/'.$value->exp_invoice)}}" width="172" height="115" />  
                                             </a>
										</td>
										<td>
																@if(count($permission)>0)
                                                                        {{ Form::open(array('url' => '/expensestatus')) }}
                                                                        <input type = "hidden" name = "expense_id" value = "{{$value['id']}}" >
                                                                        <select name = "status_change" class="btn btn-theme ctm-border-radius text-white" data-style="btn-primary" onchange = "this.form.submit()" style="width:auto"> 
                                                                        @foreach($expensetatus as $name) 
                                                                        <option  value = "{{$name->id}}" @if($name->id == $value['status']){{'selected'}} @endif>{{$name->name}}</option>
                                                                        @endforeach
                                                                        </select>
                                                                        {{ Form::close() }} 
																@else
																@foreach($expensetatus as $name)
                                                                         @if($name->id == $value['status']){{$name->name}} @endif
                                                                        @endforeach
																@endif	
																</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="drift-zoom"></div>

		</div>


		@endsection
		@section('javascript')
		<script>
			$(document).ready(function() {

				var driftAll = document.querySelectorAll('img');
				var pane = document.querySelector('.drift-zoom');
				$(driftAll).each(function(i, el) {
					let drift = new Drift(
						el, {
							zoomFactor: 6,
							paneContainer: pane,
							inlinePane: false,
							handleTouch: false
						}
					);
				});
				// 	 if ($("#employee_form").length > 0) {
				// $("#employee_form").validate({

				// 	rules: {
				// 		name: {
				// 			required: true,
				// 			maxlength: 50
				// 		},

				// 		email: {
				// 			required: true,
				// 			maxlength: 50,
				// 			email: true,
				// 		},

				// 		mobile: {
				// 			required: true,
				// 			minlength:10,
				// 			maxlength:10,
				// 			number:true,
				// 		},
				// 		password: {
				// 			required: true,
				// 			minlength:6,

				// 		},
				// 		gender:{
				// 			required:true,
				// 		},
				// 		d_o_b:{
				// 			required: true,
				// 		},
				// 		joining_date:{
				// 			required: true,
				// 		},
				// 		job_title:{
				// 			required:true,
				// 		},
				// 		department:{
				// 			required:true,
				// 		},
				// 		role:{
				// 			required:true,
				// 		},
				// 		emp_salary:{
				// 			required:true,
				// 			number:true,
				// 		}
				// 	},
				// 	messages: {

				// 		name: {
				// 			required: "Please enter  name",
				// 		},

				// 		email: {
				// 			required: "Please enter valid email",
				// 			email: "Please enter valid email",
				// 			maxlength: "The email  should less than or equal to 50 characters",
				// 		},
				// 		mobile: {
				// 			required: "Please enter mobile no.",
				// 			maxlength:"The mobile number should not be greater than 10 digit"
				// 		},
				// 		password: {
				// 			required: "Please enter  password",
				// 		},
				// 		gender:{
				// 			required:"Please select gender",
				// 		},
				// 		d_o_b:{
				// 			required:"Please select date of birth",
				// 		},
				// 		joining_date:{
				// 			required: "Please select joining date",
				// 		},
				// 		job_title:{
				// 			required: "Please enter job title",
				// 		},
				// 		department:{
				// 			required:"Please select Department"
				// 		},
				// 		role:{
				// 			required:"please select Role",
				// 		},
				// 		emp_salary:{
				// 			required:"Please enter salary",
				// 			number:"Salery should be number",
				// 		}

				// 	},
				// })
				// }

				$('#expense_report').on('submit', function(e) {
					e.preventDefault();
					var formData = new FormData(this);
					alert(formData);
					alert($('form').serialize());
					$.ajaxSetup({
						header: {
							'X-CSRF-TOKEN': $("input[name='token]").attr('value'),
							'Content-Type': 'multipart/form-data',
						}
					});
					$.ajax({
						Type: "POST",
						url: '{{url("add_expense")}}',
						enctype: 'multipart/form-data',
						data: formData,
						cache: false,
						processData: false,
						contentType: false,
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

			});
		</script>


		@stop