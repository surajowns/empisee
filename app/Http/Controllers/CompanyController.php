<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }

    public function Index(Request $request)
    {
        $company = Company::get();
        // dd($company);
        return view('company', compact('company'));
    }
    public function AddCompany(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'company_name' => 'required|unique:companies',
            'reg_comp_no' => 'required',
            'company_name' => 'required',
            'incorporat_date' => 'required',
            'register_address' => 'required',
            'contact_no' => 'required',
            'city' => 'required',
            'country' => 'required',
            'pin_code' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->all();
            Company::create($data);
            return response()->json(['status' => 200, 'success' => 'Company Added Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }


    public function EditCompany(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'company_name' => 'required',
            'reg_comp_no' => 'required',
            'company_name' => 'required',
            'incorporat_date' => 'required',
            'city' => 'required',
            'country' => 'required',
            'pin_code' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->except('id', '_');
            Company::where('id', $request->id)->update($data);
            return response()->json(['status' => 200, 'success' => 'Information Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }


    public function Editaddress(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'register_address' => 'required',
            'corporat_address' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->except('id', '_');
            Company::where('id', $request->id)->update($data);
            return response()->json(['status' => 200, 'success' => 'Information Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }

    public function DeleteCompany(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'company_id' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            Company::where('id', $request->company_id)->delete();
            return response()->json(['status' => 200, 'success' => 'Company Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()]);
        }
    }
}
