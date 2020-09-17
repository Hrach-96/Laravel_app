<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\School;
use App\User;
use Session;
use Hash;

class MentoratController extends Controller
{
    public function __construct(MailController $mail)
    {
        $this->mail = $mail;
    }
    // mentorship
    public  function mentorship(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        $free_search = $request->input('free_search');
        $degrees = $request->input('degree');
        $year_of_graduation = $request->input('year_of_graduation');
        $categorys = $request->input('category');
        $jobs = $request->input('job');
        $users = User::where(['type' => User::user,'mentorat' => User::mentorat])
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
            return view('admin.mentorat.usermore', compact('users'));
        }
        Session::forget('users_ids');
        Session::put('users_ids', $users->pluck('id')->toArray());
        $mentors = User::where(['type' => User::user,'mentorat' => User::mentorat])->orderBy('id', 'DESC')->limit(8)->get();
        return view('admin.mentorat.mentorship',compact('users', 'free_search','degrees','year_of_graduation','categorys','jobs','schoolInfo','mentors'));
    }

    // csv mentor
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

    // add Mentor user from id
    public function AddMentoratUser($id){
        if($user = User::where(['id' => $id,'mentorat' => User::not_mentorat,'type' => User::user])->first()){
            $this->mail->ID840231($user->id,Session::get('userData'));
            toastr()->success('This user has been emailed to approve mentor');

            $user->mentorat = User::in_standby_mentorat;
            $user->save();
        }else{
            toastr()->error('Something is wrong!');
        }
        return Redirect::back();
    }
}
