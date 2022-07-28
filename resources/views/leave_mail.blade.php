<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
      <p>Hello Mam/Sir,</p>
      <p class="font-weight-bold pb-2">Reason :<span class="font-weight-normal"> {{$leavedetails['leave_reason']}}</span></p>
      <p class="font-weight-bold">Leave Date :<span class="font-weight-normal"> {{date('d/m/y',strtotime($leavedetails['from_date']))}} - {{date('d/m/y',strtotime($leavedetails['to_date']))}} </span></p>
      <p class="font-weight-bold pb-3">Leave Day :<span class="font-weight-normal">{{$leavedetails['leave_day']}}</span></p>
      <p class="font-weight-bold pb-3"><img src="{{url('public/signature/'.$user['signature'])}}" alt="" ></p>

</body>

</html>