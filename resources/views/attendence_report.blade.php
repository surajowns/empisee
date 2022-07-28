@extends('master')
@section('title','Attendence Report')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
	<div class="card shadow-sm ctm-border-radius grow">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="card-title mb-0 d-inline-block">{{$employee['name']}} Attendence Report</h4>
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
		<div class="card-body align-center">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="employee-office-table">
					<div class="table-responsive">
						<table class="table custom-table table-hover">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Date</th>
									<th>Status</th>
									<th>Clock In</th>
									<th>Clock Out</th>
									<th>Work Duration</th>
									<th>Message</th>
									<th>Actions</th>
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
									<td>
										<div class="table-action">
	<!-- <a href="edit-review.html" class="btn btn-sm btn-outline-success">
										<span class="lnr lnr-pencil"></span> Approve
									</a> -->
									
									{{ Form::open(array('url' => '/attendencestatus')) }}
									<input type="hidden" name="clock_id" value="{{$value['id']}}">
									<select name="status_change" class="btn btn-theme ctm-border-radius text-white btn-sm" data-style="btn-primary" onchange="this.form.submit()">
										@foreach($attendencestatus as $name)
										<option value="{{$name->id}}" @if($name->id == $value['status']){{'selected'}} @endif>{{$name->name}}</option>
										@endforeach
									</select>
									{{ Form::close() }}
								</div>
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
@endsection