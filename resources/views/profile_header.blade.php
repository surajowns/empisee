<?php
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
	$query->where('parent_id', '!=', 0)->get();
}])->where('emp_id', $id)->whereIn('sidebar_id', [13, 15, 16, 18, 20])->get();


?>
@if(count($permission)>0)
<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white p-4 mb-4 card">
	<ul class="list-group list-group-horizontal-lg">
		@foreach($permission as $value)
		<li class="list-group-item text-center  {{Request::segment(1)==$value->sidebar[0]['slug']?'active button-5':'button-6'}}"><a href="{{url($value->sidebar[0]['slug'].'/'.Session::get('emp_id'))}}" class="{{Request::segment(1)==$value->sidebar[0]['slug']?'text-white':'text-dark'}}">{{$value->sidebar[0]['name']}}</a></li>
		<!-- <li class="list-group-item text-center button-6"><a href="details.html" class="text-dark">Detail</a></li> -->
		<!-- <li class="list-group-item text-center  {{Request::segment(1)=='document' ? ' active button-5':'button-6'}}"><a href="{{url('/document/'.Session::get('emp_id'))}}" class="{{Request::segment(1)=='document'?'text-white':'text-dark'}}">Document</a></li> -->
		<!-- <li class="list-group-item text-center {{Request::segment(1)=='employee_leave' ? ' active button-5':'button-6'}}"><a href="{{url('/employee_leave/'.Session::get('emp_id'))}}" class="{{Request::segment(1)=='employee_leave'?'text-white':'text-dark'}}">Leaves</a></li> -->
		<!-- <li class="list-group-item text-center button-6"><a href="profile-reviews.html" class="text-dark">Reviews</a></li> -->
		<!-- <li class="list-group-item text-center  {{Request::segment(1)=='profile_setting' ? ' active button-5':'button-6'}} "><a class="{{Request::segment(1)=='profile_setting'?'text-white':'text-dark'}}" href="{{url('/profile_setting/'.Session::get('emp_id'))}}">Settings</a></li> -->
		@endforeach
	</ul>
	<ul>

	</ul>
</div>
@endif