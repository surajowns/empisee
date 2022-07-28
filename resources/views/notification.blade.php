@extends('master')
@section('title',' Notifications')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
    <div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white p-4 mb-4 card">
        <h4 class="card-title float-left mb-0 mt-2">Notifications</h4>
    </div>
    @if(!empty($notification))
    <div class="row">
        @foreach($notification as $val)
        <div class="col-md-12">
            <div class="{{!in_array($emp_id,json_decode($val->seen_by))?'card':''}} ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-body">
                    <p>{{$val->content}}. <a href="{{url('notification_details/'.$val->type)}}">Read More....</a></p>
                    <span class="text-danger" style="font-size:10px;"> {{date('d/m/y',strtotime($val->created_at))}}({{date('l',strtotime($val->created_at))}}) - {{date('h:s A',strtotime($val->created_at))}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $notification->links() }}
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-body">
                    <p>There is no notifications</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection