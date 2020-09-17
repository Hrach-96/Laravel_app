@foreach($users as $user)
    <div class="col-sm-3 jbpgs-post-start-col" style="display: none">
        <div class="jbpgs-post-start-col-wrp bg-white "  style="min-height:420px;box-shadow: 0 0 10px {{ ($user_id != $user->id)?($user->chooseColor)?$user->chooseColor->category->color:'rgba(0, 0, 0, 0.2)':'#00a19b' }};">
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
                <h4 class="jbpgs-post-start-title text-center">{{$user->first_name}} {{$user->last_name}} <br> {{(isset(App\CategoryOfTheUser::where('user_id',$user->id)->first()->category->title))? App\CategoryOfTheUser::where('user_id',$user->id)->first()->category->title : ""}}</h4>
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