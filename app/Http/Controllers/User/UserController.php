<?php

namespace App\Http\Controllers\User;

use App\BlogOfTheSchool;
use App\Institution;
use App\JobBoard;
use App\Questions;
use App\RegisterSurvey;
use App\School;
use App\SchoolOfTheUser;
use App\Token;
use Carbon\Carbon;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ResultOfTheSurvey;
use App\CategoryOfTheUser;
use App\DegreeOfTheUser;
use App\UserExpeience;
use App\UserFormation;
use App\UserHobby;
use App\SurveyTypes;
use App\BlogPost;
use App\Company;
use App\User;
use Socialite;
use Artisan;
use Exception;
use Session;
use Crypt;
use Hash;
use Mail;
use Auth;

class UserController extends Controller
{
    public function __construct(MailController $mail)
    {
        $this->mail = $mail;
    }

    //Dashboard
    public function Dashboard(Request $request)
    {
        $jobs = JobBoard::orderBy('id', 'DESC')->paginate(4);
        $user = Session::get('userData');

        if ($request->ajax()) {

            return view('user.user.jobmore', compact('jobs'));
        }
        $users = User::where('type',User::user)->orderBy('id', 'DESC')->limit(6)->get();
        $mentors = User::where(['type' => User::user,'mentorat' => User::mentorat])->orderBy('id', 'DESC')->limit(4)->get();
        $ScoolOfTheUser = SchoolOfTheUser::where('user_id',$user->id)->first();
        $blogs = $this->UserBlog();
        $blog_posts = BlogOfTheSchool::where('school_id',$ScoolOfTheUser->school_id)->orderBy('id', 'DESC')->limit(3)->get();
        return view('user.user.dashboard',compact('users','mentors','jobs','blogs','blog_posts','ScoolOfTheUser'));
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
                $UserExpeience -> description = request('description');
            }
            $UserExpeience->save();
            toastr()->success('Done');
            return Redirect::back();
        }
    }
    // UpdUpdateJobate Group
    public function UpdateJobInfo(Request $request){
        $id = Crypt::decrypt($request->input('id'));
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

    // Edit Job
    public function EditJobBoard(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if ($job = JobBoard::find($id)) {
            return response(['success' => true,'job' => $job]);
        }else{
            return response(['success' => false]);
        }
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
            $UserFormation -> facility_id = request('facility');
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
                return Redirect('/user/dashboard');
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
        return Redirect('/');
    }

    // check email or username and password
    public function checkLogin($username, $password,$school)
    {
        $user = User::where(['type' => User::user,'email' => $username])->first();
        if(!empty($user)){
            if(Hash::check($password, $user->password) ){
                if ($user->status == 1) {
                    if($this->checkUserSchool($user,$school)){
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

    public function checkUserSchool($user,$school){
        foreach ($user->chooseSchool as $schools){
            if(strtolower($schools->school->subdomain_name) == $school){
                return true;
            }
        }
        return false;
    }


    public  function RedirectToLinkedin(){
        $envs = [
            'APP_URL'           => url('/'),
            'LINKEDIN_REDIRECT' => url('/linkedin/callback'),
        ];
        parent::setEnvironmentValue($envs);
        Artisan::call('config:cache');
        return Socialite::driver('linkedin')->stateless(Str::random(40))->scopes(['r_basicprofile','r_emailaddress','w_share'])->redirect();
    }


    public  function CallbackOnLinkedin(Request $request){
        if($error = request('error_description')){
            toastr()->warning($error);
            return Redirect(route('login.view'));
        }
        try {
            $linkdinUser = Socialite::driver('linkedin')->stateless()->user();
            $userID = Session::get('userID');
            if ($userID) {
                $existUser = User::find($userID);
                $linkedinUser = false;

            }else{
                $existUser = User::where('email',$linkdinUser->email)->first();
                $linkedinUser =  User::where('email',$linkdinUser->email)->first();
            }
            $school = parent::GetSubDomain($request->getHost());
            $schoolInfo = School::where('subdomain_name',$school)->first();
            $schoolName = $schoolInfo->name;
            $name = null;
            if (!is_null($linkdinUser->avatar)){
                $name = str_random(20).'.jpg';
                $data = file_get_contents($linkdinUser->avatar);
                $new = "images/avatar/".$name;
                file_put_contents($new, $data);
            }
            if($existUser) {
                if ($linkedinUser){
                    $existUser->first_name = $linkdinUser->first_name;
                    $existUser->last_name = $linkdinUser->last_name;
                }
                $existUser->avatar = $name;
                $existUser->linkedin = User::linkedin_login;
                $existUser->status = User::status_active;
                $existUser->save();
                if($schoolInfo){
                    if (!SchoolOfTheUser::where(['school_id' => $schoolInfo->id,'user_id' => $existUser->id])->first()) {
                        $SchoolOfTheUser = new SchoolOfTheUser();
                        $SchoolOfTheUser->school_id = $schoolInfo->id;
                        $SchoolOfTheUser->user_id = $existUser->id;
                        $SchoolOfTheUser->save();
                    }
                }else{
                    abort(404);
                }
            }
            else {
                $user = new User;
                $user->first_name = $linkdinUser->first_name;
                $user->last_name = $linkdinUser->last_name;
                $user->avatar = $name;
                $user->email = $linkdinUser->email;
                $user->password =  Hash::make(str_random(20));
                $user->linkedin = User::linkedin_login;
                $user->status = User::status_active;
                $user->date_of_import = Carbon::now();
                $user->save();

                if($schoolInfo){
                    $SchoolOfTheUser = new SchoolOfTheUser();
                    $SchoolOfTheUser->school_id = $schoolInfo->id;
                    $SchoolOfTheUser->user_id = $user->id;
                    $SchoolOfTheUser->save();
                }else{
                    abort(404);
                }
            }

            if ($linkedinUser){

                Session::put('userData', $linkedinUser);
                return Redirect('/');
            }
            if ($userID) {
                $user = User::find($userID);

            }else{
                $user = User::where('email',$linkdinUser->email)->first();
            }
            Session::put('userID', $user->id);
            Session::put('linkdin', true);
            $linkedin = false;
            $complete = false;
            $complete_user = $user;
            return view('user.register', compact('schoolName', 'complete_user','complete','linkedin','schoolInfo'));
        }
        catch (Exception $e) {
            abort(404);
        }
    }

    // View Reset password Form
    public function ResetView(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('user.reset_password',compact('schoolInfo'));
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
            $user = User::where(['email' => $email,'type' => User::user])->first();
            if($user){
                $password = str_random(14);
                $user->password = Hash::make($password);
                $user->save();
                $this->mail->ID871487($user->id,$password);
                toastr()->success("Please check your Email");
//                $reset_password = new ResetPassword();
//                $reset_password->user_id = $user->id;
//                $reset_password->token   = $token;
//                $reset_password->status  = 0;
//                $reset_password->expire  = date('Y-m-d H:i:s');
//                $reset_password->save();
//                $data = [
//                    'token' => $token,
//                    'name' => $user->first_name . ' ' . $user->last_name,
//                ];
//                Mail::send(['html' => 'mail.confirm_email'], $data, function ($message) use ($user){
//                    $message->from('leonid.danielyan.96@gmail.com', 'Datalumni');
//                    $message->to($user->email,$user->first_name)->subject('confirm');
//                });
            }
            else{
                toastr()->error("The email doesn't exist");
            }
        }
        return Redirect('/login');
    }

    // user register
    public function viewRegister(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        $schoolName = $schoolInfo->name;
        $complete  = true;
        $linkedin  = true;
        $complete_user = false;
        return view('user.register',compact('schoolName','complete','linkedin','complete_user','schoolInfo'));
    }

     // user register post

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function register(Request $request){
        $surveys    = $request->all();
        $first_name = $request->input('first_name');
        $last_name	 = $request->input('last_name');
        $email    	 = $request->input('email');
        $birth      = $request->input('date');
        $password 	 = $request->input('password');
        $city       = $request->input('city');
        $userID = Session::get('userID');
        $linkdin = Session::get('linkdin');

        $require = [];
        if (!$linkdin) {
            $require['user_avatar']  =  'required|mimes:jpeg,bmp,png';
            $require['city'] = 'required';
            $require['date'] = 'required';
            $require['password'] = 'required|min:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
            $require['password_confirmation'] = 'required|min:6';
            if (empty($userID)){
                $require['email'] = 'required|email|unique:users';
                $require['first_name'] = 'required';
                $require['last_name'] = 'required';
            }
        }
        $message = [
            'password.confirmed' => 'The password confirmation does not match.',
            'password.*' => 'Désolée mais votre mot de passe ne correspond pas aux normes fixées par la RGPD, celui-ci doit contenir 12 caractères et inclure à minima une majuscule, une minuscule, un chiffre et un caractère spécial. Exemple : Parapluie68!',
        ];
        $validator	= Validator::make($request->all(), $require,$message);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the register form
                ->withInput();
        } else {
            if (!$linkdin) {
                if (!empty($userID)) {
                    $user = User::find($userID);
                } else {
                    $user = new User;
                    $user->first_name = $first_name;
                    $user->last_name = $last_name;
                    $user->email = $email;
                }
                if (!empty($password)) {
                    $user->password = Hash::make($password);
                } else {
                    $password = str_random(20);
                    $user->password = Hash::make($password);
                }
                $user->city = $city;
                $user->date_of_birth = $birth;
            }else{
                $user = User::find($userID);
            }

            if (request('user_avatar')) {
                $user->avatar = parent::fileUpload(request('user_avatar'), 'images/avatar');
            }
            if ($user->save()) {
                //change when end
                if(!empty($userID)){
                    unset(
                        $surveys['_token'],
                        $surveys['password'],
                        $surveys['password_confirmation']
                    );
                }else{
                    $school = parent::GetSubDomain($request->getHost());
                    $school_info = School::where('subdomain_name',$school)->first();
                    if($school_info){
                        $SchoolOfTheUser = new SchoolOfTheUser();
                        $SchoolOfTheUser->school_id = $school_info->id;
                        $SchoolOfTheUser->user_id = $user->id;
                        $SchoolOfTheUser->save();
                    }else{
                        abort(404);
                    }
                    $this->mail->ID781040($user->id);

                    unset(
                        $surveys['_token'],
                        $surveys['first_name'],
                        $surveys['last_name'],
                        $surveys['email'],
                        $surveys['date'],
                        $surveys['city'],
                        $surveys['category'],
                        $surveys['password'],
                        $surveys['password_confirmation'],
                        $surveys['user_avatar']
                    );
                }
                foreach ($surveys as $k => $s){
                    if (is_null($s)){
                        unset($surveys[$k]);
                    }
                }

                if (!empty($surveys['institution'])){
                    if(!Institution::where('name',$surveys['institution'])->first()){
                        $Institution = new Institution();
                        $Institution->name = $surveys['institution'];
                        $Institution->save();
                    }
                }

                $survey = new RegisterSurvey();
                $survey->user_id = $user->id;
                $survey->answers = json_encode($surveys);
                $survey->save();
                $this->mail->ID840312($user->id,$password);

                toastr()->success('success');
            }
            Session::forget('userID');
            Session::forget('linkdin');
            return Redirect(route('login.view'));
        }
    }

     // survey create
    public  function survey(Request $request,$type,$user_id){
        $survey = SurveyTypes::find($type);
        foreach($survey->getSurvey->GetQuestions as $question){
            if (!is_null($result = $request->input('answer'.$question->id))){
                $answer = new ResultOfTheSurvey();
                $answer->survey_type_id = $type;
                $answer->survey_id = $question->survey_id;
                $answer->questions_id = $question->id;
                $answer->user_id = $user_id;
                if (is_array($result)){
                    $items = [];
                    foreach($result as $item){
                        $items[] = Crypt::decrypt($item);
                    }
                    $answer->answer = json_encode($items);
                }else{
                    $answer->answer = $result;
                }
                $answer->save();
            }
        }
    }

    // user profile
    public  function  UserProfile(Request $request , $id){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        $survey_answers = RegisterSurvey::where('user_id',$id)->get();
        if($user = User::where('id',$id)->where('type','<>',User::super_admin)->first()){
            $user_id = Session::get('userData')->id;
            if(!empty($survey_answers[0])){
                $company_name = (isset(json_decode($survey_answers[0]['answers'])->which_company_you_work))?json_decode($survey_answers[0]['answers'])->which_company_you_work:'';
                $mentor = (isset(json_decode($survey_answers[0]['answers'])->student_mentor))?json_decode($survey_answers[0]['answers'])->student_mentor:"";
                $what_function_copy = (isset(json_decode($survey_answers[0]['answers'])->what_function_copy))?json_decode($survey_answers[0]['answers'])->what_function_copy:"";
                $title_of_the_post = (isset(json_decode($survey_answers[0]['answers'])->title_of_the_post))?json_decode($survey_answers[0]['answers'])->title_of_the_post:"";
                $degree_of_user = DegreeOfTheUser::where('user_id',$id)->first();
                return view('user.directory.profile',compact('user','user_id','schoolInfo','company_name','mentor','what_function_copy','degree_of_user','title_of_the_post'));
            }
            return view('user.directory.profile',compact('user','schoolInfo'));
        }
        toastr()->error('Such user does not exist!');
        return Redirect(route('user.directory'));
    }




    // profile
    public function profile(Request $request){
        $user = User::find( Session::get('userData')->id);
        $survey_answers = RegisterSurvey::where('user_id',$user->id)->get();
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        if(!empty($survey_answers[0])){
            $company_name = (isset(json_decode($survey_answers[0]['answers'])->which_company_you_work))?json_decode($survey_answers[0]['answers'])->which_company_you_work:'';
            $mentor = (isset(json_decode($survey_answers[0]['answers'])->student_mentor))?json_decode($survey_answers[0]['answers'])->student_mentor:"";
            $what_function_copy = (isset(json_decode($survey_answers[0]['answers'])->what_function_copy))?json_decode($survey_answers[0]['answers'])->what_function_copy:"";
            $title_of_the_post = (isset(json_decode($survey_answers[0]['answers'])->title_of_the_post))?json_decode($survey_answers[0]['answers'])->title_of_the_post:"";
            $degree_of_user = DegreeOfTheUser::where('user_id',$user->id)->first();
            if(!$degree_of_user){
                $degree_of_user = '';
            }
            return view('user.user.profile',compact('user','schoolInfo','company_name','mentor','what_function_copy','degree_of_user','title_of_the_post'));

        }
        return view('user.user.profile',compact('user','schoolInfo'));
    }

    // edit profile
//    public function  EditProfile(Request $request){
//        $id =  Session::get('userData')->id;
//        $user = User::find($id);
//
//        if (request()->isMethod('post'))
//        {
//            $validator = Validator::make($request->all(), [
//                'first_name' => 'required',
//                'last_name'  => 'required',
//                'picture'  => 'mimes:jpeg,bmp,png',
//                'city'       => 'required',
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
//        return view('user.user.edit-profile',compact('user'));
//    }


// edit profile avatar
    public function EditProfileAvatar(Request $request){
        $id =  Session::get('userData')->id;
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


    //Edit Prodile Name
    public function EditProfileName(Request $request) {
        $id =  Session::get('userData')->id;
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

        $user = User::find($id);

        if (request()->isMethod('post'))
        {
            $user->city       = request('city');
            $user->save();
            return response(['success' => true]);
        }
    }

    // Edit Profile Year
    public function EditProfileYear(Request $request)
    {
        $id = Session::get('userData')->id;
        $user = User::find($id);

        if (request()->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'year' => 'required',
            ]);

            if ($validator->fails()) {
                return response(['error' => true]);
            } else {

                $user->graduation_year_id = request('year');
                $user->save();

                return response(['success' => true]);
            }
        }
    }


    public function CheckAllUserSActive(){
        $users = User::where(['type' => User::user])->get();

        foreach ($users as $user){
            // After 4 days
            if ($user->status == User::status_inactive && Carbon::now()->subDays(4)->format('Y-m-d') == Carbon::parse($user->created_at)->format('Y-m-d')){
                $this->mail->ID781431($user->id);
            }

            // After 10 days
            if ($user->status == User::status_inactive && Carbon::now()->subDays(10)->format('Y-m-d') == Carbon::parse($user->created_at)->format('Y-m-d')){
                $this->mail->ID781421($user->id);
            }

            // After Two weeks
            if ($user->status == User::status_active && Carbon::now()->subWeek(2)->format('Y-m-d') == Carbon::parse($user->created_at)->format('Y-m-d')){

                if($category = $user->chooseColor){
                    if($category->category->title == 'Student'){
                        $this->mail->ID781834($user->id);
                    }else if($category->category->title == 'Alumni'){
                        $this->mail->ID781765($user->id);
                    }else if($category->category->title == 'Teacher'){
                        $this->mail->ID781801($user->id);
                    }
                }
            }

        }
    }

    public function complete(Request $request,$token){
        $UserToken = Token::where('token',$token)->first();
        if($UserToken){
            if ($UserToken->status == Token::status_active) {
                if ($UserToken->GetUser) {
                    $Survey = RegisterSurvey::where('user_id', $UserToken->GetUser->id)->first();
                    $UserToken->GetUser->status = User::status_active;
                    $UserToken->status = Token::status_inactive;
                    $UserToken->GetUser->save();
                    $UserToken->save();
                    if (empty($Survey)) {
                        $complete = false;
                        $linkedin = true;
                        $school = parent::GetSubDomain($request->getHost());
                        $schoolInfo = School::where('subdomain_name', $school)->first();
                        $schoolName = $schoolInfo->name;
                        Session::put('userID', $UserToken->GetUser->id);
                        $complete_user = $UserToken->GetUser;
                        return view('user.register', compact('schoolName', 'complete_user','complete', 'linkedin', 'schoolInfo'));
                    }
                    toastr()->success('success');
                    return Redirect(route('login.view'));
                }
            }
        }
        toastr()->error('Something is wrong!');
        return Redirect(route('login.view'));
    }
}
