<?php

namespace App\Http\Controllers\Admin;

use App\BlogOfTheSchool;
use App\Http\Controllers\MailController;
use App\Institution;
use App\JobBoard;
use App\RegisterSurvey;
use App\SchoolsOfRegsiterSurvey;
use App\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\CategoryOfTheUser;
use App\AdminOfTheSchool;
use App\AdminOfTheGroup;
use App\DegreeOfTheUser;
use App\GraduationYear;
use App\SchoolOfTheUser;
use App\UserFormation;
use App\UserExpeience;
use App\JobOfTheUser;
use App\UserHobby;
use App\BlogPost;
use App\Company;
use App\School;
use App\User;
use Session;
use Hash;

class AdminController extends Controller
{
    public function __construct(MailController $mail)
    {
        $this->mail = $mail;
    }

    //Login view
    public function reviewlogin(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('admin.login',compact('schoolInfo'));
    }
    // Login user
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|min:6',

        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
           $school = parent::GetSubDomain($request->getHost());

            $check = $this->checkLogin($request->input('email'),$request->input('password'),$school);
            if ($check){
                if ($referer = Session::get('referer')){
                    Session::forget('referer');
                    return Redirect($referer);
                }
                return Redirect(route('admin.dashboard'));
            }
            else{
                return Redirect::back();
            }

        }
    }

    //logout
    public function logout()
    {
        Session::forget('userData');
        return Redirect('/admin/login');
    }
    // user profile
    public  function  RemoveProfile($id){
        $user = User::where('id',$id);
        $user->delete();
        $AdminOfTheGroup = AdminOfTheGroup::where('admin_id',$id);
        $AdminOfTheGroup->delete();
        $AdminOfTheSchool = AdminOfTheSchool::where('admin_id',$id);
        $AdminOfTheSchool->delete();
        $CategoryOfTheUser = CategoryOfTheUser::where('user_id',$id);
        $CategoryOfTheUser->delete();
        $DegreeOfTheUser = DegreeOfTheUser::where('user_id',$id);
        $DegreeOfTheUser->delete();
        $JobOfTheUser = JobOfTheUser::where('user_id',$id);
        $JobOfTheUser->delete();
        $SchoolOfTheUser = SchoolOfTheUser::where('user_id',$id);
        $SchoolOfTheUser->delete();
        toastr()->error('Such user does not exist!');
        return Redirect(route('admin.logout'));
    }

    // user profile
    public  function  RemoveUserProfile($id){
        $user = User::where('id',$id);
        $user->delete();
        $AdminOfTheGroup = AdminOfTheGroup::where('admin_id',$id);
        $AdminOfTheGroup->delete();
        $AdminOfTheSchool = AdminOfTheSchool::where('admin_id',$id);
        $AdminOfTheSchool->delete();
        $CategoryOfTheUser = CategoryOfTheUser::where('user_id',$id);
        $CategoryOfTheUser->delete();
        $DegreeOfTheUser = DegreeOfTheUser::where('user_id',$id);
        $DegreeOfTheUser->delete();
        $JobOfTheUser = JobOfTheUser::where('user_id',$id);
        $JobOfTheUser->delete();
        $SchoolOfTheUser = SchoolOfTheUser::where('user_id',$id);
        $SchoolOfTheUser->delete();
        toastr()->success('Done');
        return Redirect(route('admin.directory'));
    }

    // View Reset password Form
    public function ResetView(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('admin.reset_password',compact('schoolInfo'));
    }

    //ResetPassword
    public function ResetPassword(Request $request)
    {
        $email = $request->input('email');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',

        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $user = User::where(['email' => $email,'type' => User::admin])->first();
            if($user){
                $password = str_random(14);
                $user->password = Hash::make($password);
                $user->save();
                $this->mail->ID871487($user->id,$password);
                toastr()->success("Please check your Email");
            }
            else{
                toastr()->error("The email doesn't exist");
            }
        }
        return Redirect(route('login.admin.get'));
    }

    // check email or username and password
    public function checkLogin($username, $password,$school)
    {
        $user = User::where(['type' => User::admin,'email' => $username])->first();
        if(!empty($user)){
            if(Hash::check($password, $user->password) ){
                if ($user->status == 1) {
                    if (strtolower($user->GetAdminSchool->GetSchoolInfo->subdomain_name) == $school){
                        Session::put('userData', $user);
                        return true;
                    }
                    toastr()->error('This is not your school');
                    return false;
                }
                toastr()->error('status inactive!');
                return false;
            }
            toastr()->error('Password is wrong!');
            return false;
        }
        toastr()->error('Email is wrong!');
        return false;

    }

    // dashboard
    public function dashboard(Request $request)
    {
        $id =  Session::get('userData')->id;
        $user = User::find($id);
        $jobs = JobBoard::orderBy('id', 'DESC')->paginate(8);

        if ($request->ajax()) {

            return view('admin.admin.jobmore', compact('jobs'));
        }

        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        $users = $schoolInfo->GetUsers;
//        $users = User::where('type',User::user)->orderBy('id', 'DESC')->limit(6)->get();
        $mentors = User::where(['type' => User::user,'mentorat' => User::mentorat])->orderBy('id', 'DESC')->limit(4)->get();
        $AdminOfTheSchool = AdminOfTheSchool::where('admin_id',$user->id)->first();
        $blogs = $this->UserBlog();
        $blog_posts = BlogOfTheSchool::where('school_id',$schoolInfo->id)->orderBy('id', 'DESC')->limit(3)->get();
        return view('admin.admin.dashboard',compact('user','blogs','blog_posts','users','mentors','jobs','AdminOfTheSchool','schoolInfo'));
    }
    public function UserBlog(){
        $blogs = BlogPost::where(function ($sql){
            $sql->Where(function ($query){
                $query->WhereHas('GetUsersOfBlog', function ($q){
                    $q->whereHas('user', function ($query1){
                        $query1->Where('linkedin',User::linkedin_login);
                    });
                });
            });
        })->orderBy('id', 'DESC')->limit(3)->get();

        return $blogs;
    }
    // profile
    public function profile(Request $request){
        $user = User::find( Session::get('userData')->id);
        $survey_answers = RegisterSurvey::where('user_id',$user->id)->get();
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        if(!empty($survey_answers[0])){
            $title_of_the_post = (isset(json_decode($survey_answers[0]['answers'])->title_of_the_post))?json_decode($survey_answers[0]['answers'])->title_of_the_post:'';
            $describe_mission = (isset(json_decode($survey_answers[0]['answers'])->describe_mission))?json_decode($survey_answers[0]['answers'])->describe_mission:"";
            $institution = (isset(json_decode($survey_answers[0]['answers'])->institution))?json_decode($survey_answers[0]['answers'])->institution:"";
            $graduation_year = (isset(json_decode($survey_answers[0]['answers'])->graduation_year))?json_decode($survey_answers[0]['answers'])->graduation_year:"";
            $which_institution_follow = (isset(json_decode($survey_answers[0]['answers'])->which_institution_follow))?json_decode($survey_answers[0]['answers'])->which_institution_follow:"";
            $diplom = (isset(json_decode($survey_answers[0]['answers'])->diplom))?json_decode($survey_answers[0]['answers'])->diplom:"";
            $degree_of_user = DegreeOfTheUser::where('user_id',$user->id)->first();
            if(!$degree_of_user){
                $degree_of_user = '';
            }
            return view('admin.admin.profile',compact('user','diplom','schoolInfo','graduation_year','describe_mission','institution','degree_of_user','title_of_the_post','which_institution_follow'));

        }
        return view('admin.admin.profile',compact('user','schoolInfo'));
    }


    //    // edit profile
