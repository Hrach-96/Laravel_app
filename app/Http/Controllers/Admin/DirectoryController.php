<?php

namespace App\Http\Controllers\Admin;

use App\AdminOfTheSchool;
use App\Category;
use App\DegreeOfTheUser;
use App\Http\Controllers\MailController;
use App\School;
use App\SchoolOfTheUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\CategoryOfTheUser;
use App\RegisterSurvey;
use App\User;
use Session;
use Hash;

class DirectoryController extends Controller
{
    public function __construct(MailController $mail)
    {
        $this->mail = $mail;
    }
    // directory
    public  function directory(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();

        $user_id = Session::get('userData')->id;
        $free_search = $request->input('free_search');
        $degrees = $request->input('degree');
        $year_of_graduation = $request->input('year_of_graduation');
        $categorys = $request->input('category');
        $jobs = $request->input('job');
        $users = User::where('type','<>',User::super_admin)
            ->where(function ($sql) use ($free_search,$degrees,$year_of_graduation,$categorys,$jobs,$schoolInfo){
                $sql->Where(function($query) use ($free_search){
                    if(!empty($free_search)){
                        $query->orWhereRaw("CONCAT(`first_name`, ' ', `last_name`) LIKE ?", ['%'.$free_search.'%']);
                    }
                })->Where(function ($query) use ($schoolInfo){
                     $query->orWhereHas('chooseSchool', function ($q) use ($schoolInfo) {
                         $q->whereHas('school', function ($query1) use ($schoolInfo) {
                             $query1->Where('subdomain_name',$schoolInfo->subdomain_name);
                         });
                     })->orWhereHas('GetAdminSchool', function ($q) use ($schoolInfo) {
                         $q->whereHas('GetSchoolInfo', function ($query1) use ($schoolInfo) {
                             $query1->Where('subdomain_name',$schoolInfo->subdomain_name);
                         });
                     });
                })->Where(function ($query) use ($degrees){
                    if(!empty($degrees)) {
                        $query->WhereHas('chooseDegree', function ($q) use ($degrees) {
                            $q->whereHas('degree', function ($query1) use ($degrees) {
                                $query1->Where('name',$degrees);
                            });
                        });
                    }
                })->Where(function ($query) use ($categorys){
                    if(!empty($categorys)) {
                        $query->WhereHas('chooseColor', function ($q) use ($categorys) {
                            $q->whereHas('category', function ($query1) use ($categorys) {
                                $query1->Where('title',$categorys);
                            });
                        });
                    }
                })->Where(function ($query) use ($jobs){
                    if(!empty($jobs)){
                        $query->WhereHas('chooseJob', function ($q) use($jobs) {
                            $q->whereHas('job', function ($query1) use ($jobs) {
                                $query1->Where('title', $jobs);
                            });
                        });
                    }
                })->Where(function ($query) use ($year_of_graduation){
                    if(!empty($year_of_graduation)){
                        $query->WhereHas('GetGraduationYear', function ($q) use($year_of_graduation) {
                            $q->Where('year',$year_of_graduation);
                        });
                    }
                });
            })->orderBy('id', 'DESC')->paginate(8);

        if ($request->ajax()) {

            $ids = Session::get('users_ids');
            Session::put('users_ids', array_merge($ids, $users->pluck('id')->toArray()));
            return view('admin.directory.usermore', compact('users','user_id'));
        }
        Session::forget('users_ids');
        Session::put('users_ids', $users->pluck('id')->toArray());

        return view('admin.directory.directory',compact('users','schoolInfo','user_id', 'free_search','degrees','year_of_graduation','categorys','jobs'));
    }

