<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Document;
use Validator;
use Session;
use App\User;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }
    public function Index(Request $request, $id = null)
    {
        $document = Document::where('emp_id', $id)->get()->toArray();
        $employee = User::where('id', $id)->first();
        return view('emp_document', compact('document', 'employee'));
    }

    public function UploadDocument(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'document'  => 'required|mimes:pdf',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->except('_token');
            if ($request->hasFile('document')) {
                $image = $request->file('document');
                $name =  $data['doc_name'] . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/document');
                $image->move($destinationPath, $name);
                $data['document'] = $name;
            }
            if (!$request->input('emp_id')) {
                $data['emp_id'] = Session::get('emp_id');
            }


            Document::create($data);

            return Response()->json([
                "success" => 'File has been uploaded successfully',
                "file" => $name,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return Response()->json([
                "error" => $e->getMessage(),
                "status" => 400
            ]);
        }
    }
    public function UpdateDocument(Request $request)
    {
        $validate = Validator::make($request->all(), [
             'document'  => 'mimes:pdf',
             'doc_name'  => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            if ($request->input('emp_id')) {
                $emp_id = $request->emp_id;
            } else {
                $emp_id = Session::get('emp_id');
            }
            $data = $request->except('csrf-token', 'id', 'emp_id');
            if ($request->hasFile('document')) {
                $image = $request->file('document');
                $name =  $data['doc_name'] . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/document');
                $image->move($destinationPath, $name);
                $data['document'] = $name;
                $deletefile = Document::where('id', $request->id)->where('emp_id', $emp_id)->first();
                unlink(public_path('document/' . $deletefile['document']));
            }

            Document::where('id', $request->id)->where('emp_id', $emp_id)->update($data);

            return Response()->json([
                "success" => 'File has been Updated successfully',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return Response()->json([
                "error" => $e->getMessage(),
                "status" => 400
            ]);
        }
    }
     public function UpdateSignature(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'signature'  => 'required|mimes:jpg,jpeg,png',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            if ($request->input('emp_id')) {
                $emp_id = $request->emp_id;
            } else {
                $emp_id = Session::get('emp_id');
            }
            $data = $request->except('csrf-token', 'id', 'emp_id');
            if ($request->hasFile('signature')) {
                $image = $request->file('signature');
                $name =  time(). '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/signature');
                $image->move($destinationPath, $name);
                $data['signature'] = $name;
                $deletefile = User::where('id', $emp_id)->first();
                if(($deletefile['signature'])){
                  unlink(public_path('signature/'.$deletefile['signature']));
                }
            }

            User::where('id', $emp_id)->update($data);

            return Response()->json([
                "success" => 'Signature has been Updated successfully',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return Response()->json([
                "error" => $e->getMessage(),
                "status" => 400
            ]);
        }
    }

}
