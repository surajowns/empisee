<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\EmployeeSalary;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class SalaryExpot implements FromCollection,WithHeadings,WithMapping
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
            $response=EmployeeSalary::with('employee')->whereIn('emp_id',$this->emp_id)->get();
         }else{
          $response=EmployeeSalary::with('employee')->get();
         }
        return  $response;
    }

    public function map($salary_details) : array {
        return [
            $salary_details->id,
            $salary_details->employee->emp_code,
            $salary_details->employee->name,
            $salary_details->emp_salary,
            $salary_details->basic_salary,
            $salary_details->hra,
            $salary_details->medical_allowance,
            $salary_details->conveyance,
            $salary_details->mix_allowance,
            $salary_details->tds,
            $salary_details->pf,
            $salary_details->esic,
            $salary_details->remarks,
        ] ;
 
 
    }

    public function headings(): array
    {
        return [
            'S.NO',
            'Employee Code',
            'Name',
            'Gross Salary',
            'Basic Salary',
            'HRA',
            'Medical Allowance',
            'Conveyance',
            'Mix Allowance',
            'TDS',
            'PF',
            'ESIC',
            'Remarks',
        ];
    }
}
