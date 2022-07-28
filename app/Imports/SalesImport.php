<?php

namespace App\Imports;

use App\User;
use App\Sales;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Auth;

class SalesImport implements ToModel, WithHeadingRow, WithChunkReading
{
    private $users;

    public function __construct($emp_id)
    {
        $this->emp_id = $emp_id;

    }

    public function model(array $row)
    {
        // dd(Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),);
        return new Sales([
            'emp_id' =>Auth::user()->id,
            'date' =>Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),
            'company_name' => $row['company_name'],
            'contact_person' =>$row['contact_person'],
            'designation'=>$row['designation'],
            'contact_no' =>$row['contact_no'],
            'contact_email' =>$row['contact_email'],
            'address' =>$row['address'],
            'remarks' =>$row['remarks'],
            
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