    // download csv
    public  function UserCSV(){

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Exporter.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $users =  User::whereIn('id', Session::get('users_ids'))->get();
        $columns = array('id','First Name','Last Name','Email','Date Of Birth','Category','Graduation Year','Small Description','Created At');

        $callback = function() use ($users, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($users as $user) {
                $categorys = ($user->chooseColor)?$user->chooseColor->category->title:'
                ';
                fputcsv($file, array($user->id, $user->first_name, $user->last_name, $user->email,date('Y-m-d',strtotime($user->date_of_birth)),$categorys,($user->GetGraduationYear)?$user->GetGraduationYear->year:'',$user->small_description,$user->created_at));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // New User
    public function NewUser(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        $id = Session::get('userData')->id;
        $school = AdminOfTheSchool::where('admin_id',$id)->first();
        return view('admin.directory.new-user',compact('school','schoolInfo'));
    }

    // create new user
    public function  AddNewUser(Request $request){
        $admin_id = Session::get('userData')->id;
        $AdminSchool = AdminOfTheSchool::where('admin_id',$admin_id)->first();
        $first_name = request('first_name');
        $last_name  = request('last_name');
        $email      = request('email');
        $category   = request('category');
        $city       = request('city');
        $degree     = request('degree');
        $rules = [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required|email|unique:users',
            'category'          => 'required',
            'graduation_year'   => 'required',
            'degree'            => 'required',
        ];
        $validator	= Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $user = new User;
            $user->first_name  = $first_name;
            $user->last_name   = $last_name;
            $user->email       = $email;
            $user->city        = $city;
            $user->avatar      = 'default.jpg';
            $user->date_of_import = Carbon::now();
            $user->graduation_year_id = request('graduation_year');
            $user->password    = Hash::make(123456);

            if ($user->save()){
                $CategoryOfTheUser = new CategoryOfTheUser;
                $CategoryOfTheUser->category_id = $category;
                $CategoryOfTheUser->user_id = $user->id;
                $CategoryOfTheUser->save();

                $school =  new SchoolOfTheUser;
                $school->school_id = $AdminSchool->school_id;
                $school->user_id = $user->id;
                $school->save();

                if ($degree){
                    $DegreeOfTheUser = new DegreeOfTheUser();
                    $DegreeOfTheUser->degree_id = $degree;
                    $DegreeOfTheUser->user_id = $user->id;
                    $DegreeOfTheUser->save();
                }

                if($category == Category::Student){
                    $this->mail->ID781677($user->id);
                }else if($category == Category::Alumni){
                    $this->mail->ID781636($user->id);
                }else if($category == Category::Teacher){
                    $this->mail->ID781656($user->id);
                }
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
            return Redirect(route('admin.directory'));
        }
    }

    // user profile
    public  function  UserProfile(Request $request,$id){
        $school = parent::GetSubDomain($request->getHost());
        $survey_answers = RegisterSurvey::where('user_id',$id)->get();
        $schoolInfo = School::where('subdomain_name',$school)->first();
        if($user = User::where('id',$id)->where('type','<>',User::super_admin)->first()){
            $user_id = Session::get('userData')->id;
            if(!empty($survey_answers[0])){
                $company_name = (isset(json_decode($survey_answers[0]['answers'])->which_company_you_work))?json_decode($survey_answers[0]['answers'])->which_company_you_work:'';
                $mentor = (isset(json_decode($survey_answers[0]['answers'])->student_mentor))?json_decode($survey_answers[0]['answers'])->student_mentor:"";
                $what_function_copy = (isset(json_decode($survey_answers[0]['answers'])->what_function_copy))?json_decode($survey_answers[0]['answers'])->what_function_copy:"";
                $title_of_the_post = (isset(json_decode($survey_answers[0]['answers'])->title_of_the_post))?json_decode($survey_answers[0]['answers'])->title_of_the_post:"";
                $degree_of_user = DegreeOfTheUser::where('user_id',$user->id)->first();
                return view('admin.directory.profile',compact('user','user_id','schoolInfo','company_name','mentor','what_function_copy','degree_of_user','title_of_the_post'));
            }
            return view('admin.directory.profile',compact('user','user_id','schoolInfo'));
        }
        toastr()->error('Such user does not exist!');
        return Redirect(route('admin.directory'));
    }

    // edir user
    public  function  UserEditProfile($id){

        if ($user = User::where(['type' => User::user,'id' => $id])->first()){
            return view('admin.directory.edit-profile',compact('user'));
        }

        return redirect(route('admin.directory'));
    }

    // update user
    public  function UserUpdateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'picture'    => 'mimes:jpeg,bmp,png',
        ]);

        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            if ($user = User::where(['type' => User::user,'id' =>  Crypt::decrypt(request('id'))])->first()){
                $user->first_name = request('first_name');
                $user->last_name  = request('last_name');
                if (request('picture')){
                    $user->avatar = parent::fileUpload(request('picture'),'images/avatar');
                }
                $user->city       = request('city');
                $user->status     = is_null(request('active'))?User::status_inactive:User::status_active;
                $user->save();
            }
        }
        return redirect(route('admin.directory'));
    }


}
