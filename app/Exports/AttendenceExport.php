<?php

namespace App\Exports;

use App\User;
use App\ClockInOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendenceExport implements FromCollection, WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function __construct($emp_id,$from,$to)
    {
        $this->emp_id = $emp_id;
        $this->from = $from;
        $this->to = $to;

    }

    public function collection()
    {
           if(!empty($this->emp_id)){
              $response= ClockInOut::with('emp_details','attendence_status')->whereIn('emp_id',$this->emp_id)->whereBetween('created_at', [$this->from, $this->to])->get();
           }else{
            $response=ClockInOut::with('emp_details','attendence_status')->whereBetween('created_at', [$this->from, $this->to])->get();
           }
        return  $response;
    }
    public function map($attendence) : array {
        return [
            $attendence->emp_details->name,
            date('d-m-Y',strtotime($attendence->created_at)),
            isset($attendence->clock_in)?date('h:i A',strtotime($attendence->clock_in)):'',
            isset($attendence->clock_out)?date('h:i A',strtotime( $attendence->clock_out)):'',
            $attendence->attendence_status->name,
            $attendence->comment,
        ] ;
    }

    public function headings(): array
    {
        return [
          
            'Name',
            'Date',
            'Clock In',
            'Clock Out',
            'Status',
            'Reason',
        ];
    }
}
