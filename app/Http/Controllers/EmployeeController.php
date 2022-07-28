<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\EmployeeDetails;
use App\EmployeeSalary;
use App\Department;
use App\Role;
use DB;
use Validator;
use Auth;
use App\Company;
use Session;
use App\LastCompanyDetails;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');
        

    }
    public function index(Request $request)
    {
        $employee = User::with('emp_details')->orderBy('id', 'DESC')->paginate(20);
        // dd($employee);
        return view('employee', compact('employee'));
    }
    public function Department(Request $request)
    {
        $data = Department::get();
        return view('employee_department', compact('data'));
    }

    public function AddEmployee(Request $request)
    {


        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users',
                'mobile' => 'required'
            ]);
            if ($validator->fails()) {
                return back()->with([
                    'error' => $validator->messages()->first(),
                    'status' => 400,
                ]);
            }

            $data = $request->except('_token');
            //  dd($data);
            DB::beginTransaction();
            try {
                $employee = new User;
                $employee->name = $data['name'];
                $employee->mobile = $data['mobile'];
                $employee->email = $data['email'];
                $employee->password = bcrypt($data['password']);
                $employee->location = $data['location'];
                $employee->role = $data['role'];

                if ($request->has('image')) {
                    $images = $request->file('image');
                    $new_name = uniqid('profile_image') . '.' . $images->getClientOriginalName();
                    $$images->move(public_path('/profile'), $new_name);
                    $employee->profile_image = $new_name;
                }
                $employee->save();

                $lastCompanyDetails = new LastCompanyDetails;
                $lastCompanyDetails->emp_id = $employee->id;
                $lastCompanyDetails->company_name = $data['company_name'];
                $lastCompanyDetails->company_name = $data['designation'];

                $lastCompanyDetails->hr_name = $data['hr_name'];
                $lastCompanyDetails->hr_contact = $data['hr_contact'];
                $lastCompanyDetails->hr_email = $data['hr_email'];

                $lastCompanyDetails->tl_name = $data['tl_name'];
                $lastCompanyDetails->tl_contact = $data['tl_contact'];
                $lastCompanyDetails->tl_email = $data['tl_email'];

                $lastCompanyDetails->com_contact = $data['com_contact'];
                $lastCompanyDetails->com_joining_date = $data['com_joining_date'];
                $lastCompanyDetails->com_last_date = $data['com_last_date'];
                $lastCompanyDetails->com_address = $data['com_address'];
                $lastCompanyDetails->reason_for_left = $data['reason_for_left'];

                $lastCompanyDetails->save();


                $employee_details = new EmployeeDetails;
                $employee_details->emp_id = $employee->id;
                $employee_details->job_title = $data['job_title'];
                // $employee_details->company_id = $data['company_id'];
                $employee_details->department = $data['department'];
                $employee_details->role = $data['role'];
                $employee_details->personal_email = $data['personal_email'];

                $employee_details->d_o_b = $data['d_o_b'];
                $employee_details->gender = $data['gender'];
                $employee_details->marital_status = $data['marital_status'];

                $employee_details->role = $data['role'];
                $employee_details->guardian = $data['guardian'];
                $employee_details->relation = $data['relation'];
                $employee_details->guardian_cont = $data['guardian_cont'];
                $employee_details->fami_members = $data['fami_members'];
                $employee_details->emeg_contact = $data['emeg_contact'];
                $employee_details->blood_group = $data['blood_group'];

                $employee_details->birth_marks = $data['birth_marks'];


                $employee_details->per_address = $data['location'];
                $employee_details->pres_address = $data['pres_address'];
                $employee_details->joining_date = $data['joining_date'];
                if ($request->hasFile('address_prof')) {
                    $image = $request->file('address_prof');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/document');
                    $image->move($destinationPath, $name);
                    $employee_details->address_prof = $name;
                }
                $employee_details->save();
                $employee_salary = new EmployeeSalary;

                $employee_salary->emp_id = $employee->id;
                $employee_salary->emp_salary = $data['emp_salary'];
                $employee_salary->start_date = $data['start_date'];
                $employee_salary->end_date = $data['end_date'];
                $employee_salary->save();
                User::where('id',$employee->id)->update(['emp_code'=>'BHIPL0'.$employee->id]); 

                DB::commit();
                $user = User::orderBy('id', 'DESC')->first();
                //   WelcomeMail($user);  
                return redirect('add_employee')->with('success', 'Employee Added Successfull');
            } catch (\Exception $e) {
                dd($e->getMessage());
                DB::rollBack();
                return redirect('add_employee')->with('error', $e->getMessage());
            }
        }
        $department = Department::get();
        $role = Role::get();
        $company = Company::get();
        return view('add_employee', compact('department', 'role', 'company'));
    }


    public function AddDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:department',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()->first(),
                'status' => 400,
            ]);
        }

        try {
            $data = $request->all();
            Department::create($data);
            return response()->json(['success' => 'department added successfully', 'status' => 200]);
        } catch (\Exception $e) {
            //  dd($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }


    public function employleeDetails(Request $request, $id = null)
    {

        $data = User::with('emp_details', 'last_comapny_details')->where('id', $id)->first()->toArray();
        //    dd($data);
        $department = Department::where('id', $data['emp_details'][0]['department'])->first();
        $department_name = $department['name'];
        Session::put('emp_id', $id);
        return view('profile', compact('data', 'department_name'));
    }


    public function ChangeDepartmentName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:department',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()->first(),
                'status' => 400,
            ]);
        }

        try {
            Department::where('id', $request->department_id)->update(['name' => $request->name]);
            return response()->json(['success' => 'department Updated successfully', 'status' => 200]);
        } catch (\Exception $e) {
            //  dd($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }


    public function EditEmployee(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            //  dd($data);
            //  DB::beginTransaction();
            try {
                $employee = $request->only(['name', 'role', 'mobile', 'email', 'location']);
                $employee_details = $request->only(['job_title', 'company_id', 'role','personal_email', 'department', 'marital_status', 'gender', 'pres_address', 'guardian', 'emeg_contact', 'fami_members', 'guardian_cont', 'relation', 'blood_group', 'birth_marks']);
                $employee_details['d_o_b'] = date('Y-m-d', strtotime($request->d_o_b));
                $employee_details['per_address'] = $request->location;
                $employee_details['joining_date'] = date('Y-m-d', strtotime($request->joining_date));

                $employee_salary = $request->only(['emp_salary', 'start_date', 'end_date']);
                $lastCompanyDetails = $request->only(['company_name', 'com_joining_date', 'com_last_date', 'com_address', 'hr_name', 'hr_contact', 'hr_email', 'tl_name', 'tl_contact', 'tl_email', 'com_contact','designation', 'reason_for_left']);
                User::where('id', $request->id)->Update($employee);

                LastCompanyDetails::where('emp_id', $request->id)->update($lastCompanyDetails);
                EmployeeDetails::where('emp_id', $request->id)->Update($employee_details);
                // EmployeeSalary::where('emp_id', $request->id)->Update($employee_salary);
                DB::commit();
                return back()->with('success', 'Employee Updated Successfull');
            } catch (\Exception $e) {
                //  dd($e->getMessage());
                DB::rollBack();
                return back()->with('error', $e->getMessage());
            }
        }
        $department = Department::get();
        $role = Role::get();
        $company = Company::get();
        $employee = User::with('emp_details', 'emp_salary', 'roles', 'emp_details.departments', 'emp_details.companies', 'last_comapny_details')->where('id', $id)->first();
        // dd($employeedetails);
        return view('edit_employee', compact('employee', 'department', 'role', 'company'));
    }


    public function CheckEmail(Request $request)
    {
        //  dd($request->email); 

        try {
            $emailCheck = User::where('email', $request->email)->first();
            if (!empty($emailCheck)) {
                return response()->json(['error' => 'email is already in use', 'status' => 400]);
            } else {
                return response()->json(['success' => 'You can use this email', 'status' => 200]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }

    public function CheckMobile(Request $request)
    {
        //  dd($request->email); 

        try {
            $mobilecheck = User::where('mobile', $request->mobile)->first();
            if (!empty($mobilecheck)) {
                return response()->json(['error' => 'mobile number is already in use', 'status' => 400]);
            } else {
                return response()->json(['success' => 'You can use this mobile no.', 'status' => 200]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }

    public function SearchEmployee(Request $request)
    {
        try {
            $employee_list = User::where('name', 'like', '%'.$request->keywords . '%')->where('status',1)->get();
            if (empty($employee_list)) {
                return response()->json(['error' => 'no employee found', 'status' => 400]);
            } else {
                return response()->json(['employee_list' => $employee_list, 'status' => 200]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }



    public function AjaxEmployeeDetails(Request $request)
    {
        try {

            $employee_details = User::with('emp_details', 'roles', 'emp_details.departments')->where('id', $request->emp_id)->first();
            $profile = url('public/profile/' . $employee_details['profile_image']);
            $department = $employee_details['emp_details'][0]['departments']['name'];
            $role = $employee_details['roles']['name'];
            if (empty($employee_details)) {
                return response()->json(['error' => 'no employee found', 'status' => 400]);
            } else {
                $returnHTML = "<div class='row'><div class='col-8'>
                <p class='font-weight-bold'>Employee Code :<span class='font-weight-normal'>&nbsp;&nbsp;" . $employee_details['emp_code'] . "</span></p>
                <p class='font-weight-bold'>Name :<span class='font-weight-normal'>&nbsp;&nbsp;" . $employee_details['name'] . "</span></p>
                <p class='font-weight-bold'>Mail:<span class='font-weight-normal'>&nbsp;&nbsp;" . $employee_details['email'] . "</span></p>
                <p class='font-weight-bold'>Contact:<span class='font-weight-normal'>&nbsp;&nbsp;" . $employee_details['mobile'] . "</span></p>
                <p class='font-weight-bold'>Department :<span class='font-weight-normal'>&nbsp;&nbsp;" . $department . "</span></p>
                <p class='font-weight-bold'>Role :<span class='font-weight-normal'>&nbsp;&nbsp;" . $role . "</span></p></div>
                <div class='col-4'><img src='$profile'/></div></div>";
                return response()->json(['html' => $returnHTML]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }
    
    
      public function AjaxEmployeeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emp_id' => 'required',
            'status' => 'required',

           ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()->first(),
                 'status' => 400,
            ]);
        }
          try{    
                $emp_id=$request->emp_id;
                $status=$request->status?0:1;
                User::where('id',$emp_id)->update(['status'=>$status]);
                return response()->json(['success'=>'Employee Status Changed successfully','checked'=>$status,'status' =>200]);
            }catch(\Exception $e){
                 dd($e->getMessage());
              return response()->json(['error'=>$e->getMessage(),'status' => 400]);
             }
    }
}
