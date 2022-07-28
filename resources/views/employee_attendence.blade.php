@extends('master')
@section('title','Attendence Report')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
	@include('profile_header')

	<div class="card shadow-sm ctm-border-radius grow">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h4 class="card-title mb-0 d-inline-block">{{$employee['name']}} Attendence Report</h4>
			<a href="#" class="btn btn-theme button-1 ctm-border-radius text-white float-right"><span></span> <span class="lnr lnr-paperclip"></span> Export Reports</a>
		</div>
		<div class="card-body align-center">
			<div class="tab-content" id="v-pills-tabContent">

				<div class="employee-office-table">
					<div class="table-responsive">
						<table class="table custom-table table-hover">
							<thead>
								<tr>
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
									<td>{{date('d-m-Y' ,strtotime($value->created_at))}} ({{date('D' ,strtotime($value->created_at))}})</td>
									<td>
										<h2>P</h2>
									</td>
									<td>{{date('h:i A' ,strtotime($value->clock_in))}}</td>
									<td>{{ isset($value->clock_out)?date('h:i A' ,strtotime($value->clock_out)):'_'}}</td>
									<td>@if($value->clock_out){{date('H' ,strtotime($value->clock_out))-date('H' ,strtotime($value->clock_in))}}&nbsp;&nbsp;Hours {{date('i' ,strtotime($value->clock_out))-date('i' ,strtotime($value->clock_in))}}&nbsp;&nbsp;Mins @else -@endif</td>
									<td>
										-
									</td>
									<td>
										<div class="table-action">
											<a href="edit-review.html" class="btn btn-sm btn-outline-success">
												<span class="lnr lnr-pencil"></span> Approve
											</a>
											<a href="javascript:void(0);" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete">
												<span class="lnr lnr-trash"></span> Reject
											</a>
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