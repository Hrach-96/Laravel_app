<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\School;
use App\User;

class DirectoryController extends Controller
{
    // directory
    public  function directory(Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        $free_search = $request->input('free_search');
        $degrees = $request->input('degree');
        $year_of_graduation = $request->input('year_of_graduation');
        $categorys = $request->input('category');
        $jobs = $request->input('job');
        $users = User::where('type',User::user)
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
            })->paginate(8);

        if ($request->ajax()) {

            return view('user.directory.usermore', compact('users'));
        }
        return view('user.directory.directory',compact('users','schoolInfo', 'free_search','degrees','year_of_graduation','categorys','jobs'));
    }

}
