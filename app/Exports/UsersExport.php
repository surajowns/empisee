<?php

namespace App\Exports;

use App\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use DB;
class UsersExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Expense::with('employee')->get();
        // dd($expense);    
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
