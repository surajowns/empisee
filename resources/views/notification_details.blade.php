@extends('master')
@section('title',' Notification Deatils')
@section('content')
<div class="col-xl-9 col-lg-8  col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card ctm-border-radius shadow-sm grow flex-fill">
                <div class="card-body">
                    <p class="font-weight-bold">Subject :<span class="font-weight-normal">{{$leave['leave_type']}}</span></p>
                    <p class="font-weight-bold">To :<span class="font-weight-normal"> nikita@besthawk.com,vaidehi@besthawk.com</span></p>
                    <p class="font-weight-bold pb-3">From :<span class="font-weight-normal"> {{$leave['employee']['email']}}</span></p>
                    <p class="font-weight-bold pb-2">Reason :<span class="font-weight-normal"> {{$leave['leave_reason']}}</p>
                    <p class="font-weight-bold">Leave Date :<span class="font-weight-normal"> {{date('d/m/y',strtotime($leave['from_date']))}} - {{date('d/m/y',strtotime($leave['to_date']))}} </span></p>
                    <p class="font-weight-bold pb-3">Leave Day :<span class="font-weight-normal">{{$leave['leave_day']}}</span></p>
                    <p class="font-weight-bold">Your Sincerly</p>
                    <p class="font-weight-bold"><span class="font-weight-normal">{{$leave['employee']['name']}}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection