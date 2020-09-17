@extends('admin_inc.template')
@section('content')
<main>
    <div class="directory-pg jbpgs">
        <div class="container-fluid">
            <div class="directory-pg-wrp jbpgs-wrp">
                <div class="jbpgs-searchbox">
                    <form action="{{ route('admin.directory') }}" method="get">
                        <div class="jbpgs-searchbox-wrp m-auto bg-white box-shadow">
                            <div class="row p-2 jbpgs-searchbox-row align-items-center">
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <input type="text" class="form-control pt-1 border-0" value="{{ $free_search }}"  name="free_search" placeholder="Mot clé">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0" name="degree">
                                                <option value="">Cursus</option>
                                                @foreach(App\Degree::all() as $degree)
                                                    <option {{ $degrees == $degree->name?'selected':''  }}>{{ $degree->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <select name="year_of_graduation" id="graduation_year" class='form-control   pt-1 border-0' >
                                            <option value="" >Promotion</option>
                                            @foreach(App\GraduationYear::all() as $graduation_year)
                                                <option {{ $year_of_graduation == $graduation_year->year?'selected':''  }}>{{$graduation_year->year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0" name="category">
                                                <option value="">Catégorie</option>
                                                @foreach(App\Category::all() as $category)
                                                    <option {{ $categorys == $category->title?'selected':'' }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0" name="job">
                                                <option value="">Poste</option>
                                                @foreach(App\JobBoard::all() as $job)
                                                    <option {{ $jobs == $job->title?'selected':'' }}>{{ $job->title }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col ">
                                        <button class="btn btn-theme btn-block ">Rechercher</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <section class="jbpgs-post-start m-auto pb-5">
                    <div>
                        <div class="d-flex mb-4 pb-3 align-items-center">
                            <div class="">
                                <a href="{{ route('admin.new-user') }}" class="btn btn-theme">Add new user</a>
                            </div>
                            <div class="ml-2">
                                <a href="{{ route('admin.user-csv') }}" class="btn btn-theme">Exporter</a>
                            </div>
                        </div>
                    </div>
                    <div class="row jbpgs-post-start-row more_content">
                        @foreach($users as $user)
                        <div class="col-sm-3 jbpgs-post-start-col">
                            <div class="jbpgs-post-start-col-wrp bg-white" style="min-height:420px;box-shadow: 0 0 10px {{ ($user_id != $user->id)?($user->chooseColor)?$user->chooseColor->category->color:'rgba(0, 0, 0, 0.2)':'#00a19b' }};">
                                <div class="jbpgspost-col-img">
                                    @if(is_null($user->avatar))
                                        <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle" alt="">
                                    @else
                                        <img src="{{ asset("images/avatar/$user->avatar") }}" class="img-responsive img-circle" alt="">
                                    @endif
                                </div>
                                <div class="jbpgs-post-start-content p-4">
                                    @if($user->linkedin == \App\User::linkedin_login)
                                        <small class="badge badge-info {{ $user->mentorat == \App\User::mentorat?'par-70':'par-10' }}">
                                            <a title="LinkedIn" href="https://www.linkedin.com/sales/gmail/profile/viewByEmail/{{ $user->email }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                                        </small>
                                    @endif
                                    @if($user->mentorat == \App\User::mentorat)
                                        <small class="badge badge-warning ">MENTOR</small>
                                    @endif
                                    <h4 class="jbpgs-post-start-title text-center">{{$user->first_name}} {{$user->last_name}} <br>{{(isset(App\CategoryOfTheUser::where('user_id',$user->id)->first()->category->title))? App\CategoryOfTheUser::where('user_id',$user->id)->first()->category->title : ""}} </h4>
                                    <div class="jbpgs-post-start-col-row text-center">
                                         <span class="">
                                            <p class="d-inline-block mb-0">
                                              @if($user->chooseDegree)
                                                    @foreach($user->chooseDegree as $degrees)
                                                        @if($degrees->degree)
                                                            {{$degrees->degree->name}} ,
                                                        @endif
                                                    @endforeach
                                                @endif
                                                {{($user->GetGraduationYear)?$user->GetGraduationYear->year:''}}
                                            </p>
                                              <br><br>
                                            <p class="d-inline-block mb-0">
                                                @if(isset($user->city))
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{$user->city}}
                                                @endif
                                            </p>
                                          </span>
                                    </div>
                                    <div class="badge1 badg1e-action text-center ml-0 pl-0 mt-2">
                                        <ul>
                                            <li><a href="{{ route('admin.user.profile',['id' => $user->id]) }}" title="" class="followw" tabindex="-1">Profile</a></li>
                                            <li> <a href="mailto:{{$user->email}}" title="" class="envlp" tabindex="-1"><img src="{{ asset('images/custom/envelop.png') }}" alt=""></a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($users->lastPage() > 1)
                        <?php $url = (request()->fullUrl() == url()->current())?'?':'&'; ?>
                        <div class="jobofferpg-post-btn text-center">
                            <a class="btn btn-theme VoirPlus" data_url="{{ urlencode(request()->fullUrl().''.$url.'page='.(int)($users->currentPage()+1)) }}"  count="{{ $users->lastPage() }}">Voir plus</a>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
