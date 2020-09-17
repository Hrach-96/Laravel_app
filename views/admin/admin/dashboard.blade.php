<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="token" content="{{ csrf_token() }}"/>
<meta name="url" content="{{ URL('/') }}"/>
<title>Datalumni</title>
<!-- jQuery library -->
@jquery
<!-- toastr library -->
@toastr_css
<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<!-- Custom -->
<link href="{{ asset('css/custom/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/custom-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/owl.theme.default.min.css') }}" rel="stylesheet">
<link rel="icon" href="{{asset('images/custom/favicon.png')}}" type="image/gif" sizes="16x16">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137180997-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137180997-1');
</script>
<div class="page-wrpper admin-home-page">
  <div class="home-banner class_for_480_height">
    <div class="owl-carousel owl-theme home-banner-slider">
      <div class="items">
        <img class="class_for_480_height" src="{{ asset('images/Schools/' . $AdminOfTheSchool->GetSchoolInfo->background_image) }}" title="top-header1.jpg" />
        <div class="home-banner-content">
          <h2 class="wow fadeInUp" data-wow-duration="1s">Hey <span>{{$user->first_name}}</span> Nice to see you</h2>
          <p class="wow fadeInUp" data-wow-duration="2s">Let's discover what's new in your network today</p>
        </div>
      </div>
    </div>
  </div>
  <header class="header home-header box-shadow">
    <div class="container-fluid container_fluid_for_responsive">
      <div class="profile-section">
        <div class="row align-items-center">
          <div class="col col-lg-12 m-auto">
            <ul class="profile-menu class_for_ul_responsive">
              <li> <a href="{{ route('admin.dashboard') }}" class="active">Accueil</a> </li>
              <li> <a href="{{ route('admin.blog') }}">Actualités</a> </li>
              <li> <a href="{{ route('admin.statistics') }}">Statistiques</a></li>
              <li> <a href="{{ route('admin.directory') }}">Annuaire</a> </li>
              <li> <a href="{{ route('admin.mentorship') }}">Mentorat</a> </li>
              <li> <a href="{{ route('admin.job-offer') }}">Emplois / stages</a></li>
              <li> <a href="{{ route('admin.emailing') }}" >Emailing</a> </li>
              <li class="dropdown-li">
	              <a href="{{ route('admin.profile') }}">
	              @if(!is_null($user->avatar))
		              <img class="mr-3 d-inline-block header_img" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
	              @else
		              <img class="mr-3 d-inline-block header_img" src="{{ asset('/images/avatar/default.jpg') }}" >
	              @endif
	              </a>
                <div class="dropdown-content">
                  <ul class="dropdown-content-list">
                    <li><a href="{{ route('admin.profile') }}">Profil</a></li>
                    <li><a href="#">Paramètres</a></li>
                    <li><a href="{{ route('admin.logout') }}">Se déconnecter</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div class="home-logo logo">
            <a href="{{ route('admin.dashboard') }}">
              <img style="height:100px" src="{{ asset('images/Schools/' . $AdminOfTheSchool->GetSchoolInfo->logo) }}" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>
  <style>
    /*Responsive Part*/
    @media only screen and (max-width: 1220px) and (min-width: 920px)  {
      .container_fluid_for_responsive{
        padding:0px 0px!important;
      }
      .class_for_ul_responsive li{
        margin-left:18px!important;
      }
    }
    @media only screen and (max-width: 920px) and (min-width: 620px) {
      .container_fluid_for_responsive{
        padding:0px 0px!important;
      }
      .class_for_ul_responsive li{
        margin-left:9px!important;
      }
      .class_for_ul_responsive li a{
       font-size:13px!important;
      }
    }
    @media only screen and (max-width: 620px) and (min-width: 450px) {
      .container_fluid_for_responsive{
        padding:0px 0px!important;
      }
      .class_for_ul_responsive li{
        margin-left:6px!important;
      }
      .class_for_ul_responsive li a{
        font-size:9px!important;
      }
    }
    @media only screen and (max-width: 500px) and (min-width: 310px)  {
      .class_for_ul_responsive li{
        margin-left: 5px!important;
      }
      .container_fluid_for_responsive{
        padding:0px 0px!important;
      }
      .class_for_ul_responsive li a{
        font-size:8px;
      }
    }
    @media only screen and (max-width: 1000px) and (min-width: 310px)  {
      .class_for_responsive_users_part{
        min-height:340px;
      }
    }
  </style>
  <main>
    <section class="section1 section">
      <div class="container-fluid">
{{--        <div class="section2 section1 bg-white mt-1 pt-1 pb-1 mb-4">--}}
{{--          <div  class="container-fluid">--}}
{{--            <h4>Vos réseaux</h4>--}}
{{--            <div class="col-md-3 col-lg-3 max-width-24">--}}
{{--              <img src="{{ asset('images/admin/bts.png') }}" class="img-responsive">--}}
{{--              <hr>--}}
{{--              <h5 class="text-center">BTS Management</h5>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-lg-3 max-width-24">--}}
{{--              <img src="{{ asset('images/admin/2.jpg') }}" class="img-responsive">--}}
{{--              <hr>--}}
{{--              <h5 class="text-center">Licence professionnelle création graphique</h5>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-lg-3 max-width-24">--}}
{{--              <img src="{{ asset('images/admin/3.png') }}" class="img-responsive">--}}
{{--              <hr>--}}
{{--              <h5 class="text-center">Master 1 Marketing digital</h5>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-lg-3 max-width-24">--}}
{{--              <img src="{{ asset('images/admin/4.png') }}" class="img-responsive">--}}
{{--              <hr>--}}
{{--              <h5 class="text-center"> Master 2 Webdesign</h5>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
        <div class="section1-wrp">
          <div class="section-title-wrp text-center">
            <h2 class="section-title">Ils ont récemment rejoint votre réseau </h2>
          </div>
        </div>
        <div class="section1-content">
          <div class="row">
            <div class="col-md-12 col-lg-6 pos-rel class_for_responsive_users_part">
              <div class="section1-content-left">
                <div class="top-profiles">
                  <div class="pf-hd">
                    <h3>Les derniers inscrits</h3>
                    <i class="la la-ellipsis-v"></i>
                  </div>
                  <div class="section1c-left-slider-wrp">
                    <div class="section1c-left-slider owl-carousel owl-theme">
                      @foreach($users as $user)
                        <?php $user = $user->GetUserInfo;  ?>
                        <div class="items">
                        <div class="sec1-cleftcol">
                          <div class="text-right mentor-tag">
                            @if($user->linkedin == \App\User::linkedin_login)
                                <small class="badge badge-info text-left f-left {{ $user->mentorat == \App\User::mentorat?'mt-1':'mr-3' }}">
                                  <a title="LinkedIn" href="https://www.linkedin.com/sales/gmail/profile/viewByEmail/{{ $user->email }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </small>
                            @endif
                            @if($user->mentorat == \App\User::mentorat)
                              <small class="badge badge-warning text-left f-left mr-3">MENTOR</small>
                            @endif
                          </div>

                        @if(!is_null($user->avatar))
                            <img  class="image-circle-cus" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
                          @else
                            <img  class="image-circle-cus"  src="{{ asset('/images/avatar/default.jpg') }}" >
                          @endif
                          <h3>{{$user->first_name}} {{$user->last_name}}</h3>
                          <span class="mb-0   ">
                            @if($user->chooseColor)
                              @if($user->chooseColor->category)
                                {{$user->chooseColor->category->title}}
                              @endif
                            @endif
                          </span>
                          <span class="mb-0 ">
                            @if($user->chooseDegree)
                              @foreach($user->chooseDegree as $degrees)
                                @if($degrees->degree)
                                  {{$degrees->degree->name}}
                                @endif
                              @endforeach
                            @endif
                          </span>
                          <span class="text-center mb-0" style="font-size:12px;">{{($user->GetGraduationYear)?$user->GetGraduationYear->year:''}}</span>
                          <p class="text-center" style="font-size:12px;">{{$user->city}}</p>
                            <ul class="ul_followw">
                              <li><a href="{{ route('admin.user.profile',['id' => $user->id]) }}" title="" class="followw" tabindex="-1">Profile</a></li>
                              <li> <a href="mailto:{{$user->email}}" title="" class="envlp" tabindex="-1"><img src="{{ asset('images/custom/envelop.png') }}" alt=""></a> </li>
                            </ul>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6">
              <div class="section1-content-right">
                <div class="card">
                  <div class="card-header">
                    <h4>Les derniers matchs de mentor</h4>
                  </div>
                  <div class="card-body">
                    <div class="todo-list todo-list-hover todo-list-divided">
                      <div class="todo todo-default">
                        <div class="section1-content-right-wrp " style="min-height: 198px">
                          <div class="row text-center justify-content-center1 mt-2">
                            <div class="col-sm-6 ">
                              <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                  @if(!empty($mentors[0]))
                                  <div class="matches-images-col pr-2">
                                    <div class="matches-image">
                                      @if(!is_null($mentors[0]->avatar))
                                        <img  src="{{ asset('/images/avatar/'.$mentors[0]->avatar) }}" >
                                      @else
                                        <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                      @endif
                                    </div>
                                    <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[0]->first_name }}</div>
                                  </div>
                                  @endif
                                  @if(!empty($mentors[1]))
                                      <div class="matches-images-col pr-2">
                                        <div class="matches-image">
                                          @if(!is_null($mentors[1]->avatar))
                                            <img  src="{{ asset('/images/avatar/'.$mentors[1]->avatar) }}" >
                                          @else
                                            <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                          @endif
                                        </div>
                                        <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[1]->first_name }}</div>
                                      </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                  @if(!empty($mentors[2]))
                                    <div class="matches-images-col pr-2">
                                      <div class="matches-image">
                                        @if(!is_null($mentors[2]->avatar))
                                          <img  src="{{ asset('/images/avatar/'.$mentors[2]->avatar) }}" >
                                        @else
                                          <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                        @endif
                                      </div>
                                      <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[2]->first_name }}</div>
                                    </div>
                                  @endif
                                    @if(!empty($mentors[3]))
                                    <div class="matches-images-col pr-2">
                                      <div class="matches-image">
                                        @if(!is_null($mentors[3]->avatar))
                                          <img  src="{{ asset('/images/avatar/'.$mentors[3]->avatar) }}" >
                                        @else
                                          <img   src="{{ asset('/images/avatar/default.jpg') }}" >
                                        @endif
                                      </div>
                                      <div class="text-center mt-2 mb-2" style="margin-left:10px">{{ $mentors[3]->first_name }}</div>
                                    </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section2 section bg-white pt-4 mt-5 pb-5">
      <div class="container-fluid">
        <div class="section2-wrp">
          <div class="section-title-wrp text-center">
            <h2 class="section-title">Les dernières actualités de mon réseau</h2>
          </div>
          <div class="section2-content section_class">
            <div class="row">
              <div class="col-md-6 pos-rel">
                <div class="card">
                  <div class="card-header">
                    <h4>A la une</h4>
                  </div>
                  <div class="card-body">
                    <div class="todo-list todo-list-hover todo-list-divided">
                      <div class="todo todo-default">
                        <div class="row">
                          @if($blog_posts->count() > 0)
                            @foreach($blog_posts as $blog_post)
                              <div class="col-md-12 pl-2 pm-2">
                                <div  class="row mb-2">
                                  <div class="col-md-2">
                                    <img src="{{ asset('images/Blogs/' . $blog_post->GetBlogInfo->image) }}" class="img-responsive img-circle rounded-circle" alt="">
                                  </div>
                                  <div class="col-md-10">
                                    <h4><strong>{{ $blog_post->GetBlogInfo->title }}</strong></h4>
                                    <?php
                                    $blog_content = $blog_post->GetBlogInfo->content;
                                    $blog_length = strlen($blog_content);
                                    $blog_len = $blog_length;
                                    if (strlen($blog_content) > 200){
                                      $blog_length = strlen($blog_content);
                                      for ($i=200; $i<220; $i++) {
                                        if ($blog_content[$i] == '<' && $blog_content[$i+1] == "/"){
                                          for ($j=$i; $j<$blog_length; $j++) {
                                            if ($blog_content[$j] == '>'){
                                              if ($blog_len != $blog_length){
                                                break;
                                              }
                                              $blog_len = $j+1;

                                            }
                                          }

                                        }
                                      }

                                    } if ($blog_length < 200){ ?>
                                    <div class="blog_content  container text-dark w-100">
                                      {!! $blog_content !!}
                                      <br>
                                      <a href="{{route('user.BlogInfo' , ['id' => $blog_post->GetBlogInfo->id ])}}">Lire plus</a>
                                    </div>
                                    <?php }else{
                                    if ($blog_length == $blog_len ){
                                      $teg = '';
                                      $teg_i = 0;
                                      for ($i=0; $i<200; $i++) {
                                        if ($blog_content[$i] == "<"){
                                          for ($j=$i; $j<200; $j++){
                                            if ($blog_content[$j] == " "){
                                              $teg_i = $j;
                                              $teg = substr($blog_content,$i+1,$j-$i-1);
                                            }
                                          }
                                        }
                                      }
                                      $blog_str = substr($blog_content,0, 1000);
                                      $blog_str = "</".$teg.">";

                                    }else{
                                      $blog_str = substr($blog_content,0, $blog_len);
                                    }
                                    ?>
                                    <div class="blog_content  container text-dark w-100">
                                      {!! $blog_str !!}
                                      <br>
                                      <a href="{{route('user.BlogInfo' , ['id' => $blog_post->GetBlogInfo->id ])}}">Lire plus</a>
                                    </div>
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  {{--                @if(count($BlogPost) > 3)--}}
                  {{--                  <div class="col-sm-12 sec3-content-btn-wrp mt-3 text-right mb-2">--}}
                  {{--                    <a href="#" class="btn btn-theme text-white">voir plus</a>--}}
                  {{--                  </div>--}}
                  {{--                @endif--}}
                </div>
              </div>
              <div class="col-md-6 pos-rel">
                <div class="section2-content-right section_full">
                  <div class="card">
                    <div class="card-header">
                      <h4>Dernières activités Linkedin</h4>
                    </div>
                    <div class="card-body">
                      <div class="todo-list todo-list-hover todo-list-divided">
                        <div class="todo todo-default flex-column">
                          <div class="row">

                            @foreach($blogs as $key => $blog)
                              @if($user = $blog->GetUsersOfBlog->user)
                                <div class="col-md-12 pl-2 pm-2">
                                  <div >
                                    <div class="d-flex mb-2">
                                      <?php $avatar = ($blog->GetUsersOfBlog->user->avatar)?$blog->GetUsersOfBlog->user->avatar:'default.jpg' ?>
                                      <img src="{{ asset('/images/avatar/' . $avatar) }}" class="linkedin_avatar img-responsive img-circle" alt="">
                                      <div class="linkedin_padding">
                                        <span><h5 class="text-dark font-weight-bold">{{$user->first_name}}  {{$user->last_name}}</h5></span>
                                        <span class="com-status bage-warning">{{$blog->title}}</span>
                                        <?php
                                        if ( $blog->created_at->diffInSeconds() < 59) {
                                          $time = $blog->created_at->diffInSeconds().'s';
                                        }else if($blog->created_at->diffInMinutes() < 59){
                                          $time = $blog->created_at->diffInMinutes().'m';
                                        }else if($blog->created_at->diffInHours() < 24){
                                          $time = $blog->created_at->diffInHours().'h';
                                        }else{
                                          $time = $blog->created_at->diffInDays().'d';
                                        }

                                        ?>
                                        <span>{{ $time }}  {{ ($blog->created_at != $blog->updated_at)?'● Modifié':'' }}</span>
                                      </div>
                                    </div>
                                    <?php

                                    $content = $blog->content;
                                    $length = strlen($content);
                                    $len = $length;
                                    if (strlen($content) > 100){
                                      $length = strlen($content);
                                      for ($i=100; $i<$length; $i++) {
                                        if ($content[$i] == '<' && $content[$i+1] == "/"){
                                          for ($j=$i; $j<$length; $j++) {
                                            if ($content[$j] == '>'){
                                              if ($len != $length){
                                                break;
                                              }
                                              $len = $j+1;

                                            }
                                          }

                                        }
                                      }
                                    }
                                    if ($length < 100){ ?>
                                    <div class="blog_content container text-dark w-100">
                                      {!! $content !!}
                                      <br>
                                      <a href="{{route('admin.BlogInfo' , ['id' => $blog_post->GetBlogInfo->id ])}}">Lire plus</a>

                                    </div>
                                    <?php }else{
                                    $str = substr($content,0, $len);
                                    ?>
                                    <div class="blog_content container text-dark w-100">{!! $str !!}
                                      <br>
                                      <a  href="{{route('admin.BlogInfo' , ['id' => $blog->id ])}}">...Voir Plus</a>
                                    </div>
                                    <?php } ?>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          </div>
                          <div class="col-sm-12 sec3-content-btn-wrp mt-3 text-right">
                            <a href="{{ route('admin.blog') }}" class="btn btn-theme text-white">Voir plus</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section3 section bg-white">
      <div class="container-fluid">
        <div class="section3-wrp">
          <div class="section-title-wrp text-center">
            <h2 class="section-title">Statistiques</h2>
          </div>
        </div>
        <div class="sec3-content">
          <div class="">
            <div class="sec3-content-left">
              <div class="card">
                <div class="card-body">
                  <div class="todo-list todo-list-hover todo-list-divided">
                    <div class="todo todo-default">
                      <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                          <h4 style="font-size: 20px;" class="text-center mb-4">Temps de recherche du premier emploi</h4>
                          <img src="{{ asset('images/custom/grahp-img1.png') }}" />
                        </div>
                        <div class="col-md-4 text-center">
                          <h4 style="font-size: 20px;" class="text-center mb-4">Secteur d'activité</h4>
                          <img src="{{ asset('images/custom/grahp-img2.png') }}" />
                        </div>
                        <div class="col-md-4 text-center">
                          <h4 style="font-size: 20px;" class="text-center mb-4">Pourcentage de comptes activés</h4>
                          <img src="{{ asset('images/custom/grahp-img3.png') }}" />
                        </div>
                        <div class="col-sm-12 sec3-content-btn-wrp mt-3 text-right">
                          <a href="#" class="btn btn-theme" >voir plus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section4-adminhome section">
      <div class="container-fluid">
        <div class="section-title-wrp text-center">
          <h2 class="section-title">Dernières offres d'emploi</h2>
        </div>
        <div class="jobofferpg-post-start-wrp">
          <div class="row jobofferpg-post-wrp more_content">
            @foreach($jobs as $job)
            <div class="jobofferpg-post-col col-lg-6">
              <div class="jobofferpg-post-col-wrp d-flex bg-white box-shadow p-4">
                <div class="jobofferpg-post-img">
                  <img src="{{asset('images/job/' . $job->logo)}}">
                </div>
                <div class="jobofferpg-post-content pl-3">
                  <h6 class="jobofferpg-post-title mb-2">{{ $job->title }}</h6>
{{--                  <p class="mb-1"><span>CDI</span> </p>--}}
                  @if($job->chooseUser)
                  <p class="mb-1">Auteur: {{ $job->chooseUser->first_name }} {{ $job->chooseUser->last_name }}</p>
                  @endif
                </div>
                <div class="jobofferpg-post-btnc ml-auto">
                  <div class="jobofferpg-post-btnc-wrp d-flex align-items-end flex-column ">
                    <div class="jobofferpg-post-date text-right mb-auto">{{ date('d M, Y',strtotime($job->created_at)) }}</div>
                    @if($job->status == \App\JobBoard::status_active)
                      <small class="badge badge-success ">Active</small>
                    @else
                      <small class="badge badge-danger ">Inactive</small>
                    @endif
                    <div class="jobofferpg-post-btnc-wrp  align-center">
                      <div class="d-flex mt-3 align-items-center">
                        <div class="jobofferpg-post-btnc-icon mb-1 mr-3">
                          <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="jobofferpg-post-btn">
                          <a href="#" class="btn btn-theme">Consulter</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @if($jobs->lastPage() > 1)
            <div class="mt-3 text-right">
              <a class="btn btn-theme VoirPlus" data_url="{{ urlencode($jobs->nextPageUrl()) }}"  count="{{ $jobs->lastPage() }}">Voir plus</a>
            </div>
          @endif
        </div>
      </div>
    </section>
  </main>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="{{ asset('js/custom/wow.min.js') }}"></script>
<script src="{{ asset('js/custom/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/custom/custom.js') }}"></script>
<script src="{{ asset('js/admin/custom.js') }}"></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- datatable -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
<!-- toastr library -->
@toastr_js
@toastr_render