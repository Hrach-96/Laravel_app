<?php

namespace App\Http\Controllers\user;

use App\AdminOfTheSchool;
use App\BlogOfTheSchool;
use App\BlogPost;
use App\BlogPostOfTheUser;
use App\School;
use App\SchoolOfTheUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class BlogController extends Controller
{
    //
    public function Blog(Request $request)
    {
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        $user = Session::get('userData');
        $SchoolOfTheUser = SchoolOfTheUser::where('user_id',$user->id)->first();
        return view('user.blog.blog',compact('SchoolOfTheUser','schoolInfo'));
    }

    // add blog page
    public function AddBlog (Request $request){
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('user.blog.addblog',compact('schoolInfo'));
    }
    //    BlogInfo
    public function BlogInfo(Request $request){
        $BlogPost = BlogPost::where('id',$request->id)->first();
        $school = parent::GetSubDomain($request->getHost());
        $schoolInfo = School::where('subdomain_name',$school)->first();
        return view('user.blog.bloginfo',compact('BlogPost','schoolInfo'));
    }
    // add blog
    public function NewBlog (Request $request){
        $user = Session::get('userData');
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'image_for_blog' => 'required|mimes:jpeg,bmp,png',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $BlogPost = new BlogPost;
            $BlogPost->title = request('title');
            $BlogPost->content = request('content');
            $BlogPost->date_of_creation = Carbon::now();
            $BlogPost->image = parent::fileUpload(request('image_for_blog'),'images/Blogs');
            $BlogPost->sender = $user->email;
            $BlogPost->status = (request('active') == 'on' )? BlogPost::status_active : BlogPost::status_inactive;
            $BlogPost->save();

            $BlogOfTheUser = new BlogPostOfTheUser;
            $BlogOfTheUser->blog_id = $BlogPost->id;
            $BlogOfTheUser->user_id = $user->id;
            $BlogOfTheUser->save();

            $SchoolOfTheUser = SchoolOfTheUser::where('user_id',$user->id)->first();
            $BlogOfTheSchool = new BlogOfTheSchool();
            $BlogOfTheSchool->school_id = $SchoolOfTheUser->school_id;
            $BlogOfTheSchool->blog_id = $BlogPost->id;
            $BlogOfTheSchool->save();
            toastr()->success('Success');
            return Redirect(route('admin.blog'));
        }
    }
}
