<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\JobOfTheUser;
use Illuminate\Http\Request;
use App\JobBoard;
use App\School;
use Validator;
use Redirect;
use Session;

class JobController extends Controller
{
    // job offer
    public function JobOffer(Request $request){
        $user = Session::get('userData');
        $jobs = JobBoard::where('status','1')->paginate(8);

        if ($request->ajax()) {

            return view('user.job.jobmore', compact('jobs','user'));
        }
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('user.job.job-offer',compact('jobs','user','schoolInfo'));
    }
    // new post job
    public  function postjob(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('user.job.post-job',compact('schoolInfo'));
    }
    // new post job
    public  function newjob(Request $request){
        $user = Session::get('userData');
        $validator = Validator::make($request->all(), [
            'title'          => 'required',
            'company_name'   => 'required',
            'logo'           => 'required|mimes:jpeg,bmp,png',
            'area'           => 'required',
            'type_contract'  => 'required',
            'email'          => 'required|email',
            'experience'     => 'required',
            'salary'         => 'required',
            'start_date'     => 'required|date'
        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $JobBoard = new JobBoard();
            $JobBoard -> title = request('title');
            $JobBoard -> company_id = request('company_name');
            $JobBoard -> logo = parent::fileUpload(request('logo'),'images/job');
            $JobBoard -> area_id = request('area');
            $JobBoard -> contract_id = request('type_contract');
            $JobBoard -> email = request('email');
            $JobBoard -> experience_id = request('experience');
            $JobBoard -> salary_id = request('salary');
            $JobBoard -> status = '1';
            $JobBoard -> start_date = request('start_date');
            if(request('description')){
                $JobBoard -> description = request('description');
            }
            $JobBoard -> file_atachment = parent::fileUpload(request('file_atachment'),'images/jobattachment');
            $JobBoard -> save ();

            $JobOfTheUser = new JobOfTheUser();
            $JobOfTheUser->job_id = $JobBoard->id;
            $JobOfTheUser->user_id = $user->id;
            $JobOfTheUser->save();

            toastr()->success('Job Is Added');
            return Redirect(route('user.job-offer'));
        }

    }
}
