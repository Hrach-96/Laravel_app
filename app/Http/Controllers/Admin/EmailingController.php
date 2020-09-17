<?php

namespace App\Http\Controllers\Admin;

use App\School;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;
use Mail;

class EmailingController extends Controller
{
    // emailing
    public function emailing(Request $request){
        $platform = $request->input('platform');
        $degrees = $request->input('degree');
        $year_of_graduation = $request->input('year_of_graduation');
        $categorys = $request->input('category');
        $users = User::where('type',User::user)
            ->where(function ($sql) use ($platform,$degrees,$year_of_graduation,$categorys){
                $sql->Where(function($query) use ($platform){
                    if(!empty($platform)){
                        if ($platform == 'Active'){
                            $query->Where('status',User::status_active);
                        }else if($platform == 'Inactive'){
                            $query->Where('status',User::status_inactive);
                        }
                    }
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
                })->Where(function ($query) use ($year_of_graduation){
                    if(!empty($year_of_graduation)){
                        $query->WhereHas('GetGraduationYear', function ($q) use($year_of_graduation) {
                            $q->Where('year',$year_of_graduation);
                        });
                    }
                });
            })->orderBy('id', 'DESC')->paginate(2);

        if ($request->ajax()) {
            $ids = Session::get('users_ids');
            Session::put('users_ids', array_merge($ids, $users->pluck('id')->toArray()));
            return view('admin.emailing.usermore', compact('users'));
        }
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        Session::forget('users_ids');
        Session::put('users_ids', $users->pluck('id')->toArray());
        return view('admin.emailing.emailing',compact('users','schoolInfo','free_search','degrees','year_of_graduation','categorys','jobs'));
    }

    // send Mail
    public function SendMail(Request $request){

        $validator = Validator::make($request->all(), [
            'subject' => 'required',

        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $ids = Session::get('users_ids');

            if (!empty($ids[0])) {
                foreach ($ids as $id) {
                    if ($user = User::find($id)) {
                        $text = 'Hi '.$user->first_name;
                        Mail::raw(request('subject'), function ($message) use($user,$text) {
                            $message->from('laura@datalumni.com', 'Datalumni');
                            $message->to($user->email)
                            ->subject($text);
                        });
                    }
                }
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
        }
        return Redirect::back();
    }
}
