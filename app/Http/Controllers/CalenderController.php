<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Validator;
use App\EmployeeDetails;
use Auth;

class CalenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }

    public function Index(Request $request)
    {
        return view('calender');
    }
    public function LeaveList(Request $request)
    {
        try {

            $events = Event::get();
            $permission = EmployeeDetails::where('emp_id', Auth::user()->id)->whereIn('department', [1])->first();
            return response()->json(['success' => 'Event list', 'event' => $events, 'permission' => $permission, 'status' => 200,]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }
    public function CreateEvent(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'categoryClass' => 'required',
            'description' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {
            $data = $request->all();
            Event::create($data);
            return response()->json(['success' => 'Event Created  Successfully', 'status' => 200,]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }

    public function UpdateEvent(Request $request)
    {
        // dd($data=$request->all());
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'id' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {

            Event::where('id', $request->id)->update(['title' => $request->title, 'description' => $request->description]);
            return response()->json(['success' => 'Event Updated  Successfully', 'status' => 200,]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }


    public function DeleteEvent(Request $request)
    {
        // dd($data=$request->all());
        $validate = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->messages()->first(),
                'status' => 400,
            ]);
        }
        try {

            Event::where('id', $request->id)->delete();
            return response()->json(['success' => 'Event Deleted  Successfully', 'status' => 200,]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'status' => 400]);
        }
    }
    public function upload(Request $request)
    {
        //   dd($request->all());

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('event_image'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = 'https://www.besthawk.com/empisee/public/event_image/'. $fileName;
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
