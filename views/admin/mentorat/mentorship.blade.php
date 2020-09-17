@extends('admin_inc.template')
@section('content')
    <main>
        <div class="directory-pg jbpgs">
            <div class="container-fluid">
                <div class="directory-pg-wrp jbpgs-wrp">
                    <div class="jbpgs-searchbox">
                        <form action="{{ route('admin.mentorship') }}" method="get">
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
                                <div class="ml-2">
                                    <a href="{{ route('admin.mentor-csv') }}" class="btn btn-theme">Exporter</a>
                                </div>
                            </div>
                        </div>
                        <div class="row jbpgs-post-start-row more_content">
                            @foreach($users as $user)
                                <div class="col-sm-3 jbpgs-post-start-col">
                                    <div class="jbpgs-post-start-col-wrp bg-white "  style="box-shadow: 0 0 10px {{ ($user->chooseColor)?$user->chooseColor->category->color:'rgba(0, 0, 0, 0.2)' }};">
                                        <div class="jbpgspost-col-img">
                                            @if(is_null($user->avatar))
                                                <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle" alt="">
                                            @else
                                                <img src="{{ asset("images/avatar/$user->avatar") }}" class="img-responsive img-circle" alt="">
                                            @endif
                                        </div>
                                        <div class="jbpgs-post-start-content p-4">
                                            @if($user->linkedin == \App\User::linkedin_login)
                                                <small class="badge badge-info par-70">
                                                    <a title="LinkedIn" href="https://www.linkedin.com/sales/gmail/profile/viewByEmail/{{ $user->email }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                </small>
                                            @endif
                                            <small class="badge badge-warning ">MENTOR</small>
                                            <h4 class="jbpgs-post-start-title text-center">{{$user->first_name}} {{$user->last_name}}</h4>
                                            <div class="jbpgs-post-start-col-row text-center">
                                              <span class="">
                                                <p  class="d-inline-block mb-0">
                                                    @if($user->chooseColor)
                                                        @if($user->chooseColor->category)
                                                            {{$user->chooseColor->category->title}}
                                                        @endif
                                                    @endif
                                                </p>
                                                <br />
                                                <p class="d-inline-block mb-0">
                                                  @if($user->chooseDegree)
                                                        @foreach($user->chooseDegree as $degrees)
                                                            @if($degrees->degree)
                                                                {{$degrees->degree->name}}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </p>
                                                  <br>
                                                <p class="d-inline-block mb-0">{{($user->GetGraduationYear)?$user->GetGraduationYear->year:''}}</p>
                                                <br />
                                                <p class="d-inline-block mb-0">{{$user->city}}</p>
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
        <section class="mentorship_last-sec py-5 bg-white">
            <div class="container-fluid">
                <div class="section-title-wrp text-center">
                    <h2 class="section-title">Les derniers matchs de mentor</h2>
                </div>
                <div class="section1-content-right-wrp ">
                    <div class="row text-center justify-content-center1 mt-2">
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        @if(isset($mentors[0]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[0]->avatar))
                                                   <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle" alt="">
                                                @else
                                                   <img src="{{ asset("images/avatar/" . $mentors[0]->avatar)}}" class="img-responsive img-circle" alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:10px">{{$mentors[0]->first_name}}</div>
                                        @endif
                                    </div>
                                    <div class="matches-images-col">
                                        @if(isset($mentors[1]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[1]->avatar))
                                                    <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle" alt="">
                                                @else
                                                    <img src="{{ asset("images/avatar/" . $mentors[1]->avatar)}}" class="img-responsive img-circle" alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:0px">{{$mentors[1]->first_name}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        @if(isset($mentors[2]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[2]->avatar))
                                                    <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle " alt="">
                                                @else
                                                    <img src="{{ asset("images/avatar/" . $mentors[2]->avatar)}}" class="img-responsive img-circle " alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:10px">{{$mentors[2]->first_name}}</div>
                                         @endif
                                    </div>
                                    <div class="matches-images-col">
                                        @if(isset($mentors[3]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[3]->avatar))
                                                    <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle " alt="">
                                                @else
                                                    <img src="{{ asset("images/avatar/" . $mentors[3]->avatar)}}" class="img-responsive img-circle " alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:10px">{{$mentors[3]->first_name}}</div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        @if(isset($mentors[4]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[4]->avatar))
                                                    <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle " alt="">
                                                @else
                                                    <img src="{{ asset("images/avatar/" . $mentors[4]->avatar)}}" class="img-responsive img-circle " alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:10px">{{$mentors[4]->first_name}}</div>
                                        @endif
                                    </div>
                                    <div class="matches-images-col">
                                        @if(isset($mentors[5]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[5]->avatar))
                                                    <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle " alt="">
                                                @else
                                                    <img src="{{ asset("images/avatar/" . $mentors[5]->avatar)}}" class="img-responsive img-circle " alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:10px">{{$mentors[5]->first_name}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="matches-images">
                                <div class="d-flex justify-content-center">
                                    <div class="matches-images-col pr-2">
                                        @if(isset($mentors[6]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[6]->avatar))
                                                    <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle " alt="">
                                                @else
                                                    <img src="{{ asset("images/avatar/" . $mentors[6]->avatar)}}" class="img-responsive img-circle " alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:10px">{{$mentors[6]->first_name}}</div>
                                        @endif
                                    </div>
                                    <div class="matches-images-col">
                                        @if(isset($mentors[7]))
                                            <div class="matches-image">
                                                @if(is_null($mentors[7]->avatar))
                                                    <img src="{{ asset("images/avatar/default.jpg") }}" class="img-responsive img-circle " alt="">
                                                @else
                                                    <img src="{{ asset("images/avatar/" . $mentors[7]->avatar)}}" class="img-responsive img-circle " alt="">
                                                @endif
                                            </div>
                                            <div class="text-center mt-2 mb-2" style="margin-left:10px">{{$mentors[7]->first_name}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
