<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class my_controller extends Controller
{
    /**
     * @param  null
     * @return LoginPage
     */
    public function login()
    {
        return view('login');
    }

    /**
     * handle login request
     * @param  email,password
     * @return redirect(dashboard|login)
     */
    public function loginAction(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if (!empty($email) && !empty($password)) {
            $adminDetails = admin::where('email', $email)->first();
            $checkPassword = Hash::check($password, $adminDetails->password);
            if (!empty($checkPassword)) {
                $request->session()->put('userData', $adminDetails->id);
                return redirect()->route('dashboard');
            }
            return redirect()->route('login')->with('error', 'Please check your password.');
        }
        return redirect()->route('login')->with('error', 'Email and Password cannot be empty.');
    }

    /**
     * @param  null
     * @return dashboard
     */
    public function dashboard()
    {
        $data['subjectList'] = subject::all();
        return view('dashboard', $data);
    }

    /**
     * @param  null
     * @return subjectTableView
     */
    public function subjectView()
    {
        $data['subjectList'] = subject::all();
        return view('subjectTable', $data)->render();
    }

     /**
     * @param  null
     * @return subjectView
     */
    public function subject()
    {
        $data['html'] = $this->subjectView();
        return view('subject', $data);
    }

     /**
      * insert new record for subject
     * @param  formdata
     * @return response
     */
    public function addSubject(Request $request)
    {
        if(!empty($request->input('title')) && !empty($request->input('chapter'))){
            $data['title'] = $request->input('title');
            $data['chapter'] = json_encode($request->input('chapter'));
            subject::create($data);
            $html = $this->subjectView();
            return ['code' => 101, 'msg' => 'Successfully create subject.','html'=>$html];
        }
        return ['code' => 100, 'msg' => 'Something Went Wrong.'];
    }

    /**
      * update  record for subject
     * @param  formdata
     * @return response
     */
    public function editSubject(Request $request)
    {
        if(!empty($request->input('id')) && !empty($request->input('title')) && !empty($request->input('chapter'))){
            $update = subject::find($request->input('id'));
            $update->title = $request->input('title');
            $update->chapter = json_encode($request->input('chapter'));
            $update->save();
            $html = $this->subjectView();
            return ['code' => 101, 'msg' => 'update successfully subject.','html'=>$html];
        }
        return ['code' => 100, 'msg' => 'Something Went Wrong.'];
    }


    /**
      * fetch the details with subjectID
     * @param  id
     * @return dashboard
     */
    public function subjectDetails(Request $request)
    {
        if (!empty($request->input('id'))) {
            return  subject::find($request->input('id'));
        }
        return ['code' => 100, 'msg' => 'Something Went Wrong.'];
    }
     /**
      * delete subject with subjectID
     * @param  id
     * @return response
     */
    public function deleteSubject(Request $request)
    {
        if (!empty($request->input('id'))) {
            $fetch = subject::find($request->input('id'));
            $fetch->delete();
            $html = $this->subjectView();
            return ['code' => 101, 'msg' => 'Successfully delete subject.','html'=>$html];
        }
        return ['code' => 100, 'msg' => 'Something Went Wrong.'];
    }
}
