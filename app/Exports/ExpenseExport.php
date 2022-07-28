<?php

namespace App\Exports;
use App\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use DB;

class ExpenseExport implements FromCollection,WithHeadings,WithMapping
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
            $response=Expense::with('employee')->where('emp_id',$this->emp_id)->whereBetween('created_at', [$this->from, $this->to])->get();
         }else{
          $response=Expense::with('employee')->whereBetween('created_at', [$this->from, $this->to])->get();
         }
        return  $response;

        // return  Expense::with('employee')->get();
    }

    public function map($expense) : array {
        return [
            $expense->id,
            $expense->employee->name,
            $expense->exp_type,
            $expense->exp_date,
            $expense->from,
            $expense->to,
            $expense->purpose,
            $expense->amount,
            $expense->vendor_name,
            $expense->notes,
            $expense->created_at,
        ] ;
 
 
    }

    public function headings(): array
    {
        return [
            'S.NO',
            'Name',
            'Expense Type',
            'Expense Date',
            'From',
            'To',
            'Purpose',
            'Amount',
            'Vendor Name',
            'Notes',
            'Expense Created At',
        ];
    }


}
