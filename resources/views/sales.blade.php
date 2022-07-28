@extends('master')
@section('title','Sales')
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
			<h4 class="card-title mb-0 d-inline-block">Sales Dashboard</h4>
			<a href='{{url("public/sample.xlsx")}}' target="_blank">Download Sample Sheet</a>

			<form  method="POST" action="{{url('import')}}"  enctype="multipart/form-data">
             @csrf
			<div class="row">
			<input type="hidden" class="form-control" name="emp_id[]" id="emp_id" value="{{$id}}">
			<div class="input-group col-sm-6">
				<input type="file" name="import_file" id="import_file" required>
			</div>
			 <div class="col-sm-6">
				<button class="btn btn-theme button-1 ctm-border-radius text-white float-right" id=""><span></span> <span class="lnr lnr-paperclip"></span>Import</button>
			</div>
			</div>
          </form>		</div>
		<div class="card-header d-flex align-items-center justify-content-between">
		<form  action="{{url('sales_export')}}" method="get" class="container">
			<div class="row">
			<div class="input-group col-sm-8">
		     	<input type="hidden" class="form-control" name="emp_id[]" id="emp_id" value="{{$id}}">
				 <div class="input-group  input-daterange">
				<input type="date" class="form-control" name="from" id="from" required>
				<div class="input-group-addon">to</div>
				<input type="date" class="form-control" name="to" id="to" required>
			</div>
			</div>
			 <div class="col-sm-4">
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
									<th>Serial No</th>
									<th>Date</th>
									<th>Company Name</th>
									<th>Contact Person</th>
									<th>Designation</th>
									<th>Contact No.</th>
									<th>Contact Email</th>
									<th>Address</th>
									<th>Remarks</th>
								</tr>
							</thead>
							<tbody id="table_data">
                                @foreach($sales as $value)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{date('j/n/Y',strtotime($value->date))}}</td>
									<td>{{$value->company_name}}</td>
									<td>{{$value->contact_person}}</td>
									<td>{{$value->designation}}</td>
									<td>{{$value->contact_no}}</td>
									<td>{{$value->contact_email}}</td>
									<td>{{$value->address}}</td>
									<td>{{$value->remarks}}</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	