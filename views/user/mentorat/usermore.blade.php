@foreach($users as $user)
    <div class="col-sm-3 jbpgs-post-start-col" style="display: none">
        <div class="jbpgs-post-start-col-wrp bg-white"  style="box-shadow: 0 0 10px {{ ($user->chooseColor)?$user->chooseColor->category->color:'rgba(0, 0, 0, 0.2)' }};">
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
                        <li><a href="{{ route('user.user.profile',['id' => $user->id]) }}" title="" class="followw" tabindex="-1">Profile</a></li>
                        <li> <a  href="mailto:{{$user->email}}" title="" class="envlp" tabindex="-1"><img src="{{ asset('images/custom/envelop.png') }}" alt=""></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach