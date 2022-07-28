@extends('master')
@section('title',' Manage')
@section('content')

<div class="col-xl-9 col-lg-8 col-md-12">
	<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
		<div class="card-body">
	   	<div class="mb-5">
			    <input class="form-control float-right" id="myInput" type="text" placeholder="Search..">
			</div>
		</div>
	</div>
	<div class=" row people-grid-row">
		@foreach($employee as $value)
		<div class="col-xl-6 col-lg-6 col-md-6 d-flex">
			<div class="card ctm-border-radius shadow-sm grow flex-fill" id="myDIV">
				<div class="card-header">
					<h4 class="card-title mb-0">{{$value['name']}}</h4>
				</div>
				<div class="card-body">
					<div class="mt-2">
					             <a href="javascript:void(0)" class="avatar">
												<img class="profile_img" alt="avatar image" src="@if($value['profile_image']) {{url('public/profile/'.$value['profile_image'])}} @else {{url('public/assets/img/profiles/profile.png')}} @endif" class="img-fluid">
												<span class="profile_name">{{substr($value['name'], 0, 2)}}</span>
											</a>
						<a href="{{url('/manage/permission/'.$value['id'])}}" class="btn btn-theme button-1 ctm-border-radius text-white float-right text-white">View Permissions</a>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection
@section('javascript')
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myDIV ").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@stop