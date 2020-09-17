@extends('admin_inc.template')
@section('content')
<main>
    <div class="profilepg-content">
        <section class="profilepg-sec">
            <div class="container-fluid">
                <div class="propg-sec-wrp box-shadow bg-white">
                    <div class="propg-proimg">
                        @if(!is_null($user->avatar))
                            <img  class="profile_img pointer" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
                        @else
                            <img  class="profile_img pointer" src="{{ asset('/images/avatar/default.jpg') }}" >
                        @endif
                        <input type="file" id="avatar_file" class="d-none">
                    </div>
                    <div class="propg-content">
                        <div >
                            <div >
                                <div class="propg-content-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="propg-content-left-tp">
                                                <div class="propg-usename-row">
                                                    <h3 class="d-inline-block mb-3 pointer">
                                                        <i class="mr-2 text-warning propg-usename fa fa-edit"></i>
                                                        <span class="span_for_name">{{ $user->first_name }} {{ $user->last_name }}</span>
                                                    </h3>

                                                    <div class="d-none edit_username">
                                                        <input type="text" class="form-control w-25 first d-inline-block" value="{{ $user->first_name }}" placeholder="First Name">
                                                        <input type="text" class="form-control w-25 last d-inline-block" value="{{ $user->last_name }}" placeholder="Last Name">
                                                        <button class="btn save_edit_name"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                                    </div>
                                                    @if($user->mentorat == \App\User::mentorat)
                                                        <small class="badge badge-warning ">MENTOR</small>
                                                    @endif
	                                                @if($user->linkedin == \App\User::linkedin_login)
		                                                <small class="badge badge-info">
			                                                <a title="LinkedIn" href="https://www.linkedin.com/sales/gmail/profile/viewByEmail/{{ $user->email }}" target="_blank"><i class="fa fa-linkedin"></i></a>
		                                                </small>
	                                                @endif
                                                    <span class="ml-3 pointer"><i class="fa fa-map-marker" aria-hidden="true"></i><i class="ml-1 propg-location text-warning fa fa-edit"></i> <span class="span_for_city">{{$user->city}}</span></span>
                                                    <div class="d-none edit_city">
                                                        <input type="text" id="city" class="form-control w-25 city d-inline-block" value="{{ $user->city }}" placeholder="City">
                                                        <button class="btn save_edit_city"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                                    </div>
                                                    <br/>
                                                    @if(!empty($company_name) && ($what_function_copy && $company_name))
                                                        <p>{{$what_function_copy}} à {{ $company_name }}</p>
                                                    @endif
                                                    <br>
                                                    <span>
                                                        @if(!empty($degree_of_user) && $degree_of_user != '' )
                                                            {{$degree_of_user->degree->name}}
                                                        @endif
                                                    </span>
                                                    <span  class="d-inline-block mb-3 pointer"><i class="ml-1 text-warning fa fa-edit propg-year"></i> <i class="fa fa-graduation-cap" aria-hidden="true"></i> <span class="span_for_year"> {{$user->GetGraduationYear?$user->GetGraduationYear->year:''}} </span> </span>

                                                    {{--                                                    <span  class="d-inline-block propg-year mb-3 pointer"> <i class="fa fa-calendar" aria-hidden="true"></i> {{$user->GetGraduationYear?$user->GetGraduationYear->year:''}}</span>--}}
                                                    <div class="d-none edit_graduation_year">
                                                        <select class="form-control w-25 year d-inline-block" required="">
                                                            <option value="" selected="" disabled="" >Promotion</option>
                                                            @php
                                                                $graduation_year_id = ($user->GetGraduationYear)?$user->GetGraduationYear->id:'';
                                                            @endphp
                                                            @foreach(App\GraduationYear::all() as $year)
                                                                <option value="{{$year->id}}" {{ $graduation_year_id ==  $year->id?'selected':''}}>{{$year->year}}</option>
                                                            @endforeach
                                                        </select>
                                                        <button class="btn save_edit_year"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                                    </div>
{{--                                                        <span>{{ $user->email }}</span>--}}
                                                </div>
                                            </div>
                                        </div>
	                                    <div class="col-md-12">
		                                    <div class="propg-content-left-tp mt-2">
			                                    <div class="propgclo-connnet d-flex align-items-center">
                                                    @if($user->id != $user_id)
				                                    <div class="propgclo-connnet-s-messages"><a href="mailto:{{$user->email}}"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="ml-3">Send Messages</span></a></div>
                                                    @endif
                                                    @if($user->type == \App\User::user)
                                                        @if($user->mentorat == \App\User::not_mentorat)
                                                        <div class="propgclo-connnet-contact mx-3 p-2">
                                                            <a href="{{ route('user.add.mentorat',['id' => $user->id]) }}">
                                                                <div class="propgclo-connnet-contact-wrp">
                                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                                    <span class="ml-2">Solliciter comme mentor</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        @endif
                                                    @endif
			                                    </div>
		                                    </div>
	                                    </div>
                                    </div>
                                    <div class="propgcl-mr">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10">
                                                <div class="propgcl-mr-row propgcl-mr-left-work-wrp">
                                                    {{--                                                        <h5 class="my-4 font-weight-light"><i class="fa fa-info" aria-hidden="true"></i>  Information--}}
                                                    {{--                                                            <a href="{{ route('user.edit-profile') }}" class="float-right"><i class="fa fa-edit"></i></a>--}}
                                                    {{--                                                        </h5>--}}
                                                    <h5 class="my-4 font-weight-light"><i class="fa fa-info" aria-hidden="true"></i>  Information <h5>
                                                        <a href="{{ route('admin.remove-user-profile', ['id' => $user->id]) }}" class="float-right"><i class="fa fa-trash"></i> Delete Account</a>
                                                    </h5>
                                                    <h5 class="my-4 font-weight-light"><i class="fa fa-briefcase" aria-hidden="true"></i>  Expériences
                                                        {{--<a href="#" class="float-right"><i class="fa fa-edit"></i></a>--}}
                                                        {{--<a href="#"  data-toggle="modal" data-target="#ModalExperience" class="btn btn-outline-warning">Ajouter une expérience</a>--}}
                                                    </h5>
                                                    @if(!empty($what_function_copy) && $what_function_copy)
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                            <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                            <div class="propgcl-mr-right">
                                                                <h6>{{$what_function_copy}}</h6>
                                                                {{--                                                                    <p class=" mt-0">Datalumni</p>--}}
                                                                {{--                                                                    <p class="mb-2">Oct 2018 – Present</p>--}}
                                                                <p>{{ $company_name }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @foreach( App\UserExpeience::where('user_id',$user->id)->get() as $UserExpeience )
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                            <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                            <div class="propgcl-mr-right">
                                                                <h6> {{$UserExpeience->name}}</h6>
                                                                <p class=" mt-0">{{$UserExpeience->GetCompanyInfo->name}}</p>
                                                                <p class="mb-2">{{date('d-m-Y', strtotime($UserExpeience->start_date))}}- {{date('d-m-Y', strtotime($UserExpeience->end_date))}} </p>
                                                                <p class=" mt-0"> {{$UserExpeience->description}}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10 col-md-6 mt-4">
                                                <div class="propgcl-mr-row propgcl-mr-qualification">
                                                    <h5 class="mb-4 font-weight-light"> <i class="fa fa-graduation-cap" aria-hidden="true"></i> Formation
                                                        {{--<a href="#" class="float-right"><i class="fa fa-edit"></i></a>--}}
                                                        {{--<a href="#"  data-toggle="modal" data-target="#ModalFormation" class="btn btn-outline-warning">Ajouter une formation</a>--}}
                                                    </h5>
                                                    @foreach( App\UserFormation::where('user_id',$user->id)->get() as $UserFormation )
                                                        <div class="propgcl-mr-row-inner-row mb-3 align-top">
                                                            <div class="propgcl-mr-left d-inline-block mr-2"><i class="fa fa-book" aria-hidden="true"></i></div>
                                                            <div class="d-inline-block align-top"  style="width: 90%">
                                                                <h6>{{$UserFormation->name_of_formation}}</h6>
                                                                <p class="mb-0">{{$UserFormation->GetFacilityName->name}}</p>
                                                                <p class="mb-2">{{$UserFormation->GetGraduationYear->year}}</p>
                                                                <p class="mb-2">{{$UserFormation->city_of_formation}}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-10 mt-4 col-md-10">
                                                <div class="propgcl-mr-row propgcl-mr-left-work-wrp">
                                                    <h5 class="my-4 font-weight-light"><i class="fa fa-music" aria-hidden="true"></i> Centres d'intérêt
                                                        {{--<a href="#" class="float-right"><i class="fa fa-edit"></i></a>--}}
                                                        {{--<a href="#" data-toggle="modal" data-target="#ModalHobby" class="btn btn-outline-warning">Ajouter un hobby</a>--}}
                                                    </h5>

                                                    @foreach( App\UserHobby::where('user_id',$user->id)->get() as $UserHobby )
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-2">
                                                            {{$UserHobby->hobby}}
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="propgcl-mr">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10">
                                                <div class="propgcl-mr-row propgcl-mr-left-work-wrp">
                                                    <h5 class="my-4 font-weight-light"><i class="fa fa-info" aria-hidden="true"></i>  Information</h5>
                                                    <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                        <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                        <div class="propgcl-mr-right">
                                                            <h6>Job offer posted</h6>
                                                            <p class=" mt-0">
                                                                @foreach($user->myJob as $job)
                                                                    <span class="border p-1">{{$job->title}}</span>
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                        <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                        <div class="propgcl-mr-right">
                                                            <h6> Blog post posted </h6>
                                                            <p class=" mt-0">
                                                                @foreach($user->myBlog  as $blog)
                                                                    @if($blog->blog)
                                                                        <span class="border p-1">{{$blog->blog->title}}</span>
                                                                    @endif
                                                                @endforeach
                                                            </p>
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
    </div>
</main>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvvqgc0KhI8v-1cqDl2lbDpy12TFVKe_U&libraries=places&callback=initAutocomplete"async defer></script>
<script>
    function initAutocomplete() {
        var input = document.getElementById('city');
        var opts = {
            types: ['(cities)']
        };
        new google.maps.places.Autocomplete(input, opts);

    }
</script>
@endsection