@extends('master')
@section('title','Leave Report')
@section('content')
<style>
	.profile_img {
		position: absolute;
	}

	.profile_name {
		position: relative;
		top: 1px;
		font-size: 17px;
		color: #fff;
		left: 1px;
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
}])->where('emp_id', $id)->whereIn('sidebar_id', [19])->get();
//    dd($permission)
?>
<div class="col-xl-9 col-lg-8  col-md-12">
	@include('profile_header')

	<div class="card ctm-border-radius shadow-sm grow">
		<div class="card-header">
			<h4 class="card-title mb-0"> Leaves</h4>
		</div>
		<div class="card-body">
			<div class="employee-office-table">
				<div class="table-responsive">
					<table class="table custom-table mb-0">
						<thead>
							<tr>
								<th>Employee</th>
								<th>Leave Type</th>
								<th>From</th>
								<th>To</th>
								<!-- <th>Days</th> -->
								<th>Notes</th>
								<th>Status</th>
								<th>Approved By</th>
								<!-- <th class="text-right">Action</th> -->
							</tr>
						</thead>
						<tbody>
							@foreach($empleaves as $value)
							<tr>
								<td>
									<a href="javascript:void(0)" class="avatar">
										<img class="profile_img" alt="avatar image" src="@if($value['employee']['profile_image']) {{url('public/profile/'.$value['employee']['profile_image'])}} @else {{url('public/assets/img/profiles/profile.png')}} @endif" class="img-fluid">
										<span class="profile_name">{{substr($value['employee']['name'], 0, 2)}}</span>
									</a>
									<h2><a href="javascript:void(0)">{{$value['employee']['name']}}</a></h2>
								</td>
								<td>{{$value['leave_type']}}</td>
								<td>{{date('d M Y',strtotime($value['from_date']))}}</td>
								<td>{{date('d M Y',strtotime($value['to_date']))}}</td>
								<?php $totaldays = (int)(date('d', strtotime($value['to_date'])) - date('d', strtotime($value['from_date']))); ?>
								<!-- <td>{{$totaldays==0?1:$totaldays}}</td> -->

								<td>{{$value['leave_reason']}}</td>
								<td class="text-danger">
									@if(count($permission)>0)
									{{ Form::open(array('url' => '/updatestatus')) }}
									<input type="hidden" name="leave_id" value="{{$value['id']}}">
									<select name="status_change" class="btn btn-theme ctm-border-radius text-white" data-style="btn-primary" onchange="this.form.submit()" style="width:auto">
										@foreach($leavestatus as $name)
										<option value="{{$name->id}}" @if($name->id == $value['status']){{'selected'}} @endif>{{$name->name}}</option>
										@endforeach
									</select>
									{{ Form::close() }}
									@else
									@foreach($leavestatus as $name)
									@if($name->id == $value['status']){{$name->name}} @endif
									@endforeach
									@endif

								</td>
								<td>{{$value['approved_by']}}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card ctm-border-radius shadow-sm grow flex-fill">
		<div class="card-header">
			<h4 class="card-title mb-0">Events List </h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-7 col-sm-6">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active history-btn" data-toggle="tab" href="#tabs-1" role="tab">Upcoming</a>
						</li>
						<li class="nav-item">
							<a class="nav-link history-btn" data-toggle="tab" href="#tabs-2" role="tab">History</a>
						</li>
					</ul>
				</div>
				<div class="col-md-5 col-sm-6">
					<div class="form-row form-group mt-3 mt-lg-0 mt-sm-0">
						<div class="col-sm-12">
							<!-- <select class="form-control select">
																<option selected>Apply Leave</option>
																<option>Working From Home</option>
																<option>Sick Leave</option>
																<option>Parental Leave</option>
																<option>Annual Leave</option>
																<option>Normal Leave</option>
															</select> -->
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="tab-content py-0" id="pills-tabContent">
						<div class="tab-pane py-0 active" id="tabs-1" role="tabpanel">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Date</th>
											<th>Event Name</th>
										</tr>
									</thead>
									<tbody>
										@foreach($upcommingholidays as $value)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{date('D',strtotime($value->start))}},&nbsp;&nbsp;{{date('d M Y',strtotime($value->start))}}</td>
											<td>{{$value->title}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane py-0" id="tabs-2" role="tabpanel">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Date</th>
											<th>Event Name</th>
										</tr>
									</thead>
									<tbody>
										@foreach($holidayhistory as $value)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{date('D',strtotime($value->start))}},&nbsp;&nbsp;{{date('d M Y',strtotime($value->start))}}</td>
											<td>{{$value->title}}</td>
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
	</div>

	@endsection