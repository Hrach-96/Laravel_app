<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobOfTheCompany;
use App\JobBoard;
use App\Company;
use App\School;
use Crypt;

class JobBoardController extends Controller
{
    public function NewJobBoard()
    {
        return view('super_admin.jobboard.newjobboard');
    }

    // Add New Job Board
    public function AddNewJobBoard(Request $request){
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'company_name'   => 'required',
            'logo'           => 'required|mimes:jpeg,bmp,png',
            'area'           => 'required',
            'type_contract'  => 'required',
            'email'          => 'required|email',
            'experience'     => 'required',
            'school'         => 'required',
            'start_date'     => 'required|date'
        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $company = Company::where('name',request('company_name'))->first();
            if(empty($company)){
                $company = new Company();
                $company->name = request('company_name');
                $company->save();
            }
            $JobBoard = new JobBoard();
            $JobBoard -> title = request('title');
            $JobBoard -> company_id = $company->id;
            $JobBoard -> logo = parent::fileUpload(request('logo'),'images/job');
            $JobBoard -> area_id = request('area');
            $JobBoard -> contract_id = request('type_contract');
            $JobBoard -> email = request('email');
            $JobBoard -> experience_id = request('experience');
            $JobBoard -> salary_id = request('salary');
            $JobBoard -> start_date = request('start_date');
            $JobBoard -> school_id = request('school');
            if(request('description')){
                $JobBoard -> description = request('description');
            }
            if(request('file_atachment')){
                $JobBoard -> file_atachment = parent::fileUpload(request('file_atachment'),'images/jobattachment');
            }
            $JobBoard -> save ();
            toastr()->success('Job Is Added');
            return Redirect::back();
        }
        return Redirect(route('super_admin.AllJobBoards'));
    }
    // Job Details
    public function JobDetails($id = null){
        $job = JobBoard::find($id);
        return view('super_admin.jobboard.jobdetails',compact('job'));
    }
    // UpdUpdateJobate Group
    public function UpdateJob(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'company_name'   => 'required',
            'area'           => 'required',
            'type_contract'  => 'required',
            'email'          => 'required|email',
            'experience'     => 'required',
            'school'         => 'required',
            'start_date'     => 'required|date'
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Groups', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $JobBoard = JobBoard::find($id);
            $JobBoard -> title = request('title');
            $JobBoard -> company_id = request('company_name');
            if(request('logo')){
                $JobBoard -> logo = parent::fileUpload(request('logo'),'images/job');
            }
            $JobBoard -> area_id = request('area');
            $JobBoard -> contract_id = request('type_contract');
            $JobBoard -> email = request('email');
            $JobBoard -> experience_id = request('experience');
            $JobBoard -> salary_id = request('salary');
            $JobBoard -> start_date = request('start_date');
            $JobBoard -> description = request('description');
            $JobBoard -> school_id = request('school');
            if(request('file_atachment')){
                $JobBoard -> file_atachment = parent::fileUpload(request('file_atachment'),'images/jobattachment');
            }
            $JobBoard -> save ();
            toastr()->success('Job Is Added');
            return Redirect::back();
        }
    }
    // Edit Job Board
    public function EditJobBoard(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if ($job = JobBoard::find($id)) {
            return response(['success' => true,'job' => $job]);
        }else{
            return response(['success' => false]);
        }
    }

    // Update Job Board
    public function UpdateJobBoard(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $rules = [
            'title'   => 'required',
            'school'  => 'required',
            'link'    => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ];
        $validator	= Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('jobs', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {

            $job = JobBoard::find($id);
            $job->title = request('title');
            $job->school_id = request('school');
            $job->status = (request('status') == 'on')?1:0;
            $job->link = request('link');
            $job->save();
            toastr()->success('success');
            return Redirect::back();
        }
    }

    // All Job Board
    public function AllJobBoards(){
        $jobs = JobBoard::all();
        $schools = School::all();
        return view('super_admin.jobboard.alljobboard',compact('jobs','schools'));
    }

    // Delete Job Board
    public function DeleteJobBoard(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $JobOfTheCompany = JobOfTheCompany::where('job_id',$id);
        $JobOfTheCompany->delete();
        if (JobBoard::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
}
