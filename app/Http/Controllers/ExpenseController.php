<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Expense;
use Auth;
use App\User;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }
    public function Index(Request $request, $emp_id = null)
    {
        $data = User::where('id', '!=', 1)->get();
        $expensetatus = DB::table('expnse_status')->get();

        if ($emp_id) {
            $employee = User::with('emp_details', 'roles')->where('id', $emp_id)->first();
            $expense = Expense::with('employee')->where('emp_id', $emp_id)->get();
            return view('employee_expense', compact('employee', 'expense','expensetatus'));
        } else {
            $expense = Expense::with('employee')->where('emp_id', Auth::user()->id)->get();
            return view('expense', compact('data', 'expense'));
        }
    }

    public function AddExpense(Request $request)
    {
        $emp_id = Auth::User()->id;

        $validator = Validator::make($request->all(), [
            'exp_type' => 'required',
            'exp_date' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with([
                'error' => $validator->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->all();
            // dd($data);
            if ($request->hasFile('exp_invoice')) {
                $image = $request->file('exp_invoice');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/expense');
                $image->move($destinationPath, $name);
                $data['exp_invoice'] = $name;
            }
            $data['emp_id'] = $emp_id;
            Expense::create($data);
            return back()->with(['success' => 'Espense added successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage(), 'status' => 400]);
        }
    }
    public function Expensestatus(Request $request)
    {
        $user = Auth::user();
        $result = Expense::where('id', $request->expense_id)->update(['status' => $request->status_change, 'approved_by' => $user['name']]);
        if ($result) {
            return back()->with('success', 'Status Updated successfull');
        }
    }


    public function export(Request $request)
    {
        $emp_id= $request->emp_id;
        $from= date('Y-m-d',strtotime($request->from));
        $to= date('Y-m-d',strtotime($request->to));
        return Excel::download(new ExpenseExport($emp_id,$from,$to), 'expense.xlsx');   
        }
}