//    public function  EditProfile(Request $request){
//        $id =  Session::get('userData')->id;
//        $user = User::find($id);
//
//        if (request()->isMethod('post'))
//        {
//            $validator = Validator::make($request->all(), [
//                'first_name' => 'required',
//                'last_name'  => 'required',
//                'picture'    => 'mimes:jpeg,bmp,png',
//            ]);
//
//            if ($validator->fails())
//            {
//                toastr()->error('Something is wrong!');
//                return Redirect::back()
//                    ->withErrors($validator) // send back all errors to the login form
//                    ->withInput();
//            }else{
//
//                $user->first_name = request('first_name');
//                $user->last_name  = request('last_name');
//                if (request('picture')){
//                    $user->avatar = parent::fileUpload(request('picture'),'images/avatar');
//                }
//                $user->city       = request('city');
//                $user->save();
//
//            }
//
//            return redirect(route('admin.profile'));
//        }
//        return view('admin.admin.edit-profile',compact('user'));
//    }

    // edit profile avatar
    public function EditProfileAvatar(Request $request){
        $id =  Session::get('userData')->id;
        if (request('id')){
            $id = request('id');
        }
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'picture'    => 'mimes:jpeg,bmp,png',
        ]);
        if ($validator->fails())
        {
            return response(['success' => false]);

        }else{
            $avatar = parent::fileUpload(request('picture'),'images/avatar');

            $user->avatar = $avatar;
            $user->save();

            return response(['success' => true,'avatar' => $avatar]);
        }
    }


    //Edit Institution
    public function EditInstitution(Request $request) {
        $id =  Session::get('userData')->id;

        if (request('id')){
            $id = request('id');
        }
        $user = User::find($id);

        if (request()->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'new_institution' => 'required',
                'old_institution' => 'required',
            ]);

            if ($validator->fails())
            {
                return response(['error' => true]);
            }else{
                $RegisterSurvey = RegisterSurvey::where('user_id',$user->id)->first();
                $NewRegisterSurvey = str_replace(request('old_institution'),request('new_institution'),$RegisterSurvey->answers);
                $RegisterSurvey->answers = $NewRegisterSurvey;
                $RegisterSurvey->save();
                return response(['success' => true]);
            }
        }
    }
    //Edit Title Of The Post
    public function EditTitleOfThePost(Request $request) {
        $id =  Session::get('userData')->id;

        if (request('id')){
            $id = request('id');
        }
        $user = User::find($id);

        if (request()->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'title_of_post' => 'required',
                'old_title_of_the_post' => 'required',
            ]);

            if ($validator->fails())
            {
                return response(['error' => true]);
            }else{
                $RegisterSurvey = RegisterSurvey::where('user_id',$user->id)->first();
                $NewRegisterSurvey = str_replace(request('old_title_of_the_post'),request('title_of_post'),$RegisterSurvey->answers);
                $RegisterSurvey->answers = $NewRegisterSurvey;
                $RegisterSurvey->save();
                return response(['success' => true]);
            }
        }
    }
    //Edit Prodile Name
    public function EditProfileName(Request $request) {
        $id =  Session::get('userData')->id;

        if (request('id')){
            $id = request('id');
        }
        $user = User::find($id);

        if (request()->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'fname' => 'required',
                'lname'  => 'required',
            ]);

            if ($validator->fails())
            {
                return response(['error' => true]);
            }else{

                $user->first_name = request('fname');
                $user->last_name  = request('lname');
                $user->save();
                return response(['success' => true]);
            }
        }
    }

    // Edit Profile City
    public function EditProfileCity(Request $request) {
        $id =  Session::get('userData')->id;

        if (request('id')){
            $id = request('id');
        }
        $user = User::find($id);

        if (request()->isMethod('post'))
        {
            $user->city       = request('city');
            $user->save();
            return response(['success' => true]);
        }
    }

    // Edit Profile Year
    public function EditProfileYear(Request $request) {
        $id =  Session::get('userData')->id;
        if (request('id')){
            $id = request('id');
        }
        $user = User::find($id);

        if (request()->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'year' => 'required',
            ]);

            if ($validator->fails())
            {
                return response(['error' => true]);
            }else {

                $user->graduation_year_id = request('year');
                $user->save();

                return response(['success' => true]);
            }
        }
    }

    public function reviewregister(Request $request){
        if (Session::get('userID')){
            $school = parent::GetSubDomain($request->getHost());
            $schoolInfo = School::where('subdomain_name',$school)->first();
            return view('admin.register',compact('schoolInfo'));
        }
        toastr()->error('Something is wrong!');
        return Redirect(route('login.admin.get'));
    }
    //Add Formation
    public function AddFormation(Request $request){
        $user = Session::get('userData');
        $validator = Validator::make($request->all(), [
            'facility'     => 'required',
            'name_of_formation' => 'required',
            'city_of_formation' => 'required',
            'graduation_year'   => 'required',
        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('formation', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $UserFormation = new UserFormation();
            $UserFormation -> user_id = $user->id;
            if(SchoolsOfRegsiterSurvey::where('id',request('facility'))->first()){
                $facility_id = SchoolsOfRegsiterSurvey::where('id',request('facility'))->first()->id;
            }
            else{
                $facility = new SchoolsOfRegsiterSurvey();
                $facility->name = request('facility');
                $facility->save();
                $facility_id = $facility->id;
            }
            $UserFormation -> facility_id = $facility_id;
            $UserFormation -> graduation_year_id = request('graduation_year');
            $UserFormation -> name_of_formation = request('name_of_formation');

            if(request('city_of_formation')){
                $UserFormation -> city_of_formation = request('city_of_formation');
            }
            $UserFormation->save();

            toastr()->success('Done');
            return Redirect::back();
        }
    }
    // Add Experience
    public function AddExperience(Request $request){
        $user = Session::get('userData');
        $validator = Validator::make($request->all(), [
            'name_of_job_post' => 'required',
            'company_id'       => 'required',
            'start_date'       => 'required|date',
            'end_date'         => 'required|date',
        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('experience', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $UserExpeience = new UserExpeience();
            $UserExpeience -> user_id = $user->id;
            $UserExpeience -> name = request('name_of_job_post');
            if($company = Company::where('id',request('company_id'))->first()){
                $company_id = $company->id;
            }
            else{
                $company = new Company();
                $company->name = request('company_id');
                $company->save();
                $company_id = $company->id;
            }
            $UserExpeience -> company_id = $company_id;
            $UserExpeience -> start_date = request('start_date');
            $UserExpeience -> end_date = request('end_date');
            if(request('description')){
                $description = preg_replace("/\r\n|\r|\n/",'<br/>',request('description'));
                $UserExpeience -> description = $description;
            }
            $UserExpeience->save();
            toastr()->success('Done');
            return Redirect::back();
        }
    }
    //Add Hobby
    public function AddHobby(Request $request){
        $user = Session::get('userData');
        $validator = Validator::make($request->all(), [
            'hobby'     => 'required',
        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('hobby', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $UserHobby = new UserHobby();
            $UserHobby -> user_id = $user->id;
            $UserHobby -> hobby = request('hobby');
            $UserHobby->save();
            toastr()->success('Done');
            return Redirect::back();
        }
    }
    public function register(Request $request){

        if ($id = Session::get('userID')){
            $surveys    = $request->all();
            $password 	 = $request->input('password');


           $require =  [
                'password'              => 'required|min:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'password_confirmation' => 'required|min:6',
                'user_avatar'           => 'required|mimes:jpeg,bmp,png',
            ];

           $message = [
               'password.confirmed' => 'The password confirmation does not match.',
               'password.*' => 'Désolé mais votre mot de passe ne correspond pas aux normes fixées par le RGPD. Celui-ci doit contenir 12 caractères et inclure à minima une majuscule, une minuscule, un chiffre et un caractère spécial. Exemple : Parapluie68!',
           ];

            $validator	= Validator::make($request->all(),$require,$message);
            if ($validator->fails()) {

                toastr()->error('Something is wrong!');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the register form
                    ->withInput();
            } else {
                $user = User::find($id);
                $user->password = Hash::make($password);
                if (request('user_avatar')){
                    $user->avatar = parent::fileUpload(request('user_avatar'),'images/avatar');
                }
                $user->save();

                unset(
                    $surveys['_token'],
                    $surveys['password'],
                    $surveys['password_confirmation'],
                    $surveys['user_avatar']
                );
                foreach ($surveys as $k => $s){
                    if (is_null($s)){
                        unset($surveys[$k]);
                    }
                }

                if (!empty($surveys['institution'])) {
                    if (!Institution::where('name', $surveys['institution'])->first()) {
                        $Institution = new Institution();
                        $Institution->name = $surveys['institution'];
                        $Institution->save();
                    }
                }

                $survey = new RegisterSurvey();
                $survey->user_id = $id;
                $survey->answers = json_encode($surveys);
                $survey->save();

                $this->mail->ID840312($user->id,$password);
            }

            toastr()->success('success');
        }else{
            toastr()->error('Something is wrong!');
        }
        return Redirect(route('login.admin.get'));
    }

    public function complete($token){
        $UserToken = Token::where('token',$token)->first();
        if($UserToken){
            $Survey = RegisterSurvey::where('user_id',$UserToken->GetUser->id)->first();
            if (empty($Survey)){
                $UserToken->GetUser->status = User::status_active;
                $UserToken->GetUser->save();
                toastr()->success('success');

                Session::put('userID', $UserToken->GetUser->id);

                return Redirect(route('register.admin.get'));
            }
        }
        toastr()->error('Something is wrong!');

        return Redirect(route('login.admin.get'));
    }

}
