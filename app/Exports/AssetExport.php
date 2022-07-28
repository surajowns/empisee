<?php

namespace App\Exports;

use App\User;
use App\AssetModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssetExport implements FromCollection, WithHeadings,WithMapping
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
            $response=AssetModel::with('employee')->whereIn('emp_id',$this->emp_id)->get();
         }else{
          $response=AssetModel::with('employee')->get();
         }
        return  $response;
    }

    public function map($asset_details) : array {
        return [
            $asset_details->id,
            $asset_details->employee->emp_code,
            $asset_details->employee->name,
            $asset_details->product_name,
            $asset_details->model_name,
            $asset_details->quantity,
            date('d-m-Y',strtotime($asset_details->allotted_date)),
            isset($asset_details->return_date)?date('h:i A',strtotime($asset_details->return_date)):'',
            $asset_details->remarks,
            $asset_details->status,
            $asset_details->action_by,
        ] ;
 
 
    }

    public function headings(): array
    {
        return [
            'S.NO',
            'Employee Code',
            'Employee Name',
            'Product Name',
            'Model Number',
            'Quantity',
            'Alloted Date',
            'Return Date',
            'Remarks',
            'Status',
            'Approved By',
          
        ];
    }
}
