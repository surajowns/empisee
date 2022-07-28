<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta name="viewport" content="width=device-width" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="{{url('public/assets/css/bootstrap.min.css')}}">
   </head>
   <body class="size-1140">
      <style type="text/css">
       @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
       * {
         margin: 0;
         box-sizing: border-box;
         -webkit-print-color-adjust: exact;
         }
         body {
         /* background: #e0e0e0; */
         font-family: "Roboto", sans-serif;
         }
         ::selection {
         background: #f31544;
         color: #fff;
         }
         ::moz-selection {
         background: #f31544;
         color: #fff;
         }
table {
         width: 100%;
         border-collapse: collapse;
         }
         td {
         padding: 10px;
         border-bottom: 1px solid #cccaca;
         font-size: 0.7em;
         /* text-align: left; */
         }
         th {
         font-size: 0.7em;
         /* text-align: left; */
         padding: 5px 10px;
         }
         .table td,
         .table th {
         padding: .25rem;
         vertical-align: top;
         border: 2px solid #333;
         }
         .table td,
         .table th {
         /* padding: .25rem; */
         }
         tr:hover {background-color:#f5f5f5;}
         .space {margin-top: 100px !important;}
         .container {margin:0 5%;}
         .lunch_break_icon {
         width: 12%;
         /* margin-left: 5px; */
         }
         #table {
         /*white-space: nowrap;*/
         overflow: auto;
         }
         @page {margin: 2.5cm 2cm 2cm;}
         /* body{
         width: auto;
         font-family: Georgia, serif;
         font-size: 14px;
         line-height: 1.42857143;
         } */
      </style>
        <section class="user-dashbord" style="margin-top:200px;">
            <div class="container">
            <div id="invoiceholder">
         <div id="invoice" class="">
            <div id="invoice-bot">
               <div id="table">
            <table class="table table-bordered">
                     <tr class="list-item">
                        <th colspan="4" class="tableitem text-center" style="font-size: x-large;"> <b>BEST HA<span style="color:red;">W</span>K INFOSYSTEMS PRIVATE LIMITED</b></th>
                     </tr>
                     <tr class="list-item">
                        <th colspan="4" class="tableitem text-center"> F-133/2, GROUND FLOOR, SHAHEEN BAGH ABUL FAZAL ENCLAVE-II, </th>
                     </tr>
                     <tr class="list-item">
                        <th colspan="4" class="tableitem text-center"> JAMIA NAGAR NEW DELHI South West Delhi DL 110025 IN</th>
                     </tr>
                     <tr class="list-item">
                        <th colspan="4" class="tableitem text-center"> Pay Slip of {{date('F Y',strtotime($emp_payments->month)) }} </th>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem text-left">Employee Name : </th>
                        <td>{{ $emp_payments->employee->name }}</td>
                        <th> Employee Code :</th>
                        <td>{{ $emp_payments->employee->emp_code }}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Designation :</th>
                        <td>{{ $emp_payments->employee->emp_details[0]['job_title'] }}</td>
                        <th> Department</th>
                        <td>{{$department['name']}}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Location : </th>
                        <td>Noida</td>
                        <th> PF Number :</th>
                        <td>{{$emp_bank_details['pf_or_uan_no']}}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Date of Joining: </th>
                        <td>{{ $emp_payments->employee->emp_details[0]['joining_date'] }}</td>
                        <th> ESIC Number :</th>
                        <td>{{$emp_bank_details['esic_no']}}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Paid Days : </th>
                        <td>26</td>
                        <th> Bank A/C No. :</th>
                        <td>{{$emp_bank_details['bank_account_no']}}</td>
                     </tr>
                     <tr class="list-item">
                        <th colspan="4" class="tableitem text-center">Salary Details</th>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Earnings</th>
                        <th class="tableitem">Amount</th>
                        <th class="tableitem">Deduction</th>
                        <th class="tableitem">Amount</th>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Basic Salary :</th>
                        <td>{{ number_format($salry_details['basic_salary'],2) }}</td>
                        <th>TDS:</th>
                        <td>{{ number_format($salry_details['tds'],2) }}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">House Rent Allowance : </th>
                        <td>{{ number_format($salry_details['hra'],2) }}</td>
                        <th>PF:</th>
                        <td>{{ number_format($salry_details['pf'],2) }}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Medical Allowance : </th>
                        <td>{{number_format($salry_details['medical_allowance'],2) }}</td>
                        <th>ESIC :</th>
                        <td>{{ number_format($salry_details['esic'],2) }}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Conveyance: </th>
                        <td>{{number_format($salry_details['conveyance'],2) }}</td>
                        <th>Leave without pay:</th>
                        <td>{{$emp_payments['leave_without_pay']}}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Other Allowance : </th>
                        <td>{{number_format($salry_details['mix_allowance'],2) }}</td>
                        <th>Loan Deduction :</th>
                        <td>{{number_format($emp_payments['loan'],2)}}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Bonus If Any: </th>
                        <td>{{number_format($emp_payments['bonus'],2)}}</td>
                        <th>Other Deduction :</th>
                        <td>{{number_format($emp_payments['other_deduction'],2)}}</td>
                     </tr>
                  </table>
                  <table class="table table-bordered">
                     <tr class="list-item">
                        <th class="tableitem">Gross Salary :</th>
                        <td>{{number_format($salry_details['emp_salary'],2) }}</td>
                        <th> Total Deduction: </th>
                        <td>{{$total_detuction}}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Net Payable: </th>
                        <td colspan="3">{{number_format($emp_payments['net_pay'],2)}}</td>
                     </tr>
                     <tr class="list-item">
                        <th class="tableitem">Net Payable Amount in Words</th>
                        <td colspan="3"><?php echo ucfirst(getIndianCurrency($emp_payments['net_pay']).' only'); ?></td>
                     </tr>
                     <tr class="list-item">
                        <td colspan="4" class="tableitem text-center">This document contains confidential information. If you are not the intended recipient, you are not
                           authorized to use or disclose it in any form. If you have received this in error, Please destroy it along with
                           any copies and notify the sender immediately
                        </td>
                     </tr>
                  </table>
            </div>
      </div>
      </div>
      </div>
      </div>
        </section>
   </body>
</html>