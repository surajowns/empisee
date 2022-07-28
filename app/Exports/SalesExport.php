<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Sales;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class SalesExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($emp_id,$from,$to)
    {
        $this->emp_id = $emp_id;
        $this->from = $from;
        $this->to = $to;

    }

    public function collection()
    {
        if($this->emp_id){
            $response=Sales::with('employee')->where('emp_id',$this->emp_id)->whereBetween('created_at', [$this->from, $this->to])->get();
         }else{
          $response=Sales::with('employee')->whereBetween('created_at', [$this->from, $this->to])->get();
         }
        return  $response;

        // return  Expense::with('employee')->get();
    }

    public function map($sales_details) : array {
        return [
            $sales_details->id,
            $sales_details->company_name,
            $sales_details->contact_person,
            $sales_details->designation,
            $sales_details->contact_no,
            $sales_details->contact_email,
            $sales_details->address,
            $sales_details->remarks,
            date('n/j/Y',strtotime($sales_details->date)),
        ] ;
 
 
    }

    public function headings(): array
    {
        return [
            'S.NO',
            'company_name',
            'contact_person',
            'designation',
            'contact_no',
            'contact_email',
            'address',
            'remarks',
            'date',
        ];
    }
}
