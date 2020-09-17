<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Http\Request;
use App\User;
use Mailjet\Resources;

class MailController extends Controller
{
    public function __construct()
    {
        $this->mj =  new \Mailjet\Client('ea3ad6ec7baf26a06e127fe269c5b322', '334afa2871166ab49e924082f1234ee2',true,['version' => 'v3.1']);
    }
    //

    public function ID781694($id){
        $user = User::find($id);
        $url = $user->GetAdminSchool->GetSchoolInfo->url.'/admin/complete/';

        if($GetToken = $user->GetToken){
            $token = $GetToken->token;
        }else{
            $token = parent::GenerateToken(48);

            $CreateToken = new Token();
            $CreateToken->token = $token;
            $CreateToken->user_id = $user->id;
            $CreateToken->save();
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Lancement de votre plateforme alumni : c’est parti !",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781694,
                    'Variables' => [
                        'first_name' => $user->first_name,
                        'active' => "<a style='background-color: #ffb600;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='". $url.''.$token."'>ACTIVEZ VOTRE COMPTE</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781040($id){
        $user = User::find($id);

        if($GetToken = $user->GetToken){
            $token = $GetToken->token;
        }else{
            $token = parent::GenerateToken(48);

            $CreateToken = new Token();
            $CreateToken->token = $token;
            $CreateToken->user_id = $user->id;
            $CreateToken->save();
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Félicitations, votre compte est désormais créé",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781040,
                    'Variables' => [
                        'network' => "<a style='background-color: #00a19b;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-weight: bold;font-size: 14px;' href='".route('login.view')."'>ACCÉDER AU RESEAU</a>",
                        'complete' => "<a style='    background-color: #00a19b;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-weight: bold;font-size: 14px;' href='".route('complete.user',['token' => $token])."'>COMPLÉTER SON PROFIL</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID840312($id,$password){
        $user = User::find($id);

        if ($user->type == User::admin) {
            $url = $user->GetAdminSchool->GetSchoolInfo->url.'/admin/login';
        }else{
            $url = url('/');
        }


        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Félicitations, votre compte est désormais créé",
                    'TemplateLanguage' => true,
                    'TemplateID' => 840312,
                    'Variables' => [
                        'first_name' => $user->first_name,
                        'password' => $password,
                        'network' => "<a style='background-color: #00a19b;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-weight: bold;font-size: 14px;' href='".$url."'>ACCÉDER AU RESEAU</a>",
                        'complete' => "<a style='background-color: #00a19b;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-weight: bold;font-size: 14px;' href='".$url."'>COMPLÉTER SON PROFIL</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781431($id){
        $user = User::find($id);

        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }

        if($GetToken = $user->GetToken){
            $token = $GetToken->token;
        }else{
            $token = parent::GenerateToken(48);

            $CreateToken = new Token();
            $CreateToken->token = $token;
            $CreateToken->user_id = $user->id;
            $CreateToken->save();
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Rappel : votre établissement vous invite à intégrer son réseau alumni",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781431,
                    'Variables' => [
                        'schools' => $schools,
                        'first_name' => $user->first_name,
                        'active' => "<a style='background-color: #ffb600;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='".route('complete.user',['token' => $token])."'>ACTIVEZ VOTRE COMPTE</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781421($id){
        $user = User::find($id);

        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }

        if($GetToken = $user->GetToken){
            $token = $GetToken->token;
        }else{
            $token = parent::GenerateToken(48);

            $CreateToken = new Token();
            $CreateToken->token = $token;
            $CreateToken->user_id = $user->id;
            $CreateToken->save();
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Félicitations, votre compte est désormais créé",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781421,
                    'Variables' => [
                        'schools' => $schools,
                        'first_name' => $user->first_name,
                        'active' => "<a style='background-color: #ffb600;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='".route('complete.user',['token' => $token])."'>ACTIVEZ VOTRE COMPTE</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781834($id){
        $user = User::find($id);

        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Bénéficiez de la force de votre réseau alumni",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781834,
                    'Variables' => [
                        'schools' => $schools,
                        'network' => "<a style='background-color: #ffb600;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 16px;' href='".route('login.view')."'>Accéder à mon réseau</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781765($id){
        $user = User::find($id);

        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Bénéficiez de la force de votre réseau alumni",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781765,
                    'Variables' => [
                        'schools' => $schools,
                        'first_name' => $user->first_name
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781801($id){
        $user = User::find($id);

        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Félicitations, votre compte est désormais créé",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781801,
                    'Variables' => [
                        'schools' => $schools,
                        'first_name' => $user->first_name
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID840231($id,$admin){
        $user = User::find($id);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Quelqu'un de votre communauté souhaite que vous deveniez son mentor",
                    'TemplateLanguage' => true,
                    'TemplateID' => 840231,
                    'Variables' => [
                        'first_name' => $user->first_name,
                        'admin_first_name' => $admin->first_name,
                        'person' => "<a style='    background-color: #00a19b;padding: 10px 25px;border-radius: 3px;text-decoration: none;font-weight: bold;color: white;font-size: 14px;' href='".route('user.user.profile',['id' => $admin->id])."'>PROFILE OF the person</a>",
                        'oul'    => "<a style='    background-color: #414141;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='".route('accept.mentor.user',['id' => $id])."'>OUI</a>",
                        'non'    => "<a style='    background-color: #414141;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='".route('decline.mentor.user',['id' => $id])."'>NON</a>",
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781677($id){
        $user = User::find($id);


        if($GetToken = $user->GetToken){
            $token = $GetToken->token;
        }else{
            $token = parent::GenerateToken(48);

            $CreateToken = new Token();
            $CreateToken->token = $token;
            $CreateToken->user_id = $user->id;
            $CreateToken->save();
        }

        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Lancement de votre plateforme alumni : c’est parti !",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781677,
                    'Variables' => [
                        'first_name' => $user->first_name,
                        'school' => $schools,
                        'active' => "<a style='background-color: #ffb600;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='".route('complete.user',['token' => $token])."'>ACTIVEZ VOTRE COMPTE</a>",
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781636($id){
        $user = User::find($id);

        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }
        if($GetToken = $user->GetToken){
            $token = $GetToken->token;
        }else{
            $token = parent::GenerateToken(48);

            $CreateToken = new Token();
            $CreateToken->token = $token;
            $CreateToken->user_id = $user->id;
            $CreateToken->save();
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Lancement de votre réseau d’anciens : c’est parti !",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781636,
                    'Variables' => [
                        'first_name' => $user->first_name,
                        'schools' => $schools,
                        'active' => "<a style='    background-color: #ffb600;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='".route('complete.user',['token' => $token])."'>ACTIVEZ VOTRE COMPTE</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    public function ID781656($id){
        $user = User::find($id);
        $schools = '';
        foreach ($user->chooseSchool as $school){
            $schools.= $school->school->name.' ';
        }
        if($GetToken = $user->GetToken){
            $token = $GetToken->token;
        }else{
            $token = parent::GenerateToken(48);

            $CreateToken = new Token();
            $CreateToken->token = $token;
            $CreateToken->user_id = $user->id;
            $CreateToken->save();
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Lancement de votre plateforme alumni : c’est parti ! de la plateforme : c’est parti ! est désormais créé",
                    'TemplateLanguage' => true,
                    'TemplateID' => 781656,
                    'Variables' => [
                        'name' => $user->first_name." ".$user->last_name,
                        'schools' => $schools,
                        'active' => "<a style='    background-color: #ffb600;padding: 10px 25px;border-radius: 3px;text-decoration: none;color: white;font-size: 14px;' href='".route('complete.user',['token' => $token])."'>ACTIVEZ VOTRE COMPTE</a>"
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }


    // forgot password
    public function ID871487($id,$password){
        $user = User::find($id);

        if ($user->type == User::admin) {
            $url = $user->GetAdminSchool->GetSchoolInfo->url.'/admin/login';
        }else{
            $url = url('/');
        }

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laura@datalumni.com",
                        'Name' => "Datalumni"
                    ],
                    'To' => [
                        [
                            'Email' => $user->email,
                            'Name' => $user->first_name,
                        ]
                    ],
                    'Subject' => "Réinitialisation de votre mot de passe",
                    'TemplateLanguage' => true,
                    'TemplateID' => 871487,
                    'Variables' => [
                        'gmail' => $user->email,
                        'password' => $password,
                        'network' => "<a style='background-color: #00a19b;padding: 10px;border-radius: 3px;text-decoration: none;color: white;font-weight: bold;font-size: 14px;' href='".$url."'>Accéder à la plateforme</a>",
                    ]
                ]
            ]
        ];
        $response = $this->mj->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

}
