<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="token" content="{{ csrf_token() }}"/>
    <meta name="url" content="{{ URL('/') }}"/>
    <title>Datalumni</title>
    <!-- Icons-->
    <link href="{{ asset('css/custom/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/owl.theme.default.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{asset('images/custom/favicon.png')}}" type="image/gif" sizes="16x16">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @toastr_css
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<div class="signup-frm py-5">
    <div class="container-fluid bg-blur ">
        <div class="signup-frm-wrp m-auto">
            <div class=" signup-frm-header clearfix">
                <ul class="mybread d-flex justify-content-between">
                    <li class="square square-left bg-gre" id="cr-left">
                        <span class="bg-gre step">1</span>
                        <p>Activation de votre compte</p>
                    </li>
                    <li class="square square-center" id="cr-cent">
                        <span class="step">2</span>
                        <p>Complétion du profil</p>
                    </li>
                    <li class="square square-right" id="cr-right">
                        <span class="step">3</span>
                        <p>C'est parti !</p>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="signup-frm-form mt-5">
                <div class="row">
                    <div class="col-md-6 signup-frm-form-lside">
                        <div class="signup-frm-form-lside-wrp h-100 w-100 d-table ">
                            <div class="d-table-cell align-middle">
                                <div class="signup-logo text-center ">
                                    <a href="{{ url('/') }}">
                                        <img src="{{  asset('images/Schools/'.$schoolInfo->logo) }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 signup-frm-form-rside bg-white">
                        <form id="regForm" action="{{ route('register.user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab" >
	                            @if(!Session::get('linkdin'))
		                            <div class="">
	{{--                                    <div class="form-group currently-working-wrp float-right" id="etape2_time" access="true">30</div>--}}
	                                    <h3 class="text-center">Etape 1</h3>
	                                    @if($complete || $linkedin)
	                                    <div class="linkedin-btn-wrp">
	                                        <a href="{{ route('user.linkedin.redirect') }}" class="btn btn-theme-x btn-block my-4 p-3 position-relative"><i class="fa fa-linkedin-square btn-left-design"></i> &nbsp; S’inscrire avec LinkedIn</a>
	                                        <p class="text-center or">
	                                            <span>Ou</span>
	                                        </p>
	                                    </div>
	                                    @endif
	                                </div>
	                                <div class="text-info error_message">
	                                    Votre mot de passe doit contenir minimum 12 caractères, une majuscule, une minuscule, une chiffre et un caractère spécial.
	                                </div>
	                                @if($complete)
	                                    <div class="form-group signup-form-group-paswrd">
	                                        @if ($errors->has('first_name'))
	                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name') }}</strong></p>
	                                        @endif
	                                        <input type="text" class="form-control" name="first_name" id="first_name" required="" value="{{ old('first_name') }}" placeholder="Prénom">
	                                    </div>
	                                    <div class="form-group signup-form-group-paswrd">
	                                        @if ($errors->has('last_name'))
	                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
	                                        @endif
	                                        <input type="text" class="form-control" name="last_name" id="last_name" required="" value="{{ old('last_name') }}" placeholder="Nom">
	                                    </div>
	                                    <div class="form-group signup-form-group-paswrd">
	                                        @if ($errors->has('email'))
	                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
	                                        @endif
	                                        <input type="email" class="form-control" name="email" id="email" required="" value="{{ old('email') }}" placeholder="Adresse email">
	                                    </div>
	                                @endif

	                                <div class="form-group signup-form-group-paswrd date_div">
	                                    @if ($errors->has('date'))
	                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('date') }}</strong></p>
	                                    @endif
	                                    <input type="date" placeholder="Date de naissance" class="form-control dateclass placeholderclass" name="date" id="date"  value="{{ old('date') }}" required="" >
	                                </div>
	                                <div class="form-group signup-form-group-paswrd">
	                                    @if ($errors->has('city'))
	                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('city') }}</strong></p>
	                                    @endif
	                                    <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}" placeholder="Ville">
	                                </div>
	                                @if($complete)
	                            @endif
	                                <div class="form-group mb-2">
	                                @if ($errors->has('password'))
	                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('password') }}</strong></p>
	                                    @endif
	                                        <input type="password" class="form-control" name="password" id="cm-pwd" required="" placeholder="Mot de passe">
	                                </div>
	                                <div class="form-group mb-0">
	                                    <input type="password" class="form-control" name="password_confirmation" required="" placeholder="Confirmer le mot de passe">
	                                </div>
	                                {{--<p class="clearfix text-uppercase mt-2">--}}
	                                {{--<a href="#" class="text-right"><small id="forgotpassword" class="form-text text-dark text-capitalize">"j'ai predu mon mot de passe"</small></a>--}}
	                                {{--</p>--}}
	                            @endif
                            </div>
                            <div class="tab">
                                <h3 class="text-center mb-4">Etape 2</h3>
                                <div class="form-group div_for_description_part_first">
                                    <p>Bienvenue sur la plateforme alumni de votre établissement. Votre compte est désormais activé ! Afin de bénéficier de tous les avantages de la plateforme, il vous suffit de remplir ce court questionnaire et votre profil sera complété en un clin d’oeil.</p>
                                    <p>Cela ne vous prendra pas plus de 5 minutes. Promis, juré, craché.</p>
                                </div>
                                <div class="div_for_first_question">
                                    <div class="form-group">
                                        <h5 class="text-info">Quel est votre statut ?</h5>
                                    </div>
                                    <div class="form-group">
                                        <label for="student">Etudiant</label>
                                        <input value="student" data-type ='1' type="radio" name="status_of_user" class="first_quest" id="student">
                                    </div>
                                    <div class="form-group">
                                        <label for="Diploma">Diplômé</label>
                                        <input value="diplom" data-type ='2' type="radio" name="status_of_user" class="first_quest" id="Diploma">
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher_or_administrative_team">Equipe enseignante ou administrative</label>
                                        <input value="teacher or administrative" data-type ='3' type="radio" name="status_of_user" class="first_quest" id="teacher_or_administrative_team">
                                    </div>
                                </div>
                                <div class="div_for_survey_1">
                                    <div class="question_2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Tu es en ce moment étudiant au sein de {{ ucfirst($schoolName) }}, quel cursus suis-tu ?</h5>
                                        </div>
                                        <div class="form-group div_for_multiple">
                                            <select class="form-control multiple" id="degree_of_curriculum" name="degree_of_curriculum">
                                                <option value="" checked>Degree</option>
                                                @foreach(App\DegreeOfTheSchool::where('school_id',$schoolInfo->id)->get() as $degree)
                                                    <option value="{{$degree->degree->name}}"> {{$degree->degree->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_3 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quelle sera ton année de diplômation ?</h5>
                                        </div>
                                        <div class="form-group div_for_multiple">
                                            <select class="form-control multiple" id="curriculum_graduation_year" name="curriculum_graduation_year">
                                                <option value="" checked>Year Of Graduation</option>
                                                @foreach(App\GraduationYear::all() as $graduation_year)
                                                    <option value="{{$graduation_year->year}}"> {{$graduation_year->year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if($complete_user)
                                    <div class="class_for_display_none">
                                        <input type="hidden" id="complete_first_name" value="{{$complete_user->first_name}}">
                                        <input type="hidden" id="complete_last_name" value="{{$complete_user->last_name}}">
                                        <input type="hidden" id="complete_type" value="{{ ($complete_user->chooseColor)?$complete_user->chooseColor->category->id:''}}">
                                        <input type="hidden" id="complete_year" value="{{ ($complete_user->GetGraduationYear)?$complete_user->GetGraduationYear->year:'' }}">
                                    </div>
                                    @endif
                                    <div class="question_4 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Que faisais-tu avant ?</h5>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                <label for="high_school">Lycée</label>
                                                <input value="High School"  data-type="1" type="radio" id="high_school" name="what_you_are_doing_for">
                                            </p>
                                            <p>
                                                <label for="other_training">Autre formation </label>
                                                <input value="Other training"  data-type="2" type="radio" id="other_training" name="what_you_are_doing_for">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_5 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Dans quelle ville as-tu été au lycée ?</h5>
                                            <input type="text" class="form-control" id="which_shool_you_go_to_school" name="which_shool_you_go_to_school">
                                        </div>
                                    </div>
                                    <div class="question_6 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quel était le nom de ton lycée ?</h5>
                                            <select class="form-control multiple" id="name_of_the_high_school" name="name_of_the_high_school">
                                                <option value="" checked>High Schools</option>
                                                @foreach(App\HighSchool::all() as $high_school)
                                                    <option value="{{$high_school->official_name}}"> {{$high_school->official_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_7 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quelle filière as-tu suivi ?</h5>
                                            <select class="form-control multiple" id="foloowed_sector" name="foloowed_sector">
                                                <option value="" checked>Sector</option>
                                                @foreach(App\Sector::all() as $sector)
                                                    <option value="{{$sector->name}}"> {{$sector->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_8 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">As-tu obtenu ton baccalauréat ?</h5>
                                            <p>
                                                <label for="have_you_graduate_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="have_you_graduate_yes" name="have_you_graduated">
                                            </p>
                                            <p>
                                                <label for="have_you_graduate_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="have_you_graduate_no" name="have_you_graduated">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_9 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Avant d’intégrer cette formation, tu a suivi une autre formation de l’enseignement supérieur, quel type de diplôme préparais-tu ?</h5>
                                            <select class="form-control multiple" id="before_entering_old_degree" name="before_entering_old_degree">
                                                <option value="" checked>Types</option>
                                                @foreach(App\DegreeOfTheRegsiterSurvey::all() as $DegreeOfTheRegsiterSurvey)
                                                    <option value="{{$DegreeOfTheRegsiterSurvey->name}}"> {{$DegreeOfTheRegsiterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_10 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quel établissement as-tu réalisé cette formation ?</h5>
                                            <select class="form-control multiple" id="which_institution_you_done_this_training" name="which_institution_you_done_this_training">
                                                <option value="" checked>Schools</option>
                                                @foreach(App\SchoolsOfRegsiterSurvey::all() as $SchoolsOfRegisterSurvey)
                                                    <option value="{{$SchoolsOfRegisterSurvey->name}}"> {{$SchoolsOfRegisterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_11 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quel cursus suivais-tu ?</h5>
                                            <input class="form-control" id="curriculum_followed" name="curriculum_followed">
                                        </div>
                                    </div>
                                    <div class="question_12 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Es-tu sorti diplômé.e de cette formation ?</h5>
                                            <p>
                                                <label for="did_you_graduate_this_training_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="did_you_graduate_this_training_yes" name="did_you_graduate_this_training">
                                            </p>
                                            <p>
                                                <label for="did_you_graduate_this_training_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="did_you_graduate_this_training_no" name="did_you_graduate_this_training">
                                            </p>
                                        </div>
                                    </div>

                                    <div class="question_afterwards class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Que penses-tu faire par la suite ? </h5>
                                            <p>
                                                <label for="look_for_a_job">Chercher un travail</label>
                                                <input value="Look for a job"  data-type="1" type="radio" id="look_for_a_job" name="what_you_think_afterwards">
                                            </p>
                                            <p>
                                                <label for="achieve_a_gap_year">Réaliser une année de césure</label>
                                                <input value="Achieve A Gap Year"  data-type="2" type="radio" id="achieve_a_gap_year" name="what_you_think_afterwards">
                                            </p>
                                            <p>
                                                <label for="follow_another_training">Suivre une autre formation</label>
                                                <input value="Follow Another Training"  data-type="3" type="radio" id="follow_another_training" name="what_you_think_afterwards">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_afterwards_third class_for_display_none">
                                        <div class="form-group">
                                            <p>
                                                <label for="training_in_my_field">Une formation dans mon domaine</label>
                                                <input value="Training in my field"  data-type="1" type="radio" id="training_in_my_field" name="training_or_reorientation">
                                            </p>
                                            <p>
                                                <label for="considering_reorient">J'envisage une réorientation</label>
                                                <input value="I am considering a reorientation"  data-type="2" type="radio" id="considering_reorient" name="training_or_reorientation">
                                            </p>

                                        </div>
                                    </div>
                                    <div class="question_currently_intership class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Es-tu actuellement à la recherche d'un stage ou d'une alternance ?</h5>
                                            <p>
                                                <label for="i_am_looking_for_an_intership">Je cherche un stage</label>
                                                <input value="I am looking for an internship"  data-type="1" type="radio" id="i_am_looking_for_an_intership" name="looking_currently_intership">
                                            </p>
                                            <p>
                                                <label for="i_am_looking_for_alternation">Je cherche une alternance</label>
                                                <input value="I am looking for an alternation"  data-type="2" type="radio" id="i_am_looking_for_alternation" name="looking_currently_intership">
                                            </p>
                                            <p>
                                                <label for="i_am_not_looking_for_anything">Je ne recherche rien pour le moment</label>
                                                <input value="I'm not looking for anything yet"  data-type="3" type="radio" id="i_am_not_looking_for_anything" name="looking_currently_intership">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_place_part class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info text-center">Ta place au sein du réseau</h5>
                                        </div>
                                    </div>
                                    <div class="question_find_mentor_graduate_course_accompany class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Souhaite-tu trouver un mentor, diplômé de ton cursus, afin de t’accompagner dans tes choix académiques et professionnels ?</h5>
                                            <p>
                                                <label for="mentor_graduate_accompany_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="mentor_graduate_accompany_yes" name="question_find_mentor_graduate_course_accompany">
                                            </p>
                                            <p>
                                                <label for="mentor_graduate_accompany_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="mentor_graduate_accompany_no" name="question_find_mentor_graduate_course_accompany">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_you_agree_sponsor_student_of_the_year class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Serais-tu d’accord de parrainer un étudiant d’une année inférieure de la tienne pour cette année ?</h5>
                                            <p>
                                                <label for="question_you_agree_sponsor_student_of_the_year_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="question_you_agree_sponsor_student_of_the_year_yes" name="question_you_agree_sponsor_student_of_the_year">
                                            </p>
                                            <p>
                                                <label for="question_you_agree_sponsor_student_of_the_year_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="question_you_agree_sponsor_student_of_the_year_no" name="question_you_agree_sponsor_student_of_the_year">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_you_accept_your_profile_public_recruiters class_for_display_none">
                                        <div class="form-group">
                                            <h4 class="text-info">Votre place au sein du réseau</h4>
                                            <h5 class="text-info">Acceptes-tu que ton profil soit rendu public aux recruteurs ?</h5>
                                            <p>
                                                <label for="question_you_accept_your_profile_public_recruiters_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="question_you_accept_your_profile_public_recruiters_yes" name="question_you_accept_your_profile_public_recruiters">
                                            </p>
                                            <p>
                                                <label for="question_you_accept_your_profile_public_recruiters_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="question_you_accept_your_profile_public_recruiters_no" name="question_you_accept_your_profile_public_recruiters">
                                            </p>
                                        </div>
                                    </div>



                                    <div class="question_4_v1_q1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Dans quelle ville as-tu été au lycée ?</h5>
                                        </div>

                                    </div>


                                </div>
                                <div class="div_for_survey_2">
                                    <div class="question_2 class_for_display_none">
                                        <div class="form-group">
                                            <label for="end_school_on_last_year">Vous avez été diplômé l’an passé</label>
                                            <input value="end_school_on_last_year" data-type="1" type="radio" id="end_school_on_last_year" name="when_end_school">
                                            <label for="end_school_years_ago">Vous avez été diplômé il y a plus longtemps</label>
                                            <input value="end_school_years_ago" data-type="2" type="radio" id="end_school_years_ago" name="when_end_school">
                                        </div>
                                    </div>
                                    <div class="question_3_v1_q1 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Bienvenue <span class="span_for_full_name"> </span>, vous êtes un ancien étudiant de (L'ÉCOLE), en quelle année avez-vous été diplômé ?</h5>
                                            <select class="form-control multiple" id="year_of_graduate" name="year_of_graduate">
                                                <option value="" checked>Sélectionner l'année</option>
                                                @foreach(App\GraduationYear::all() as $graduation_year)
                                                    <option value="{{$graduation_year->year}}"> {{$graduation_year->year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="quest_for_upodate class_for_display_none div_for_multiple">
                                        <div class="form-group">
                                            <h5 class="text-info">Bienvenue <span class="span_for_full_name"> </span>, tu es un ancien étudiant de (L'ÉCOLE), quand as-tu été diplômé ?</h5>
                                            <select class="form-control multiple" id="year_did_of_graduate" name="year_did_of_graduate">
                                                <option value="" checked>Sélectionner l'année</option>
                                                @foreach(App\GraduationYear::all() as $graduation_year)
                                                    <option value="{{$graduation_year->year}}"> {{$graduation_year->year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_4_v1_q2 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quel cursus suivais-tu ?</h5>
                                            <select class="form-control multiple" id="followed_curriculum" name="followed_curriculum">
                                                <option value="" checked>Degree</option>
                                                @foreach(App\DegreeOfTheSchool::where('school_id',$schoolInfo->id)->get() as $degree)
                                                    <option value="{{$degree->degree->name}}"> {{$degree->degree->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_5_v1_q3 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quelle est ta situation actuelle ?</h5>
                                            <p>
                                                <label for="i_am_student">Je suis toujours étudiant</label>
                                                <input value="I am still a student"  data-type="1" type="radio" id="i_am_student" name="current_situation">
                                            </p>
                                            <p>
                                                <label for="in_post">Je suis en poste</label>
                                                <input value="I am in post"  data-type="2" type="radio" id="in_post" name="current_situation">
                                            </p>
                                            <p>
                                                <label for="looking_a_job">Je suis à la recherche d’un emploi</label>
                                                <input value="I'm looking for a job"  data-type="3" type="radio" id="looking_a_job" name="current_situation">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="quest_nature_contract class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quelle est la nature de votre contrat ?</h5>
                                            <select class="form-control multiple" id="nature_of_contract" name="nature_of_contract">
                                                <option value="" checked>Types</option>
                                                @foreach(App\Contract::all() as $contract)
                                                    <option value="{{$contract->name}}"> {{$contract->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="which_company_this class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quelle entreprise était-ce ?</h5>
                                            <select class="form-control multiple" id="which_company_this" name="which_company_this">
                                                <option value="" checked>Company</option>
                                                @foreach(App\Company::all() as $Company)
                                                    <option value="{{$Company->name}}"> {{$Company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="what_area_this_job class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quel domaine était cet emploi ?</h5>
                                            <select class="form-control multiple" id="what_area_this_job" name="what_area_this_job">
                                                <option value="" checked>Company</option>
                                                @foreach(App\Area::all() as $area)
                                                    <option value="{{$area->name}}"> {{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="what_socio_professional_category_this_job class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">De quelle catégorie socio-professionnelle relevait cet emploi ?</h5>
                                            <select class="form-control multiple" id="what_socio_professional_category_this_job" name="what_socio_professional_category_this_job">
                                                <option value="" checked>Category</option>
                                                @foreach(App\SocioProfessionalCategory::all() as $SocioProfessionalCategory)
                                                    <option value="{{$SocioProfessionalCategory->name}}"> {{$SocioProfessionalCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="what_title_of_your_post class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">De quelle catégorie socio-professionnelle relevait cet emploi ?</h5>
                                            <select class='form-control multiple' id="what_title_of_your_post" name="what_title_of_your_post">
                                                @foreach(App\TradesOfTheRegsiterSurvey::all() as $TradesOfTheRegsiterSurvey)
                                                    <option value="{{$TradesOfTheRegsiterSurvey->name}}"> {{$TradesOfTheRegsiterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="full_time_or_part_time_job class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Etait-ce un emploi à temps plein ou temps partiel ?</h5>
                                            <p>
                                                <label for="full_time">Temps plein</label>
                                                <input value="Full Time"  data-type="1" type="radio" id="full_time" name="full_time_or_part_time_job">
                                            </p>
                                            <p>
                                                <label for="part_time">Temps partiel</label>
                                                <input value="Part Time"  data-type="2" type="radio" id="part_time" name="full_time_or_part_time_job">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="still_hold_this_job class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Occupez-vous toujours cet emploi ?</h5>
                                            <p>
                                                <label for="still_hold_this_job_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="still_hold_this_job_yes" name="still_hold_this_job">
                                            </p>
                                            <p>
                                                <label for="still_hold_this_job_no">Non, j’ai eu une ou plusieurs autres expériences par la suite</label>
                                                <input value="No, I had one or more other experiences afterwards"  data-type="2" type="radio" id="still_hold_this_job_no" name="still_hold_this_job">
                                            </p>
                                        </div>
                                    </div>


                                    <div class="quest_6_v1_q4_v1_q1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">S’agit-il d’une poursuite ou une reprise d’étude ?</h5>
                                            <p>
                                                <label for="this_recovery">Il s’agit d’une reprise</label>
                                                <input value="This is a recovery"  data-type="1" type="radio" id="this_recovery" name="continuation_resumption_of_study">
                                            </p>
                                            <p>
                                                <label for="this_prosecution">Il s’agit d’une poursuite</label>
                                                <input value="This is a prosecution"  data-type="2" type="radio" id="this_prosecution" name="continuation_resumption_of_study">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="quest_7_v1_q5_v1_q2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quand souhaiterais-tu débuter ton stage ?</h5>
                                            <input type="date" class="form-control" name="when_you_start_your_intership" id="when_you_start_your_intership">
                                        </div>
                                    </div>
                                    <div class="open_lets_flashback class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">C’est parti pour un petit flashback</h5>
                                            <h6 class="text-info">Sur cette partie, nous allons vous poser quelques questions concernant l'année qui a suivi votre diplomation au sein de {{ ucfirst($schoolName) }}. Ces données sont importantes d'un point de vue statistique afin d'évaluer l'insertion professionnelle des étudiants de l'établissement.</h6>
                                        </div>
                                    </div>
                                    <div class="open_lets_flashback_after_this_training class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Qu’avez-vous fait l’année qui a suivi cette formation ?</h5>
                                            <p>
                                                <label for="i_did_another_training">J’ai réalisé une autre formation</label>
                                                <input value="I did another training"  data-type="1" type="radio" id="i_did_another_training" name="after_this_training">
                                            </p>
                                            <p>
                                                <label for="i_went_on_a_trip">Je suis parti·e en voyage</label>
                                                <input value="I went on a trip"  data-type="2" type="radio" id="i_went_on_a_trip" name="after_this_training">
                                            </p>
                                            <p>
                                                <label for="i_found_job">J’ai trouvé un emploi</label>
                                                <input value="I fount job"  data-type="3" type="radio" id="i_found_job" name="after_this_training">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="open_lets_flashback_time_to_first_job class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Combien de temps avez-vous mis pour trouver ce premier emploi ?</h5>
                                            <select name="time_to_first_find_job" id="time_to_first_find_job" class='form-control multiple w-100' >
                                                <option value="" checked >Times</option>
                                                <option value="0-3 mois">0-2 ans</option>
                                                <option value="3-6 mois">3-6 mois</option>
                                                <option value="6-9 mois">6-9 mois</option>
                                                <option value="9-12 mois">9-12 mois</option>
                                                <option value="+12 moisns">+12 mois</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="open_lets_flashback_job_part_for_training class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Cet emploi relevait-il du domaine de votre formation ?</h5>
                                            <p>
                                                <label for="job_part_for_training_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="job_part_for_training_yes" name="job_part_for_training">
                                            </p>
                                            <p>
                                                <label for="job_part_for_training_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="job_part_for_training_no" name="job_part_for_training">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="open_lets_flashback_how_did_you_find_this_job class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Par quel moyen avez-vous trouvé cet emploi ?</h5>
                                            <p>
                                                <label for="following_my_internship_or_my_alerternation">Suite à mon stage ou mon alternance</label>
                                                <input value="following_my_internship_or_my_alerternation"  data-type="1" type="radio" id="following_my_internship_or_my_alerternation" name="how_did_you_find_this_job">
                                            </p>
                                            <p>
                                                <label for="reply_on_application">Réponse à une candidature</label>
                                                <input value="reply_on_application"  data-type="1" type="radio" id="reply_on_application" name="how_did_you_find_this_job">
                                            </p>
                                            <p>
                                                <label for="network">Réseau</label>
                                                <input value="network"  data-type="1" type="radio" id="network" name="how_did_you_find_this_job">
                                            </p>
                                            <p>
                                                <label for="spontaneous_application">Candidature spontanée</label>
                                                <input value="spontaneous_application"  data-type="1" type="radio" id="spontaneous_application" name="how_did_you_find_this_job">
                                            </p>
                                            <p>
                                                <label for="i_was_approached_by_hunter">J’ai été démarché·e par un chasseur de tête</label>
                                                <input value="i_was_approached_by_hunter"  data-type="1" type="radio" id="i_was_approached_by_hunter" name="how_did_you_find_this_job">
                                            </p>
                                        </div>
                                    </div>


                                    <div class="open_lets_flashback_which_institution_make_this_additional_training class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quel établissement avez-vous réalisé cette formation additionnelle ?</h5>
                                            <select class="form-control multiple" id="which_institution__did_you_make_additional_training" name="which_institution__did_you_make_additional_training">
                                                <option value="" checked>Schools</option>
                                                @foreach(App\SchoolsOfRegsiterSurvey::all() as $SchoolsOfRegisterSurvey)
                                                    <option value="{{$SchoolsOfRegisterSurvey->name}}"> {{$SchoolsOfRegisterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="open_lets_flashback_what_title_of_diploma class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quel était l’intitulé de ce diplôme ?</h5>
                                            <input type="text" class="form-control" name="what_title_of_diploma" id="what_title_of_diploma">
                                        </div>
                                    </div>

                                    <div class="question_6_v3_q4 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">S’agit-il de votre premier emploi ?</h5>
                                            <p>
                                                <label for="your_first_job_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="your_first_job_yes" name="your_first_job">
                                            </p>
                                            <p>
                                                <label for="your_first_job_yes_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="your_first_job_yes_no" name="your_first_job">
                                            </p>
                                        </div>
                                    </div>

                                    <div class="question_7_v3_q5 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quel domaine souhaitez-vous trouver un emploi ?</h5>
                                            <select class="form-control multiple" id="which_area_find_job" name="which_area_find_job">
                                                <option value="" checked>Types</option>
                                                @foreach(App\Area::all() as $area)
                                                    <option value="{{$area->name}}"> {{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_8_v3_q6 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quelle fonction recherchez-vous ?</h5>
                                            <select class='form-control multiple w-100' id="what_function_are_you_looking_for" multiple="multiple" name="what_function_are_you_looking_for[]">
                                                @foreach(App\TradesOfTheRegsiterSurvey::all() as $TradesOfTheRegsiterSurvey)
                                                    <option value="{{$TradesOfTheRegsiterSurvey->name}}"> {{$TradesOfTheRegsiterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_9_v3_q7 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quelle est la fourchette de salaire souhaitée ?</h5>
                                            <h6 class="text-info">Cette information est confidentielle et nous sert à vous orienter des offres adaptées à votre profil</h6>
                                            <select name="desired_salary_range" id="desired_salary_range" class='form-control multiple w-100' >
                                                <option value="" checked >Salary Range</option>
                                                @foreach(App\Salary::all() as $Salary)
                                                    <option value="{{$Salary->name}}"> {{$Salary->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="question_6_v2_q4 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quelle entreprise travaillez-vous ?</h5>
                                            <select class="form-control multiple" id="which_company_you_work" name="which_company_you_work">
                                                <option value="" checked>Company</option>
                                                @foreach(App\Company::all() as $Company)
                                                    <option value="{{$Company->name}}"> {{$Company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_7_v2_q5 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Dans quelle ville travaillez-vous ?</h5>
                                            Dans quel cursus enseignez-vous ?                      <input class="form-control" id="which_city_worked">
                                        </div>
                                    </div>
                                    <div class="question_8_v2_q6 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quel domaine travaillez-vous ?</h5>
                                            <select class="form-control multiple" id="which_field_work" name="which_field_work">
                                                <option value="" checked>Types</option>
                                                @foreach(App\Area::all() as $area)
                                                    <option value="{{$area->id}}"> {{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_9_v2_q7 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quelle fonction occupez-vous ?</h5>
                                            <select class="form-control multiple" id="what_function_copy" name="what_function_copy">
                                                <option value="" checked>Types</option>
                                                @foreach(App\TradesOfTheRegsiterSurvey::all() as $TradesOfTheRegsiterSurvey)
                                                    <option value="{{$TradesOfTheRegsiterSurvey->name}}"> {{$TradesOfTheRegsiterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_10_v2_q8 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quand avez-vous débuté cet emploi ? </h5>
                                            <input type="date" class="form-control" name="when_you_start_this_job" id="when_you_start_this_job">
                                        </div>
                                    </div>

                                    <div class="question_11_v2_q9 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">S’agit-il de votre première expérience professionnelle ?</h5>
                                            <p>
                                                <label for="first_professional_experience_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="first_professional_experience_yes" name="first_professional_experience">
                                            </p>
                                            <p>
                                                <label for="first_professional_experience_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="first_professional_experience_no" name="first_professional_experience">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_12_v2_q10 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quel est votre niveau d’expérience professionnelle ?</h5>
                                            <select name="level_of_experience" id="level_of_experience" class='form-control multiple w-100' >
                                                <option value="" checked >Levels</option>
                                                <option value="0-2 ans">0-2 ans</option>
                                                <option value="2-4 ans">2-4 ans</option>
                                                <option value="4-6 ans">4-6 ans</option>
                                                <option value="6-10 ans">6-10 ans</option>
                                                <option value="+10 ans">+10 ans</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_13_v2_q11 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quelle est votre tranche de salaire (salaire brut annuel) Cette information est confidentielle et nous sert à vous orienter des offres adaptées à votre profil ?</h5>
                                            <select name="salary_bracket" id="salary_bracket" class='form-control multiple w-100' >
                                                <option value="" checked >Brackets</option>
                                                @foreach(App\Salary::all() as $Salary)
                                                    <option value="{{$Salary->id}}"> {{$Salary->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="question_6_v1_q4_v1_q1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Dans quelle ville réalisez-vous cette formation ?</h5>
                                            <input class="form-control" name="which_city_training" id="which_city_training" >
                                        </div>
                                    </div>
                                    <div class="question_7_v1_q5_v1_q2 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quel établissement suivez-vous cette formation ?</h5>
                                            <select class="form-control multiple" id="which_institution_follow" name="which_institution_follow">
                                                <option value="" checked>Schools</option>
                                                @foreach(App\SchoolsOfRegsiterSurvey::all() as $SchoolsOfRegisterSurvey)
                                                    <option value="{{$SchoolsOfRegisterSurvey->name}}"> {{$SchoolsOfRegisterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_8_v1_q6_v1_q3 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Quel type de diplôme préparez-vous ?</h5>
                                            <select class="form-control multiple" id="kind_of_diploma" name="kind_of_diploma">
                                                <option value="" checked>Types</option>
                                                @foreach(App\DegreeOfTheRegsiterSurvey::all() as $DegreeOfTheRegsiterSurvey)
                                                    <option value="{{$DegreeOfTheRegsiterSurvey->name}}"> {{$DegreeOfTheRegsiterSurvey->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_9_v1_q7_v1_q4 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Recherchez-vous un stage ou une alternance ?</h5>
                                            <p>
                                                <label for="i_am_looking_intership">Je recherche un stage</label>
                                                <input value="I am looking for an intership"  data-type="1" type="radio" id="i_am_looking_intership" name="look_intership_or_alternation">
                                            </p>
                                            <p>
                                                <label for="in_looking_alternation">Je recherche une alternance</label>
                                                <input value="I am looking for an alternation"  data-type="2" type="radio" id="in_looking_alternation" name="look_intership_or_alternation">
                                            </p>
                                            <p>
                                                <label for="i_have_everything">J’ai tout ce qu’il me faut je vous remercie</label>
                                                <input value="I have everything I need thank you"  data-type="3" type="radio" id="i_have_everything" name="look_intership_or_alternation">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_10_v1_q8_v1_q5_v1_q1 class_for_display_none">
                                        <div class="form-group div_for_multiple">
                                            <h5 class="text-info">Dans quel domaine souhaites-tu trouver un stage ?</h5>
                                            <select class="form-control multiple" id="field_for_intership" name="field_for_intership">
                                                <option value="" checked>Types</option>
                                                @foreach(App\Area::all() as $area)
                                                    <option value="{{$area->name}}"> {{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="question_11_v1_q9_v1_q6_v1_q2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quand souhaiterais-tu démarrer ton stage ?</h5>
                                            <input type="date" name="date_of_start_intership" id="date_of_start_intership">
                                        </div>
                                    </div>
                                    <div class="question_12_v1_q10_v1_q7_v1_q3 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quelle serait la durée de ton stage ? (Tu peux sélectionner plusieurs durées si celles-ci ne sont pas fixes)</h5>
                                            <select name="duration_of_membership[]" id="duration_of_membership" class='form-control multiple w-100' multiple="multiple" >
                                                <option value="" checked >Durations</option>
                                                <option value="1 Mois">1 Mois</option>
                                                <option value="2 Mois">2 Mois</option>
                                                <option value="3 Mois">3 Mois</option>
                                                <option value="4 Mois">4 Mois</option>
                                                <option value="5 Mois">5 Mois</option>
                                                <option value="6 Mois">6 Mois</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="question_10_v1_q8_v2_q5 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quand souhaiterais-tu démarrer ton alternance ?</h5>
                                            <input type="date" name="date_of_start_alternation" id="date_of_start_alternation">
                                        </div>
                                    </div>

                                    <div class="question_11_v1_q9_v2_q6 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quelle serait la durée de ton alternance ?</h5>
                                            <select name="duration_of_alternation" id="duration_of_alternation" class='form-control w-100' >
                                                <option value="" checked >Durations</option>
                                                <option value="1 an">1 an</option>
                                                <option value="18 mois">18 mois</option>
                                                <option value="2 ans">2 ans</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="lets_fo_for_a_little_flashback class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">C’est parti pour un petit flashback</h5>
                                            <h6>Description : Sur cette partie, nous allons vous poser quelques questions concernant l'année qui a suivi votre diplomation au sein de ECOLE. Ces données sont importantes d'un point de vue statistique afin d'évaluer l'insertion professionnelle des étudiants de l'établissement.</h6>
                                        </div>
                                    </div>
                                    <div class="lets_question_1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Sur une échelle de 1 à 10, comment évaluez-vous la qualité des enseignements reçus au sein de {{ ucfirst($schoolName) }} ?</h5>
                                            <select name="quality_of_lessons" id="quality_of_lessons" class='form-control w-100' >
                                                <option value="" checked >Qualité</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="lets_question_2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Que vous manquait-il pour atteindre le 10 ?</h5>
                                            <input type="text" class="form-control" name="miss_the_ten_quality" id="miss_the_ten_quality">
                                        </div>
                                    </div>
                                    <div class="lets_question_3 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Comment évaluez-vous votre satisfaction globale de la formation ?</h5>
                                            <select name="your_rate_overall_satisfaction_training" id="your_rate_overall_satisfaction_training" class='form-control w-100' >
                                                <option value="" checked >Rate</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="lets_question_4 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Que vous manquait-il pour atteindre le 10 ?</h5>
                                            <input type="text" class="form-control" name="miss_the_ten_overall" id="miss_the_ten_overall">
                                        </div>
                                    </div>
{{--                                    <div class="lets_question_place_network class_for_display_none">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <h5 class="text-info">Votre place au sein du réseau</h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="lets_question_5 class_for_display_none">
                                        <div class="form-group">
                                            <h4 class="text-info">Votre place au sein du réseau</h4>
                                            <h5 class="text-info">Acceptez-vous que votre profil soit visible des recruteurs ?</h5>
                                            <p>
                                                <label for="visible_profile_recruiters_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="visible_profile_recruiters_yes" name="visible_profile_recruiters">
                                            </p>
                                            <p>
                                                <label for="visible_profile_recruiters_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="visible_profile_recruiters_no" name="visible_profile_recruiters">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="lets_question_6 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Souhaitez-vous recevoir une notification hebdomadaire des dernières offres d'emploi postées par votre réseau ?</h5>
                                            <p>
                                                <label for="weekly_notification_latest_job_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="weekly_notification_latest_job_yes" name="weekly_notification_latest_job">
                                            </p>
                                            <p>
                                                <label for="weekly_notification_latest_job_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="weekly_notification_latest_job_no" name="weekly_notification_latest_job">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="lets_question_7 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Seriez-vous intéressé.e pour intervenir au sein du diplôme ?</h5>
                                            <p>
                                                <label for="yes_talk_about_my_career">Oui, pour parler de mon parcours</label>
                                                <input class="float-right" style="width:auto" value="Yes, to talk about my career"  data-type="1" type="checkbox" id="yes_talk_about_my_career" name="interested_to_diploma">
                                            </p>
                                            <p>
                                                <label for="yes_give_lesson">Oui, pour donner un cours</label>
                                                <input class="float-right" style="width:auto" value="Yes, to give a lesson"  data-type="2" type="checkbox" id="yes_give_lesson" name="interested_to_diploma">
                                            </p>
                                            <p>
                                                <label for="not_interested_diploma">Non</label>
                                                <input class="float-right" style="width:auto" value="no"  data-type="3" type="checkbox" id="not_interested_diploma" name="interested_to_diploma">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="lets_question_8 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Acceptez-vous de prendre sous votre aile un étudiant au titre de mentor ?</h5>
                                            <p>
                                                <label for="student_mentor_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="student_mentor_yes" name="student_mentor">
                                            </p>
                                            <p>
                                                <label for="student_mentor_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="student_mentor_no" name="student_mentor">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="lets_question_9 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info"> Souhaitez-vous laisser adresser un message à votre ancienne école ?</h5>
                                            <input type="text" class="form-control" name="leave_message_old_school" id="leave_message_old_school">
                                        </div>
                                    </div>

                                </div>
                                <div class="div_for_survey_3">
                                    <div class="question_2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Faites-vous partie de l’équipe enseignante ou administrative ?</h5>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                <label for="teacher">Enseignante</label>
                                                <input value="teacher"  data-type="1" type="radio" id="teacher" name="role">
                                            </p>
                                            <p>
                                                <label for="administrativ">Administrative</label>
                                                <input value="administrativ"  data-type="2" type="radio" id="administrativ" name="role">
                                            </p>
                                            <p>
                                                <label for="both">Les deux</label>
                                                <input value="both"  data-type="3" type="radio" id="both" name="role">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_4_v1_q2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Exercez-vous une autre activité ?</h5>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                <label for="other_activity_yes">Oui</label>
                                                <input value="yes"  data-type="1" type="radio" id="other_activity_yes" name="other_activity">
                                            </p>
                                            <p>
                                                <label for="other_activity_no">Non</label>
                                                <input value="no"  data-type="2" type="radio" id="other_activity_no" name="other_activity">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="question_5_v1_q3_v1_q1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Indiquer l’intitulé de votre poste</h5>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="title_of_position" >
                                        </div>
                                    </div>
                                    <div class="question_6_v1_q4_v1_q2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Indiquer le nom de la structure dans laquelle vous travaillez</h5>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="name_of_work" >
                                        </div>
                                    </div>
                                    <div class="question_8_v1_p1 class_for_display_none">
                                        <p>
                                            <label for="diploma1">Intitulé diplômé 1</label>
                                            <input value="diplom 1"  data-type="1" type="radio" id="diploma1" name="diplom_number">
                                        </p>
                                        <p>
                                            <label for="diploma2">Intitulé diplômé 2</label>
                                            <input value="diplom 2"  data-type="2" type="radio" id="diploma2" name="diplom_number">
                                        </p>
                                        <p>
                                            <label for="diploma3">Intitulé diplômé 3</label>
                                            <input value="diplom 3"  data-type="3" type="radio" id="diploma3" name="diplom_number">
                                        </p>
                                    </div>
                                    <div class="question_3_v2_q1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Quel est l’intitulé de votre poste ?
                                            </h5>
                                            <input class="form-control" name="title_of_the_post">
                                        </div>
                                    </div>
                                    <div class="question_3_v3_q1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Dans quel cursus enseignez-vous ?
                                            </h5>
                                            <div class="form-group div_for_multiple">
                                                <select class="form-control multiple" id="choose_degree" name="degree">
                                                    <option value="" checked>Degree</option>
                                                    @foreach(App\Degree::all() as $degree)
                                                        <option value="{{$degree->name}}"> {{$degree->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question_4_v3_q2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Vous travaillez également au sein de l’administration de l’école, quel est l’intitulé de votre poste ?
                                            </h5>
                                            <div class="form-group">
                                                <input type="'text" class="form-control" name="admin_of_the_school_title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question_5_v3_q3 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Décrivez brièvement vos missions</h5>
                                            <div class="form-group">
                                                <input type="'text" name="describe_mission">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question_6_v3_q4 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Souhaitez-vous renseigner votre parcours académique ?
                                            </h5>
                                            <div class="form-group">
                                                <p>
                                                    <label for="know_academic_background_yes">Oui</label>
                                                    <input value="yes"  data-type="1" type="radio" id="know_academic_background_yes" name="know_about_academic_background">
                                                </p>
                                                <p>
                                                    <label for="know_academic_background_no">Non</label>
                                                    <input value="no"  data-type="2" type="radio" id="know_academic_background_no" name="know_about_academic_background">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="question_7_v3_q5 class_for_display_none">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <p>--}}
{{--                                                <label for="diploma11">Intitulé diplômé 1</label>--}}
{{--                                                <input value="diplom 1"  data-type="1" type="radio" id="diploma11" name="diplom_number">--}}
{{--                                            </p>--}}
{{--                                            <p>--}}
{{--                                                <label for="diploma22">Intitulé diplômé 2</label>--}}
{{--                                                <input value="diplom 2"  data-type="2" type="radio" id="diploma22" name="diplom_number">--}}
{{--                                            </p>--}}
{{--                                            <p>--}}
{{--                                                <label for="diploma33">Intitulé diplômé 3</label>--}}
{{--                                                <input value="diplom 3"  data-type="3" type="radio" id="diploma33" name="diplom_number">--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="question_9_v1_p1_q1 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">Dans quel établissement avez-vous réalisé ce diplômé·e ?</h5>
                                            <div class="form-group div_for_multiple">
                                                <select name="institution" id="institution" class='form-control w-100 ' required="">
                                                    <option value="" checked >Choose Institution</option>
                                                    @foreach(App\Institution::all() as $institution)
                                                        <option >{{$institution->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question_10_v1_p1_q2 class_for_display_none">
                                        <div class="form-group">
                                            <h5 class="text-info">En quelle année avez-vous été diplômé·e ?</h5>
                                            <div class="form-group div_for_multiple">
                                                <select name="graduation_year" id="graduation_year_survey_3" class='form-control w-100 multiple' required="">
                                                    <option value="" >Graduation Years</option>
                                                    @foreach(App\GraduationYear::all() as $graduationyear)
                                                        <option value="{{$graduationyear->year}}">{{$graduationyear->year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="question_from_avatar class_for_display_none">

                                        <div class="form-group">
                                            <p>
                                                <label for="user_avatar">Il ne vous reste plus qu’à ajouter votre photo et votre profil sera complété</label>
                                                <input  type="file" id="user_avatar" class="form-control" name="user_avatar">
                                            </p>

                                        </div>
                                    </div>

                                </div>
                                <div class="div_for_thanks_message text-danger">

                                </div>
                            </div>
                            {{--                            <div class="tab ">--}}
                            {{--                                <h3 class="text-center mb-4">Etape 4</h3>--}}
                            {{--                                <div class="text-center mb-5">--}}
                            {{--                                    <a href="index.html" class="btn btn-theme-x p3 w-100">Aller</a>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div style="overflow:auto;">
                                <div style="float:right;margin-top: 10px;" class="div_for_regForm_btns class_for_display_none">
                                    <button type="button " class="btn btn-theme-x pagination_button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" class="btn btn-theme-x pagination_button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                            <div style="overflow:auto;">
                                <div style="float:right;margin-top: 10px;" class="div_for_survey_next class_for_display_none_old">
                                    <button type="button" class="btn btn-theme-x btn_for_next_question"  onclick="nextPrev(1)">Question suivante</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


</body>
@if(!Session::get('linkdin'))
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvvqgc0KhI8v-1cqDl2lbDpy12TFVKe_U&libraries=places&callback=initAutocomplete"async defer></script>
@endif
<script>
    function initAutocomplete() {
        var input = document.getElementById('city');
        var which_city_training = document.getElementById('which_city_training');
        var which_city_worked = document.getElementById('which_city_worked');
        var which_shool_you_go_to_school = document.getElementById('which_shool_you_go_to_school');
        var opts = {
            types: ['(cities)']
        };
        new google.maps.places.Autocomplete(input, opts);
        new google.maps.places.Autocomplete(which_city_training, opts);
        new google.maps.places.Autocomplete(which_city_worked, opts);
        new google.maps.places.Autocomplete(which_shool_you_go_to_school, opts);

    }
</script>
<script>
    $(document).ready(function() {
        var count_for_question = 1 ;
        var count_for_3_survey = 1 ;
        var count_for_place_part = 0;
        var count_for_middle_question = 0;
        var count_for_lets_place_network = 0;
        var count_for_lets_flashback = 0;
        var for_open_second_last_part = false;
        $(document).on('click',".btn_for_next_question",function(){
            if($("#complete_type").val() != ''){
                switch ($("#complete_type").val()) {
                    case "1":
                        $("input[name='status_of_user'][data-type='1']").attr('checked', true);
                        break;
                    case "2":
                        $("input[name='status_of_user'][data-type='2']").attr('checked', true);
                        if($("#complete_year").val() != ''){
                            if($("#complete_year").val() == "2018" || $("#complete_year").val() == "2019"){

                                $('#end_school_on_last_year').attr('checked', true);
                            }else{
                                $('#end_school_years_ago').attr('checked', true);
                            }
                        }
                        break;
                    case "3":
                         $("input[name='status_of_user'][data-type='3']").attr('checked', true);
                        break;
                    case "4":
                         $("input[name='status_of_user'][data-type='3']").attr('checked', true);
                        break;
                }

            }
            var first_quest = $("input[name='status_of_user']:checked").val();
            var first_quest_type = $("input[name='status_of_user']:checked").data('type');
            if( first_quest ){
                if(count_for_question == 1){
                    count_for_question++ ;
                }
                $(".div_for_first_question").slideUp(0);
            }
            if ( first_quest_type == '1' ) {
                $(".div_for_description_part_first").slideUp(0);
                var for_suite_question = false;
                $(".div_for_survey_"+first_quest_type + " .question_2").slideDown(0);
                if($("#complete_year").val() != ''){
                    var second_quest = true
                }else{

                    var second_quest = $(".div_for_survey_"+first_quest_type + " #degree_of_curriculum" ).val();
                }
                if( second_quest ){
                    $(".div_for_survey_"+first_quest_type + " .question_2").slideUp(0);
                    $(".div_for_survey_"+first_quest_type + " .question_3").slideDown(0);
                    if($("#complete_year").val() != ''){
                        var third_quest = true
                    }else{

                        var third_quest = $(".div_for_survey_"+first_quest_type + " #curriculum_graduation_year" ).val();
                    }
                    if(third_quest){
                        $(".div_for_survey_"+first_quest_type + " .question_3").slideUp(0);
                        $(".div_for_survey_"+first_quest_type + " .question_4").slideDown(0);
                        var four_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='what_you_are_doing_for']:checked" ).data('type');
                        if(four_quest_type == '1' ){
                            $(".div_for_survey_"+first_quest_type + " .question_4").slideUp(0);
                            $(".div_for_survey_"+first_quest_type + " .question_5").slideDown(0);
                            var five_quest = $(".div_for_survey_"+first_quest_type + " #which_shool_you_go_to_school" ).val();
                            if(five_quest){
                                $(".div_for_survey_"+first_quest_type + " .question_5").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_6").slideDown(0);
                                var six_quest = $(".div_for_survey_"+first_quest_type + " #name_of_the_high_school" ).val();
                                if(six_quest){
                                    $(".div_for_survey_"+first_quest_type + " .question_6").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_7").slideDown(0);
                                    var seven_quest = $(".div_for_survey_"+first_quest_type + " #foloowed_sector" ).val();
                                    if(seven_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_7").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_8").slideDown(0);
                                        var ten_quest = $(".div_for_survey_"+first_quest_type + " input[name='have_you_graduated']:checked" ).val();
                                        if(ten_quest) {
                                            $(".div_for_survey_" + first_quest_type + " .question_8").slideUp(0);
                                            for_suite_question = true;
                                        }
                                    }
                                }
                            }
                        }
                    else if(four_quest_type == '2'){
                            var for_suite_question = false;
                            $(".div_for_survey_"+first_quest_type + " .question_4").slideUp(0);
                            $(".div_for_survey_"+first_quest_type + " .question_5").slideDown(0);
                            var five_quest = $(".div_for_survey_"+first_quest_type + " #which_shool_you_go_to_school" ).val();
                            if(five_quest){
                                $(".div_for_survey_"+first_quest_type + " .question_5").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_6").slideDown(0);
                                var six_quest = $(".div_for_survey_"+first_quest_type + " #name_of_the_high_school" ).val();
                                if(six_quest){
                                    $(".div_for_survey_"+first_quest_type + " .question_6").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_7").slideDown(0);
                                    var seven_quest = $(".div_for_survey_"+first_quest_type + " #foloowed_sector" ).val();
                                    if(seven_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_7").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_8").slideDown(0);
                                        var eight_quest = $(".div_for_survey_"+first_quest_type + " input[name='have_you_graduated']:checked" ).val();
                                        if(eight_quest){
                                            $(".div_for_survey_"+first_quest_type + " .question_8").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .question_9").slideDown(0);
                                            var nein_quest = $(".div_for_survey_"+first_quest_type + " #before_entering_old_degree" ).val();
                                            if(nein_quest){
                                                $(".div_for_survey_"+first_quest_type + " .question_9").slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + " .question_10").slideDown(0);
                                                var ten_quest = $(".div_for_survey_"+first_quest_type + " #which_institution_you_done_this_training" ).val();
                                                if(ten_quest){
                                                    $(".div_for_survey_"+first_quest_type + " .question_10").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .question_11").slideDown(0);
                                                    var eleven_quest = $(".div_for_survey_"+first_quest_type + " #curriculum_followed" ).val();
                                                    if(eleven_quest){
                                                        $(".div_for_survey_"+first_quest_type + " .question_11").slideUp(0);
                                                        $(".div_for_survey_"+first_quest_type + " .question_12").slideDown(0);
                                                        var twelfe_quest = $(".div_for_survey_"+first_quest_type + " input[name='did_you_graduate_this_training']:checked" ).val();
                                                        if(twelfe_quest){
                                                            $(".div_for_survey_" + first_quest_type + " .question_12").slideUp(0);
                                                            for_suite_question = true;
                                                        }
                                                    }
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                        }
                    if(for_suite_question){
                        var for_suite_question = false;
                        var for_place_part = false;
                        $(".div_for_survey_" + first_quest_type + " .question_afterwards").slideDown(0);
                        var suite_first = $(".div_for_survey_"+first_quest_type + " input[name='what_you_think_afterwards']:checked" ).val();
                        var suite_first_type = $(".div_for_survey_"+first_quest_type + " input[name='what_you_think_afterwards']:checked" ).data('type');
                        if(suite_first_type == '3'){
                            $(".div_for_survey_" + first_quest_type + " .question_afterwards").slideUp(0);
                            $(".div_for_survey_" + first_quest_type + " .question_afterwards_third").slideDown(0);
                            var suite_first_third = $(".div_for_survey_"+first_quest_type + " input[name='training_or_reorientation']:checked" ).val();
                            if(suite_first_third){
                                for_suite_question = true;
                            }
                        }
                        else if(suite_first_type == '1' || suite_first_type == '2'){
                            $(".div_for_survey_" + first_quest_type + " .question_afterwards").slideUp(0);
                            for_suite_question = true;
                        }
                        if(for_suite_question){
                            $(".div_for_survey_" + first_quest_type + " .question_afterwards_third").slideUp(0);
                            $(".div_for_survey_" + first_quest_type + " .question_currently_intership").slideDown(0);
                            var for_currently_intership = $(".div_for_survey_"+first_quest_type + " input[name='looking_currently_intership']:checked" ).val();
                            var for_currently_intership_type = $(".div_for_survey_"+first_quest_type + " input[name='looking_currently_intership']:checked" ).data('type');
                            if(for_currently_intership_type == '1'){
                                $(".div_for_survey_" + first_quest_type + " .question_currently_intership").slideUp(0);
                                $(".div_for_survey_2" + " .question_10_v1_q8_v1_q5_v1_q1").slideDown(0);
                                var field_for_intership = $(".div_for_survey_2" + " #field_for_intership" ).val();
                                if(field_for_intership){
                                    $(".div_for_survey_2"  + " .question_10_v1_q8_v1_q5_v1_q1").slideUp(0);
                                    $(".div_for_survey_2" + " .question_11_v1_q9_v1_q6_v1_q2").slideDown(0);
                                    var date_of_start_intership = $(".div_for_survey_2" + " #date_of_start_intership" ).val();
                                    if(date_of_start_intership){
                                        $(".div_for_survey_2"  + " .question_11_v1_q9_v1_q6_v1_q2").slideUp(0);
                                        $(".div_for_survey_2" + " .question_12_v1_q10_v1_q7_v1_q3").slideDown(0);
                                        var duration_of_membership = $(".div_for_survey_2" + " #duration_of_membership" ).val();
                                        if(duration_of_membership . length > 0){
                                            for_place_part = true;
                                            $(".div_for_survey_2" + " .question_12_v1_q10_v1_q7_v1_q3").slideUp(0);
                                        }
                                    }
                                }
                            }
                            else if ( for_currently_intership_type == '2'){
                                $(".div_for_survey_" + first_quest_type + " .question_currently_intership").slideUp(0);
                                $(".div_for_survey_2" + " .question_10_v1_q8_v1_q5_v1_q1").slideDown(0);
                                var field_for_intership = $(".div_for_survey_2" + " #field_for_intership" ).val();
                                if(field_for_intership){
                                    $(".div_for_survey_2" + " .question_10_v1_q8_v1_q5_v1_q1").slideUp(0);
                                    $(".div_for_survey_2" + " .question_10_v1_q8_v2_q5").slideDown(0);
                                    var date_of_start_alternation = $(".div_for_survey_2" + " #date_of_start_alternation" ).val();
                                    if(date_of_start_alternation){
                                        $(".div_for_survey_2" + " .question_10_v1_q8_v2_q5").slideUp(0);
                                        $(".div_for_survey_2" + " .question_11_v1_q9_v2_q6").slideDown(0);
                                        var date_of_start_alternation = $(".div_for_survey_2" + " #duration_of_alternation" ).val();
                                        if(date_of_start_alternation){
                                            for_place_part = true;
                                            $(".div_for_survey_2" + " .question_11_v1_q9_v2_q6").slideUp(0);
                                        }
                                    }
                                }
                            }
                            else if ( for_currently_intership_type == '3') {
                                for_place_part = true;
                            }
                            if(for_place_part){
                                count_for_place_part ++;
                                $(".div_for_survey_" + first_quest_type + " .question_currently_intership").slideUp(0);
                                $(".div_for_survey_" + first_quest_type + " .question_place_part").slideDown(0);
                                $(".div_for_survey_" + first_quest_type + " .question_find_mentor_graduate_course_accompany").slideDown(0);
                                var question_find_mentor_graduate_course_accompany = $(".div_for_survey_"+first_quest_type + " input[name='question_find_mentor_graduate_course_accompany']:checked" ).val();
                                if(question_find_mentor_graduate_course_accompany){
                                    $(".div_for_survey_" + first_quest_type + " .question_place_part").slideUp(0);
                                    $(".div_for_survey_" + first_quest_type + " .question_find_mentor_graduate_course_accompany").slideUp(0);
                                    $(".div_for_survey_" + first_quest_type + " .question_you_agree_sponsor_student_of_the_year").slideDown(0);
                                    var question_you_agree_sponsor_student_of_the_year = $(".div_for_survey_"+first_quest_type + " input[name='question_you_agree_sponsor_student_of_the_year']:checked" ).val();
                                    if(question_you_agree_sponsor_student_of_the_year){
                                        $(".div_for_survey_" + first_quest_type + " .question_you_agree_sponsor_student_of_the_year").slideUp(0);
                                        $(".div_for_survey_" + first_quest_type + " .question_you_accept_your_profile_public_recruiters").slideDown(0);
                                        var question_you_accept_your_profile_public_recruiters = $(".div_for_survey_"+first_quest_type + " input[name='question_you_accept_your_profile_public_recruiters']:checked" ).val();
                                        if(question_you_accept_your_profile_public_recruiters){
                                            $(".div_for_survey_"+first_quest_type + ' .question_you_accept_your_profile_public_recruiters' ).slideUp(0);
                                            $(".question_from_avatar").slideDown(0);
                                            if ($("#user_avatar")[0].files.length != 0 ) {
                                                $(".question_from_avatar").slideUp(0);
                                                $(".btn_for_next_question").slideUp(0);
                                                $('.div_for_thanks_message').append("On a fini HOURA ! Un grand merci. Votre profil est désormais fin prêt. Vous pouvez ajouter ou modifier toutes les informations à votre gré.");
                                                submitForm()
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    }
                }
            }
            else if ( first_quest_type == '2' ) {
                var first_name = $("#first_name").val();
                var last_name = $("#last_name").val();
                $(".span_for_full_name").html(first_name + " " + last_name);
                $(".div_for_description_part_first").slideUp(0);
                var survey_for_seconde_one_true = false;

                $(".div_for_survey_"+first_quest_type + " .question_3_v3_q1").slideUp(0);
                $(".div_for_survey_"+first_quest_type + " .question_2").slideDown(0);
                var second_quest = $(".div_for_survey_"+first_quest_type + " input[name='when_end_school']:checked" ).val();
                var second_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='when_end_school']:checked" ).data('type');
                if(second_quest_type == '1'){
                    $(".div_for_survey_"+first_quest_type + " .question_2").slideUp(0);
                    $(".div_for_survey_"+first_quest_type + " .question_3_v1_q1").slideDown(0);
                    var third_quest = $(".div_for_survey_"+first_quest_type + " #year_of_graduate" ).val();
                    if(third_quest){
                        $(".div_for_survey_"+first_quest_type + " .question_3_v1_q1").slideUp(0);
                        $(".div_for_survey_"+first_quest_type + " .question_4_v1_q2").slideDown(0);
                        var four_quest = $(".div_for_survey_"+first_quest_type + " #followed_curriculum" ).val();
                        if(four_quest){
                            $(".div_for_survey_"+first_quest_type + " .question_4_v1_q2").slideUp(0);
                            $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3").slideDown(0);
                            var four_quest = $(".div_for_survey_"+first_quest_type + " input[name='current_situation']:checked" ).val();
                            var four_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='current_situation']:checked" ).data('type');
                            if(four_quest_type == '1'){
                                $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_6_v1_q4_v1_q1").slideDown(0);
                                var five_quest = $(".div_for_survey_"+first_quest_type + " #which_city_training" ).val();
                                if(five_quest){
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v1_q4_v1_q1").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_7_v1_q5_v1_q2").slideDown(0);
                                    var six_quest = $(".div_for_survey_"+first_quest_type + " #which_city_training" ).val();
                                    if (six_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_6_v1_q4_v1_q1").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_7_v1_q5_v1_q2").slideDown(0);
                                        var seven_quest = $(".div_for_survey_"+first_quest_type + " #which_institution_follow" ).val();
                                        if(seven_quest){
                                            $(".div_for_survey_"+first_quest_type + " .question_7_v1_q5_v1_q2").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .question_8_v1_q6_v1_q3").slideDown(0);
                                            var eight_quest = $(".div_for_survey_"+first_quest_type + " #kind_of_diploma" ).val();
                                            if(eight_quest){
                                                $(".div_for_survey_"+first_quest_type + " .question_8_v1_q6_v1_q3").slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideDown(0);
                                                var nein_quest = $(".div_for_survey_"+first_quest_type + "input[name='look_intership_or_alternation']:checked").val();
                                                var nein_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='look_intership_or_alternation']:checked").data('type');
                                                if(nein_quest_type == '1'){

                                                    $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideDown(0);
                                                    var ten_quest = $(".div_for_survey_"+first_quest_type + " #field_for_intership").val();
                                                    if(ten_quest){
                                                        $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideUp(0);
                                                        $(".div_for_survey_"+first_quest_type + " .question_11_v1_q9_v1_q6_v1_q2").slideDown(0);
                                                        var eleven_quest = $(".div_for_survey_"+first_quest_type + " #date_of_start_intership").val();
                                                        if(eleven_quest){
                                                            $(".div_for_survey_"+first_quest_type + " .question_11_v1_q9_v1_q6_v1_q2").slideUp(0);
                                                            $(".div_for_survey_"+first_quest_type + " .question_12_v1_q10_v1_q7_v1_q3").slideDown(0);
                                                            var twelfe_quest = $(".div_for_survey_"+first_quest_type + " #duration_of_membership").val();
                                                            if(twelfe_quest . length > 0){
                                                                survey_for_seconde_one_true = true
                                                                $(".div_for_survey_"+first_quest_type + " .question_12_v1_q10_v1_q7_v1_q3").slideUp(0);
                                                            }
                                                        }
                                                    }
                                                }
                                                else if(nein_quest_type == '2'){
                                                    $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideDown(0);
                                                    var ten_quest = $(".div_for_survey_"+first_quest_type + " #field_for_intership").val();
                                                    if(ten_quest){
                                                        $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideUp(0);
                                                        $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v2_q5").slideDown(0);
                                                        var eleven_quest = $(".div_for_survey_"+first_quest_type + " #date_of_start_alternation").val();
                                                        if(eleven_quest){
                                                            $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v2_q5").slideUp(0);
                                                            $(".div_for_survey_"+first_quest_type + " .question_11_v1_q9_v2_q6").slideDown(0);
                                                            var twelfe_quest = $(".div_for_survey_"+first_quest_type + " #duration_of_alternation").val();
                                                            if(twelfe_quest){
                                                                survey_for_seconde_one_true = true
                                                                $(".div_for_survey_"+first_quest_type + " .question_11_v1_q9_v2_q6").slideUp(0);
                                                            }
                                                        }
                                                    }
                                                }
                                                else if( nein_quest_type == '3'){
                                                    survey_for_seconde_one_true = true
                                                    $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideUp(0);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            else if(four_quest_type == '2'){
                                $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_6_v2_q4").slideDown(0);
                                var five_quest = $(".div_for_survey_"+first_quest_type + " #which_company_you_work").val();
                                if(five_quest){
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v2_q4").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_7_v2_q5").slideDown(0);
                                    var six_quest = $(".div_for_survey_"+first_quest_type + " #which_city_worked").val();
                                    if(six_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_7_v2_q5").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_8_v2_q6").slideDown(0);
                                        var six_quest = $(".div_for_survey_"+first_quest_type + " #which_field_work").val();
                                        if(six_quest){
                                            $(".div_for_survey_"+first_quest_type + " .question_8_v2_q6").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .question_9_v2_q7").slideDown(0);
                                            var seven_quest = $(".div_for_survey_"+first_quest_type + " #what_function_copy").val();
                                            if(seven_quest){
                                                $(".div_for_survey_"+first_quest_type + " .question_9_v2_q7").slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + " .question_10_v2_q8").slideDown(0);
                                                var eight_quest = $(".div_for_survey_"+first_quest_type + " #when_you_start_this_job").val();
                                                if(eight_quest){
                                                    $(".div_for_survey_"+first_quest_type + " .question_10_v2_q8").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .quest_nature_contract").slideDown(0);
                                                    var new_ans = $(".div_for_survey_"+first_quest_type + " #nature_of_contract").val();
                                                    if(new_ans){
                                                        $(".div_for_survey_"+first_quest_type + " .quest_nature_contract").slideUp(0);
                                                        $(".div_for_survey_"+first_quest_type + " .question_11_v2_q9").slideDown(0);
                                                        var nein_quest = $(".div_for_survey_"+first_quest_type + " input[name='first_professional_experience']:checked").val();
                                                        if(nein_quest){
                                                            $(".div_for_survey_"+first_quest_type + " .question_11_v2_q9").slideUp(0);
                                                            $(".div_for_survey_"+first_quest_type + " .question_12_v2_q10").slideDown(0);
                                                            var ten_quest = $(".div_for_survey_"+first_quest_type + " #level_of_experience").val();
                                                            if(ten_quest){
                                                                $(".div_for_survey_"+first_quest_type + " .question_12_v2_q10").slideUp(0);
                                                                $(".div_for_survey_"+first_quest_type + " .question_13_v2_q11").slideDown(0);
                                                                var eleven_quest = $(".div_for_survey_"+first_quest_type + " #salary_bracket").val();
                                                                if(eleven_quest){
                                                                    survey_for_seconde_one_true = true
                                                                    $(".div_for_survey_"+first_quest_type + " .question_13_v2_q11").slideUp(0);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                            else if(four_quest_type == '3'){
                                $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_6_v3_q4").slideDown(0);
                                var five_quest = $(".div_for_survey_"+first_quest_type + " input[name='your_first_job']:checked").val();
                                if(five_quest){
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v3_q4").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_7_v3_q5").slideDown(0);
                                    var six_quest = $(".div_for_survey_"+first_quest_type + " #which_area_find_job").val();
                                    if(six_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_7_v3_q5").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_8_v3_q6").slideDown(0);
                                        var seven_quest = $(".div_for_survey_"+first_quest_type + " #what_function_are_you_looking_for").val();
                                        if( seven_quest.length > 0 ){
                                            $(".div_for_survey_"+first_quest_type + " .question_8_v3_q6").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .question_9_v3_q7").slideDown(0);
                                            var eight_quest = $(".div_for_survey_"+first_quest_type + " #desired_salary_range").val();
                                            if(eight_quest){
                                                survey_for_seconde_one_true = true
                                                $(".div_for_survey_"+first_quest_type + " .question_9_v3_q7").slideUp(0);
                                            }

                                        }
                                    }
                                }

                            }
                            if(survey_for_seconde_one_true) {
                                $(".div_for_survey_" + first_quest_type + " .lets_fo_for_a_little_flashback").slideDown(0);
                                count_for_middle_question++;
                                if(count_for_middle_question > 1){
                                    $(".div_for_survey_" + first_quest_type + " .lets_fo_for_a_little_flashback").slideUp(0);
                                    $(".div_for_survey_" + first_quest_type + " .lets_question_1").slideDown(0);
                                    var lets_first = $(".div_for_survey_"+first_quest_type + " #quality_of_lessons").val();
                                    if(lets_first){
                                        $(".div_for_survey_" + first_quest_type + " .lets_question_1").slideUp(0);
                                        $(".div_for_survey_" + first_quest_type + " .lets_question_2").slideDown(0);
                                        var lets_second = $(".div_for_survey_"+first_quest_type + " #miss_the_ten_quality").val();
                                        if(lets_second){
                                            $(".div_for_survey_" + first_quest_type + " .lets_question_2").slideUp(0);
                                            $(".div_for_survey_" + first_quest_type + " .lets_question_3").slideDown(0);
                                            var lets_three = $(".div_for_survey_"+first_quest_type + " #your_rate_overall_satisfaction_training").val();
                                            if(lets_three){
                                                $(".div_for_survey_" + first_quest_type + " .lets_question_3").slideUp(0);
                                                $(".div_for_survey_" + first_quest_type + " .lets_question_4").slideDown(0);
                                                var lets_four = $(".div_for_survey_"+first_quest_type + " #miss_the_ten_overall").val();
                                                if(lets_four){
                                                    $(".div_for_survey_" + first_quest_type + " .lets_question_4").slideUp(0);
                                                    $(".div_for_survey_" + first_quest_type + " .lets_question_5").slideDown(0);
                                                    var lets_five = $(".div_for_survey_"+first_quest_type + " input[name='visible_profile_recruiters']:checked").val();
                                                    if(lets_five){
                                                        $(".div_for_survey_" + first_quest_type + " .lets_question_5").slideUp(0);
                                                        $(".div_for_survey_" + first_quest_type + " .lets_question_6").slideDown(0);
                                                        var lets_six = $(".div_for_survey_"+first_quest_type + " input[name='weekly_notification_latest_job']:checked").val();
                                                        if(lets_six){
                                                            $(".div_for_survey_" + first_quest_type + " .lets_question_6").slideUp(0);
                                                            $(".div_for_survey_" + first_quest_type + " .lets_question_7").slideDown(0);
                                                            var lets_seven= $(".div_for_survey_"+first_quest_type + " input[name='interested_to_diploma']:checked").val();
                                                            if(lets_seven){
                                                                $(".div_for_survey_" + first_quest_type + " .lets_question_7").slideUp(0);
                                                                $(".div_for_survey_" + first_quest_type + " .lets_question_8").slideDown(0);
                                                                var lets_eight= $(".div_for_survey_"+first_quest_type + " input[name='student_mentor']:checked").val();
                                                                if(lets_eight){
                                                                    $(".div_for_survey_" + first_quest_type + " .lets_question_8").slideUp(0);
                                                                    $(".div_for_survey_" + first_quest_type + " .lets_question_9").slideDown(0);
                                                                    var lets_nein= $(".div_for_survey_"+first_quest_type + " #leave_message_old_school").val();
                                                                    if(lets_nein){
                                                                        $(".div_for_survey_"+first_quest_type + ' .lets_question_9' ).slideUp(0);
                                                                        $(".question_from_avatar").slideDown(0);
                                                                        if ($("#user_avatar")[0].files.length != 0 ) {
                                                                            $(".question_from_avatar").slideUp(0);
                                                                            $(".btn_for_next_question").slideUp(0);
                                                                            // ___________________________________
                                                                            $('.div_for_thanks_message').append("On a fini HOURA ! Un grand merci. Votre profil est désormais fin prêt. Vous pouvez ajouter ou modifier toutes les informations à votre gré.");
                                                                            submitForm()
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
                else if(second_quest_type == '2'){
                    $(".div_for_survey_"+first_quest_type + " .question_2").slideUp(0);
                    $(".div_for_survey_"+first_quest_type + " .quest_for_upodate").slideDown(0);
                    var third_quest = $(".div_for_survey_"+first_quest_type + " #year_did_of_graduate" ).val();
                    if(third_quest){
                        $(".div_for_survey_"+first_quest_type + " .quest_for_upodate").slideUp(0);
                        $(".div_for_survey_"+first_quest_type + " .question_4_v1_q2").slideDown(0);
                        var four_quest = $(".div_for_survey_"+first_quest_type + " #followed_curriculum" ).val();
                        if(four_quest){
                            $(".div_for_survey_"+first_quest_type + " .question_4_v1_q2").slideUp(0);
                            $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3").slideDown(0);
                            var five_quest = $(".div_for_survey_"+first_quest_type + " input[name='current_situation']:checked" ).val();
                            var five_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='current_situation']:checked" ).data('type');
                            if(five_quest_type =='1' ){
                                $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .quest_6_v1_q4_v1_q1").slideDown(0);
                                var six_quest = $(".div_for_survey_"+first_quest_type + " input[name='continuation_resumption_of_study']:checked" ).val();
                                if(six_quest){
                                    $(".div_for_survey_"+first_quest_type + " .quest_6_v1_q4_v1_q1").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v1_q4_v1_q1").slideDown(0);
                                    var seven_quest = $(".div_for_survey_"+first_quest_type + " #which_city_training" ).val();
                                    if(seven_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_6_v1_q4_v1_q1").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_7_v1_q5_v1_q2").slideDown(0);
                                        var eight_quest = $(".div_for_survey_"+first_quest_type + " #which_institution_follow" ).val();
                                        if(eight_quest){
                                            $(".div_for_survey_"+first_quest_type + " .question_7_v1_q5_v1_q2").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .question_8_v1_q6_v1_q3").slideDown(0);
                                            var nein_quest = $(".div_for_survey_"+first_quest_type + " #kind_of_diploma" ).val();
                                            if(nein_quest){
                                                $(".div_for_survey_"+first_quest_type + " .question_8_v1_q6_v1_q3").slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideDown(0);
                                                var ten_quest = $(".div_for_survey_"+first_quest_type + " input[name='look_intership_or_alternation']:checked" ).val();
                                                var ten_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='look_intership_or_alternation']:checked" ).data('type');
                                                var open_lets_flashback = false;
                                                if(ten_quest_type == '1'){
                                                    $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideDown(0);
                                                    var eleven_quest = $(".div_for_survey_"+first_quest_type + " #field_for_intership" ).val();
                                                    if(eleven_quest){
                                                        $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideUp(0);
                                                        $(".div_for_survey_"+first_quest_type + " .quest_7_v1_q5_v1_q2").slideDown(0);
                                                        var twelfe_quest = $(".div_for_survey_"+first_quest_type + " #when_you_start_your_intership" ).val();
                                                        if(twelfe_quest){
                                                            $(".div_for_survey_"+first_quest_type + " .quest_7_v1_q5_v1_q2").slideUp(0);
                                                            $(".div_for_survey_"+first_quest_type + " .question_12_v1_q10_v1_q7_v1_q3").slideDown(0);
                                                            var thirdteen_quest = $(".div_for_survey_"+first_quest_type + " #duration_of_membership" ).val();
                                                            if(thirdteen_quest.length > 0){
                                                                $(".div_for_survey_"+first_quest_type + " .question_12_v1_q10_v1_q7_v1_q3").slideUp(0);
                                                                open_lets_flashback = true
                                                            }
                                                        }
                                                    }
                                                }
                                                else if(ten_quest_type == '2'){
                                                    $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideDown(0);
                                                    var eleven_quest = $(".div_for_survey_"+first_quest_type + " #field_for_intership" ).val();
                                                    if(eleven_quest){
                                                        $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v1_q5_v1_q1").slideUp(0);
                                                        $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v2_q5").slideDown(0);
                                                        var twelfe_quest = $(".div_for_survey_"+first_quest_type + " #date_of_start_alternation" ).val();
                                                        if(twelfe_quest){
                                                            $(".div_for_survey_"+first_quest_type + " .question_10_v1_q8_v2_q5").slideUp(0);
                                                            $(".div_for_survey_"+first_quest_type + " .question_11_v1_q9_v2_q6").slideDown(0);
                                                            var thirdten_quest = $(".div_for_survey_"+first_quest_type + " #duration_of_alternation" ).val();
                                                            if(thirdten_quest){
                                                                $(".div_for_survey_"+first_quest_type + " .question_11_v1_q9_v2_q6").slideUp(0);
                                                                open_lets_flashback = true
                                                            }
                                                        }
                                                    }
                                                }
                                                else if(ten_quest_type == '3'){
                                                    $(".div_for_survey_"+first_quest_type + " .question_9_v1_q7_v1_q4").slideUp(0);
                                                    open_lets_flashback = true
                                                }

                                            }
                                        }
                                    }
                                }
                            }
                            else if( five_quest_type == '2'){
                                $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_6_v2_q4").slideDown(0);
                                var six_quest = $(".div_for_survey_"+first_quest_type + " #which_company_you_work" ).val();
                                if(six_quest){
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v2_q4").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_8_v2_q6").slideDown(0);
                                    var seven_quest = $(".div_for_survey_"+first_quest_type + " #which_field_work" ).val();
                                    if(seven_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_8_v2_q6").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_9_v2_q7").slideDown(0);
                                        var eight_quest = $(".div_for_survey_"+first_quest_type + " #what_function_copy" ).val();
                                        if(eight_quest){
                                            $(".div_for_survey_"+first_quest_type + " .question_9_v2_q7").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .question_10_v2_q8").slideDown(0);
                                            var nein_quest = $(".div_for_survey_"+first_quest_type + " #when_you_start_this_job" ).val();
                                            if(nein_quest){
                                                $(".div_for_survey_"+first_quest_type + " .question_10_v2_q8").slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + " .quest_nature_contract").slideDown(0);
                                                var ten_quest = $(".div_for_survey_"+first_quest_type + " #nature_of_contract" ).val();
                                                if(ten_quest){
                                                    $(".div_for_survey_"+first_quest_type + " .quest_nature_contract").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .question_11_v2_q9").slideDown(0);
                                                    var eleven_quest = $(".div_for_survey_"+first_quest_type + " input[name='first_professional_experience']:checked" ).val();
                                                    if(eleven_quest){
                                                        $(".div_for_survey_"+first_quest_type + " .question_11_v2_q9").slideUp(0);
                                                        open_lets_flashback = true
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            else if( five_quest_type == '3'){
                                $(".div_for_survey_"+first_quest_type + " .question_5_v1_q3 ").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_6_v3_q4").slideDown(0);
                                var six_quest = $(".div_for_survey_"+first_quest_type + " input[name='your_first_job']:checked" ).val();
                                if(six_quest){
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v3_q4 ").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_7_v3_q5").slideDown(0);
                                    var seven_quest = $(".div_for_survey_"+first_quest_type + " #which_area_find_job" ).val();
                                    if(seven_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_7_v3_q5 ").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .question_8_v3_q6").slideDown(0);
                                        var eight_quest = $(".div_for_survey_"+first_quest_type + " #what_function_are_you_looking_for" ).val();
                                        if(eight_quest.length > 0 ){
                                            $(".div_for_survey_"+first_quest_type + " .question_8_v3_q6 ").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .question_9_v3_q7").slideDown(0);
                                            var nein_quest = $(".div_for_survey_"+first_quest_type + " #desired_salary_range" ).val();
                                            if(nein_quest){
                                                $(".div_for_survey_"+first_quest_type + " .question_9_v3_q7").slideUp(0);
                                                open_lets_flashback = true
                                            }
                                        }
                                    }
                                }
                            }
                            if(open_lets_flashback){

                                count_for_lets_flashback++;
                                $(".div_for_survey_"+first_quest_type + " .open_lets_flashback").slideDown(0);
                                if(count_for_lets_flashback > 1){
                                    $(".div_for_survey_"+first_quest_type + " .open_lets_flashback").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_after_this_training").slideDown(0);
                                    var lets_first = $(".div_for_survey_"+first_quest_type + " input[name='after_this_training']:checked" ).val();
                                    var lets_first_type = $(".div_for_survey_"+first_quest_type + " input[name='after_this_training']:checked" ).data('type');
                                    if(lets_first_type == '1'){
                                        $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_after_this_training").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_which_institution_make_this_additional_training").slideDown(0);
                                        var lets_second = $(".div_for_survey_"+first_quest_type + " #which_institution__did_you_make_additional_training" ).val();
                                        if(lets_second){
                                            $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_which_institution_make_this_additional_training").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_what_title_of_diploma").slideDown(0);
                                            var lets_third= $(".div_for_survey_"+first_quest_type + " #what_title_of_diploma" ).val();
                                            if(lets_third){
                                                for_open_second_last_part = true
                                                $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_what_title_of_diploma").slideUp(0);
                                            }
                                        }
                                    }
                                    else if(lets_first_type == '2'){
                                        for_open_second_last_part = true
                                        $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_after_this_training").slideUp(0);
                                    }
                                    else if(lets_first_type == '3'){
                                        $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_after_this_training").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_time_to_first_job").slideDown(0);
                                        var lets_third= $(".div_for_survey_"+first_quest_type + " #time_to_first_find_job" ).val();
                                        if(lets_third){
                                            $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_time_to_first_job").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_job_part_for_training").slideDown(0);
                                            var lets_five = $(".div_for_survey_"+first_quest_type + " input[name='job_part_for_training']:checked" ).val();
                                            if(lets_five){
                                                $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_job_part_for_training").slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_how_did_you_find_this_job").slideDown(0);
                                                var lets_six_one = $(".div_for_survey_"+first_quest_type + " input[name='how_did_you_find_this_job']:checked" ).val();
                                                if(lets_six_one){
                                                    $(".div_for_survey_"+first_quest_type + " .open_lets_flashback_how_did_you_find_this_job").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .quest_nature_contract").slideDown(0);
                                                    var lets_six = $(".div_for_survey_"+first_quest_type + " #nature_of_contract" ).val();
                                                    if(lets_six){
                                                        $(".div_for_survey_"+first_quest_type + " .quest_nature_contract").slideUp(0);
                                                        $(".div_for_survey_"+first_quest_type + " .which_company_this").slideDown(0);
                                                        var lets_seven= $(".div_for_survey_"+first_quest_type + " #which_company_this" ).val();
                                                        if(lets_seven){
                                                            $(".div_for_survey_"+first_quest_type + " .which_company_this").slideUp(0);
                                                            $(".div_for_survey_"+first_quest_type + " .what_area_this_job").slideDown(0);
                                                            var lets_eight= $(".div_for_survey_"+first_quest_type + " #what_area_this_job" ).val();
                                                            if(lets_eight){
                                                                $(".div_for_survey_"+first_quest_type + " .what_area_this_job").slideUp(0);
                                                                $(".div_for_survey_"+first_quest_type + " .what_socio_professional_category_this_job").slideDown(0);
                                                                var lets_nein= $(".div_for_survey_"+first_quest_type + " #what_socio_professional_category_this_job" ).val();
                                                                if(lets_nein){
                                                                    $(".div_for_survey_"+first_quest_type + " .what_socio_professional_category_this_job").slideUp(0);
                                                                    $(".div_for_survey_"+first_quest_type + " .what_title_of_your_post").slideDown(0);
                                                                    var lets_ten= $(".div_for_survey_"+first_quest_type + " #what_title_of_your_post" ).val();
                                                                    if(lets_ten){
                                                                        $(".div_for_survey_"+first_quest_type + " .what_title_of_your_post").slideUp(0);
                                                                        $(".div_for_survey_"+first_quest_type + " .full_time_or_part_time_job").slideDown(0);
                                                                        var lets_eleven = $(".div_for_survey_"+first_quest_type + " input[name='full_time_or_part_time_job']:checked" ).val();
                                                                        if(lets_eleven){
                                                                            $(".div_for_survey_"+first_quest_type + " .full_time_or_part_time_job").slideUp(0);
                                                                            $(".div_for_survey_"+first_quest_type + " .still_hold_this_job").slideDown(0);
                                                                            var lets_twelfe = $(".div_for_survey_"+first_quest_type + " input[name='still_hold_this_job']:checked" ).val();
                                                                            if(lets_twelfe){
                                                                                for_open_second_last_part = true
                                                                                $(".div_for_survey_"+first_quest_type + " .still_hold_this_job").slideUp(0);
                                                                            }
                                                                        }

                                                                    }

                                                                }

                                                            }

                                                        }

                                                    }
                                                }
                                            }

                                        }
                                    }
                                    if(for_open_second_last_part){
                                        $(".div_for_survey_"+first_quest_type + " .lets_question_1").slideDown(0);
                                        var lets_five= $(".div_for_survey_"+first_quest_type + " #quality_of_lessons" ).val();
                                        if(lets_five){
                                            $(".div_for_survey_"+first_quest_type + " .lets_question_1").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + " .lets_question_2").slideDown(0);
                                            var lets_six= $(".div_for_survey_"+first_quest_type + " #miss_the_ten_quality" ).val();
                                            if(lets_six){
                                                $(".div_for_survey_"+first_quest_type + " .lets_question_2").slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + " .lets_question_3").slideDown(0);
                                                var lets_eight = $(".div_for_survey_"+first_quest_type + " #your_rate_overall_satisfaction_training" ).val();
                                                if(lets_eight){
                                                    $(".div_for_survey_"+first_quest_type + " .lets_question_3").slideUp(0);
                                                    $(".div_for_survey_"+first_quest_type + " .lets_question_4").slideDown(0);
                                                    var lets_nein= $(".div_for_survey_"+first_quest_type + " #miss_the_ten_overall" ).val();
                                                    if(lets_nein){
                                                        $(".div_for_survey_"+first_quest_type + " .lets_question_4").slideUp(0);

                                                        $(".div_for_survey_1" + " .question_you_accept_your_profile_public_recruiters").slideDown(0);
                                                        var lets_ten= $(".div_for_survey_1" + " input[name='question_you_accept_your_profile_public_recruiters']:checked" ).val();
                                                        if(lets_ten){
                                                            $(".div_for_survey_1" + " .question_you_accept_your_profile_public_recruiters").slideUp(0);
                                                            $(".div_for_survey_2" + " .lets_question_6").slideDown(0);
                                                            var lets_eleven= $(".div_for_survey_"+first_quest_type + " input[name='weekly_notification_latest_job']:checked" ).val();
                                                            if(lets_eleven){
                                                                $(".div_for_survey_"+first_quest_type + " .lets_question_6").slideUp(0);
                                                                $(".div_for_survey_2" + " .lets_question_7").slideDown(0);
                                                                var lets_twelfe= $(".div_for_survey_"+first_quest_type + " input[name='interested_to_diploma']:checked" ).val();
                                                                if(lets_twelfe){
                                                                    $(".div_for_survey_"+first_quest_type + " .lets_question_7").slideUp(0);
                                                                    $(".div_for_survey_2" + " .lets_question_8").slideDown(0);
                                                                    var lets_thirdthreen= $(".div_for_survey_"+first_quest_type + " input[name='student_mentor']:checked" ).val();
                                                                    if(lets_thirdthreen){
                                                                        $(".div_for_survey_"+first_quest_type + " .lets_question_8").slideUp(0);
                                                                        $(".div_for_survey_2" + " .lets_question_9").slideDown(0);
                                                                        var lets_fourteen = $(".div_for_survey_"+first_quest_type + " #leave_message_old_school" ).val();
                                                                        if(lets_fourteen){
                                                                            $(".div_for_survey_"+first_quest_type + ' .lets_question_9' ).slideUp(0);
                                                                            $(".question_from_avatar").slideDown(0);
                                                                            if ($("#user_avatar")[0].files.length != 0 ) {
                                                                                $(".question_from_avatar").slideUp(0);
                                                                                $(".btn_for_next_question").slideUp(0);
                                                                                // ___________________________________
                                                                                $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme.");
                                                                                submitForm()
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else if ( first_quest_type == '3' ) {
                $(".div_for_description_part_first").slideUp(0);
                $(".div_for_survey_"+first_quest_type + " .question_" + count_for_question).slideDown(0);
                var second_quest = $(".div_for_survey_"+first_quest_type + " input[name='role']:checked" ).val();
                var second_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='role']:checked" ).data('type');
                count_for_3_survey++;
                if ( second_quest ){
                    if(second_quest == "teacher"){
                        var true1 = false;
                        $(".div_for_survey_"+first_quest_type + ' .question_2' ).slideUp(0);
                        $(".div_for_survey_"+first_quest_type + ' .question_3_v3_q1' ).slideDown(0);
                        var third_quest = $(".div_for_survey_"+first_quest_type + " #choose_degree" ).val();
                        if(third_quest){
                            $(".div_for_survey_"+first_quest_type + " .question_3_v3_q1").slideUp(0);
                            $(".div_for_survey_"+first_quest_type + " .question_4_v1_q2").slideDown(0);
                            var four_quest = $(".div_for_survey_"+first_quest_type + " input[name='other_activity']:checked" ).val();
                            var four_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='other_activity']:checked" ).data('type');
                            if(four_quest){
                                if(four_quest_type == '1'){
                                    $(".div_for_survey_"+first_quest_type + ' .question_5_v1_q3_v1_q1' ).slideDown(0);
                                    $(".div_for_survey_"+first_quest_type + ' .question_4_v1_q2' ).slideUp(0);
                                    var five_quest = $(".div_for_survey_"+first_quest_type + " input[name='title_of_position']" ).val();
                                    if(five_quest){
                                        $(".div_for_survey_"+first_quest_type + ' .question_6_v1_q4_v1_q2' ).slideDown(0);
                                        $(".div_for_survey_"+first_quest_type + ' .question_5_v1_q3_v1_q1' ).slideUp(0);
                                        var six_quest = $(".div_for_survey_"+first_quest_type + " input[name='name_of_work']" ).val();
                                        if(six_quest.length > 0){
                                            true1 = true;
                                            $(".div_for_survey_"+first_quest_type + ' .question_6_v1_q4_v1_q2' ).slideUp(0);
                                        }
                                    }
                                }
                                else if(four_quest_type == '2'){
                                    true1 = true;
                                    $(".div_for_survey_"+first_quest_type + ' .question_4_v1_q2' ).slideUp(0);
                                }
                                if(true1){
                                    $(".div_for_survey_"+first_quest_type + ' .question_6_v3_q4' ).slideDown(0);
                                    var seven_quest = $(".div_for_survey_"+first_quest_type + " input[name='know_about_academic_background']" ).val();
                                    var seven_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='know_about_academic_background']:checked" ).data('type');
                                    if(seven_quest_type == '1'){
                                        $(".div_for_survey_"+first_quest_type + ' .question_6_v3_q4' ).slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + ' .question_8_v1_p1' ).slideDown(0);
                                        var eight_quest = $(".div_for_survey_"+first_quest_type + " input[name='diplom_number']:checked" ).val();
                                        if(eight_quest){
                                            $(".div_for_survey_"+first_quest_type + ' .question_8_v1_p1' ).slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + ' .question_9_v1_p1_q1' ).slideDown(0);
                                            var nein_quest = $(".div_for_survey_"+first_quest_type + " #institution" ).val();
                                            if(nein_quest){
                                                $(".div_for_survey_"+first_quest_type + ' .question_9_v1_p1_q1' ).slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + ' .question_10_v1_p1_q2' ).slideDown(0);
                                                var ten_quest = $(".div_for_survey_"+first_quest_type + " #graduation_year_survey_3" ).val();
                                                if(ten_quest){
                                                    $(".div_for_survey_"+first_quest_type + ' .question_10_v1_p1_q2' ).slideUp(0);
                                                    $(".question_from_avatar").slideDown(0);
                                                    if ($("#user_avatar")[0].files.length != 0 ) {
                                                        $(".question_from_avatar").slideUp(0);
                                                        $(".btn_for_next_question").slideUp(0);
                                                        // ___________________________________
                                                        $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme.");
                                                        submitForm()
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else if ( seven_quest_type == '2' ){
                                        $(".div_for_survey_"+first_quest_type + ' .question_6_v3_q4' ).slideUp(0);
                                        $(".question_from_avatar").slideDown(0);
                                        if ($("#user_avatar")[0].files.length != 0 ) {
                                            $(".question_from_avatar").slideUp(0);
                                            $(".btn_for_next_question").slideUp(0);
                                            // ___________________________________
                                            $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme");
                                            submitForm()
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else if ( second_quest == 'administrativ' ){

                        $(".div_for_survey_"+first_quest_type + " .question_2").slideUp(0);
                        $(".div_for_survey_"+first_quest_type + ' .question_3_v2_q1').slideDown(0);
                        var third_quest = $(".div_for_survey_"+first_quest_type + " input[name='title_of_the_post']" ).val();
                        if(third_quest){
                            $(".div_for_survey_"+first_quest_type + " .question_3_v2_q1").slideUp(0);
                            $(".div_for_survey_"+first_quest_type + ' .question_5_v3_q3').slideDown(0);
                            var four_quest = $(".div_for_survey_"+first_quest_type + " input[name='describe_mission']" ).val();
                            if(four_quest){
                                $(".div_for_survey_"+first_quest_type + " .question_5_v3_q3").slideUp(0);
                                $(".div_for_survey_"+first_quest_type + ' .question_6_v3_q4').slideDown(0);
                                var five_quest = $(".div_for_survey_"+first_quest_type + " input[name='know_about_academic_background']:checked" ).val();
                                var five_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='know_about_academic_background']:checked" ).data('type');
                                if(five_quest_type == '1'){
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v3_q4").slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + ' .question_8_v1_p1').slideDown(0);
                                    var six_quest = $(".div_for_survey_"+first_quest_type + " input[name='diplom_number']:checked" ).val();
                                    var six_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='diplom_number']:checked" ).data('type');
                                    if(six_quest){
                                        $(".div_for_survey_"+first_quest_type + " .question_8_v1_p1").slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + ' .question_9_v1_p1_q1').slideDown(0);
                                        var seven_quest = $(".div_for_survey_"+first_quest_type + " #institution" ).val();
                                        if(seven_quest){
                                            $(".div_for_survey_"+first_quest_type + " .question_9_v1_p1_q1").slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + ' .question_10_v1_p1_q2').slideDown(0);
                                            var eight_quest = $(".div_for_survey_"+first_quest_type + " #graduation_year_survey_3" ).val();
                                            if(eight_quest){
                                                $(".div_for_survey_"+first_quest_type + ' .question_10_v1_p1_q2' ).slideUp(0);
                                                $(".question_from_avatar").slideDown(0);
                                                if ($("#user_avatar")[0].files.length != 0 ) {
                                                    $(".question_from_avatar").slideUp(0);
                                                    $(".btn_for_next_question").slideUp(0);
                                                    // ___________________________________
                                                    $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme.");
                                                    submitForm()
                                                }
                                            }
                                        }
                                    }
                                }
                                else if(five_quest_type == '2'){
                                    $(".div_for_survey_"+first_quest_type + ' .question_6_v3_q4' ).slideUp(0);
                                    $(".question_from_avatar").slideDown(0);
                                    if ($("#user_avatar")[0].files.length != 0 ) {
                                        $(".question_from_avatar").slideUp(0);
                                        $(".btn_for_next_question").slideUp(0);
                                        // ___________________________________
                                        $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme.");
                                        submitForm()
                                    }
                                }
                            }
                        }

                    }
                    else if ( second_quest == 'both' ){
                        $(".div_for_survey_"+first_quest_type + ' .question_3_v3_q1').slideDown(0);
                        $(".div_for_survey_"+first_quest_type + " .question_2").slideUp(0);
                        var third_quest = $(".div_for_survey_"+first_quest_type + " #choose_degree" ).val();
                        if(third_quest){
                            $(".div_for_survey_"+first_quest_type + ' .question_3_v3_q1').slideUp(0);
                            $(".div_for_survey_"+first_quest_type + " .question_4_v3_q2").slideDown(0);
                            var four_quest =$(".div_for_survey_"+first_quest_type + " input[name='admin_of_the_school_title']" ).val();
                            if(four_quest && four_quest.length > 0){
                                $(".div_for_survey_"+first_quest_type + ' .question_4_v3_q2').slideUp(0);
                                $(".div_for_survey_"+first_quest_type + " .question_5_v3_q3").slideDown(0);
                                var six_quest =$(".div_for_survey_"+first_quest_type + " input[name='describe_mission']" ).val();
                                if(six_quest && six_quest.length > 0){
                                    $(".div_for_survey_"+first_quest_type + ' .question_5_v3_q3').slideUp(0);
                                    $(".div_for_survey_"+first_quest_type + " .question_6_v3_q4").slideDown(0);
                                    var seven_quest = $(".div_for_survey_"+first_quest_type + " input[name='know_about_academic_background']:checked" ).val();
                                    var seven_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='know_about_academic_background']:checked" ).data('type');
                                    if(seven_quest_type == '1'){
                                        $(".div_for_survey_"+first_quest_type + ' .question_6_v3_q4' ).slideUp(0);
                                        $(".div_for_survey_"+first_quest_type + ' .question_8_v1_p1' ).slideDown(0);
                                        var eight_quest = $(".div_for_survey_"+first_quest_type + " input[name='diplom_number']:checked" ).val();
                                        var eight_quest_type = $(".div_for_survey_"+first_quest_type + " input[name='diplom_number']:checked" ).data('type');
                                        if(eight_quest_type == '1' || eight_quest_type == '2' || eight_quest_type == '3'  ){
                                            $(".div_for_survey_"+first_quest_type + ' .question_8_v1_p1' ).slideUp(0);
                                            $(".div_for_survey_"+first_quest_type + ' .question_9_v1_p1_q1' ).slideDown(0);
                                            var nein_quest = $(".div_for_survey_"+first_quest_type + " #institution" ).val();
                                            if(nein_quest){
                                                $(".div_for_survey_"+first_quest_type + ' .question_9_v1_p1_q1' ).slideUp(0);
                                                $(".div_for_survey_"+first_quest_type + ' .question_10_v1_p1_q2' ).slideDown(0);
                                                var ten_quest = $(".div_for_survey_"+first_quest_type + " #graduation_year_survey_3" ).val();
                                                if(ten_quest){

                                                    $(".div_for_survey_"+first_quest_type + ' .question_10_v1_p1_q2' ).slideUp(0);
                                                    $(".question_from_avatar").slideDown(0);
                                                    if ($("#user_avatar")[0].files.length != 0 ) {
                                                        $(".question_from_avatar").slideUp(0);
                                                        $(".btn_for_next_question").slideUp(0);
                                                        // ___________________________________
                                                        $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme.");
                                                        submitForm()
                                                    }
                                                }

                                            }
                                        }
                                    }else if (seven_quest_type == '2'){

                                        $(".div_for_survey_"+first_quest_type + ' .question_6_v3_q4' ).slideUp(0);
                                        $(".question_from_avatar").slideDown(0);
                                        if ($("#user_avatar")[0].files.length != 0 ){
                                                $(".question_from_avatar").slideUp(0);
                                                $(".btn_for_next_question").slideUp(0);
                                                // ___________________________________
                                                $('.div_for_thanks_message' ).append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme. ");
                                                submitForm()
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        })
        var windowheight = jQuery(window).height();
        jQuery(".signup-frm ").css("min-height", windowheight + 'px')
    });
    // signup - frm

    $('#date').change(function () {
       $(this).removeClass("placeholderclass");
    });

    function submitForm(){
        setTimeout(function(){
            $("#regForm").submit();
        }, 3000);
    }


    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // if(n == 0){
        //     $('#etape2_time').attr('access','true')
        //     time30(Number($('#etape2_time').html()))
        // }else{
        //     time30(Number($('#etape2_time').html()),true)
        // }
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        // if (n == (x.length - 1)) {
        //     document.getElementById("nextBtn").innerHTML = "Submit";
        // } else {
        //     document.getElementById("nextBtn").innerHTML = "Next";
        // }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    // var timesOut = '';
    // function time30(time = null,pause = false) {
    //     if (time == null){
    //         var time = 30
    //     }
    //     if ($('#etape2_time').attr('access') == 'true'){
    //         $('#etape2_time').attr('access','false')
    //         timeOut = setInterval(function(){
    //             time = time -1
    //             $('#etape2_time').text(time)
    //             if(time <= 0){
    //                 window.location.href = $("meta[name='url']").attr('content')+'/register';
    //             }
    //         }, 1000);
    //     }
    //     timesOut = timeOut
    //     if (pause){
    //         clearInterval(timesOut);
    //     }
    // }

    $('.pagination_button').click(function (e) {
        e.preventDefault();
    })

    function nextPrev(n) {

        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (!validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        if( currentTab == 0 ){
            if ($("#first_name").val() != undefined){
                var first_name = $("#first_name").val();
                var last_name = $("#last_name").val();
            } else{
                var first_name = $("#complete_first_name").val();
                var last_name = $("#complete_last_name").val();
            }

            $(".div_for_bonjour_name").html("Bonjour " + first_name + " " + last_name);


        //     $(".div_for_regForm_btns").slideUp(100);
        //     $(".div_for_survey_next").slideDown(100);
        }
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var passwordReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,50}$/;
        // A loop that checks every input field in the current tab:
        if (currentTab != 2){

            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }else{
                    $(y[i]).removeClass("invalid");
                }
                if ($(y[i]).attr('type') == 'email'){

                    if (!emailReg.test(y[i].value)) {
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }
                if($(y[i]).attr('type') == 'password'){
                    if (!passwordReg.test(y[i].value)) {
                        var text = "Désolée mais votre mot de passe ne correspond pas aux normes fixées par la RGPD, celui-ci doit contenir 12 caractères et inclure à minima une majuscule, une minuscule, un chiffre et un caractère spécial. Exemple : Parapluie68!"
                        $('.error_message').text(text)
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }

            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
<script>
    $(document).ready(function(){
        jQuery('.currently-working-wrp input[type=radio][name=Etes-vous-en-poste-actuellemen]').change(function() {
            if (this.value == 'Oui') {
                jQuery('.yes-i-am-working').show();
                jQuery('.no-i-am-working').hide();
            }
            else if (this.value == 'Non') {
                jQuery('.yes-i-am-working').hide();
                jQuery('.no-i-am-working').show();
            }
        });
        setTimeout(function(){
            $(".div_for_multiple>span").css({'width':'100%'})
        },500)
    });
</script>

@if(Session::get('linkdin'))
	<script>
        $(document).ready(function(){
            nextPrev(1)
        });
	</script>
@endif
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/custom/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/custom/wow.min.js') }}"></script>
<script src="{{ asset('js/custom/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/custom/custom.js') }}"></script>
<script src="{{ asset('js/admin/custom.js') }}"></script>

@toastr_js
@toastr_render
</html>