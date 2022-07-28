<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <p>Hello Mam/Sir,</p>

  <p class="font-weight-bold pb-2 mt-5"><span class="font-weight-normal">I am sending this request for your approval of system allotment  for our new employee {{$employee_details['name']}}.</span></p>
  <p class="font-weight-bold pb-2"><span class="font-weight-normal">Belows are details</span></p>
  <p class="font-weight-bold pb-2">Product details:<span class="font-weight-normal"> {{$last_data['product_name']}} &nbsp;{{$last_data['model']}} &nbsp;{{$last_data['remarks']}}</span></p>
  <p class="font-weight-bold pb-2">Quantity:<span class="font-weight-normal"> {{$last_data['quantity']}}</span></p>
  <p class="font-weight-bold mt-5">Allotment Date:<span class="font-weight-normal"> {{date('d-m-Y',strtotime($last_data['allotted_date']))}} </span></p>
  
  
  <p class="font-weight-bold pb-3"><img src="{{url('public/signature/'.$user['signature'])}}" alt="" ></p>

</body>

</html>