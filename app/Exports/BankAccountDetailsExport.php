<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\BankAccount;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class BankAccountDetailsExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($emp_id)
    {
        $this->emp_id = $emp_id;

    }
    public function collection()
    {
        if(!empty($this->emp_id)){
            $response=BankAccount::with('employee')->whereIn('emp_id',$this->emp_id)->get();
         }else{
          $response=BankAccount::with('employee')->get();
         }
        return  $response;
    }

    public function map($bank_details) : array {
        return [
            $bank_details->id,
            $bank_details->employee->emp_code,
            $bank_details->employee->name,
            $bank_details->account_full_name,
            $bank_details->bank_account_no,
            $bank_details->bank_name,
            $bank_details->ifsc_code,
            $bank_details->branch_name,
            $bank_details->address,
            $bank_details->pan_card_no,
            $bank_details->pf_or_uan_no,
            $bank_details->esic_no,
        ] ;
 
 
    }

    public function headings(): array
    {
        return [
            'S.NO',
            'Employee Code',
            'Name',
            'Account Full Name',
            'Bank Account No',
            'Bank Name',
            'IFSC Code',
            'Branch Name',
            'Address',
            'Pancard No',
            'PF/UAN No',
            'ESIC No',
        ];
    }
}
