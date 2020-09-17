<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Session;
use Mail;
use \Mailjet\Resources;


class SuperAdminController extends Controller
{

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
            $check = $this->checkLogin($request->input('email'),$request->input('password'));
            if ($check){
                if ($referer = Session::get('referer')){
                    Session::forget('referer');
                    return Redirect($referer);
                }
                return Redirect('/super_admin/dashboard');
            }
            else{
                return Redirect::back();
            }

        }
    }

    // check email or username and password
    public function checkLogin($username, $password)
    {
        $user = User::where(['type' => User::super_admin,'email' => $username])->first();
        if(!empty($user)){
            if(Hash::check($password, $user->password) ){
                if ($user->status == 1) {
                    Session::put('userData', $user);
                    return true;
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

    //logout
    public function logout()
    {
        Session::forget('userData');
        return Redirect(route('login.super_admin.get'));
    }

    // setting
    public function setting()
    {
        return view('super_admin.setting');
    }

    public  function  mailTest(){

        $mj = new \Mailjet\Client('a3ad6ec7baf26a06e127fe269c5b322', '334afa2871166ab49e924082f1234ee2',
            true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => "leonid.danielyan.96@gmail.com",
                            'Name' => "datalumni 1 "
                        ]
                    ],
                    'Subject' => "Développement de votre réseau d'anciens",
                    'TextPart' => "Dear passenger 1, welcome to Mailjet! May the delivery force be with you!",
                    'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        echo "<pre>";
        var_dump($response->success());
        echo "</pre>";
        die;
        $response->success() && var_dump($response->getData());
    }

}
