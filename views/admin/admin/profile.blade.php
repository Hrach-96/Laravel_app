@extends('admin_inc.template')
@section('content')
<main>
    <div class="profilepg-content">
        <section class="profilepg-sec">
            <div class="container-fluid">
                <div class="propg-sec-wrp box-shadow bg-white">
                    <div class="propg-proimg">
                        @if(!is_null($user->avatar))
                            <img class="profile_img pointer" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
                        @else
                            <img class="profile_img pointer" src="{{ asset('/images/avatar/default.jpg') }}" >
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
                                                        <i class="mr-2 text-warning propg-usename fa fa-edit"></i> <span class="span_for_name">{{ $user->first_name }} {{ $user->last_name }}</span>
                                                    </h3>
                                                    <div class="d-none edit_username">
                                                        <input type="text" class="form-control w-25 first d-inline-block" value="{{ $user->first_name }}" placeholder="First Name">
                                                        <input type="text" class="form-control w-25 last d-inline-block" value="{{ $user->last_name }}" placeholder="Last Name">
                                                        <button class="btn save_edit_name"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                                    </div>
                                                    @if($user->mentorat == \App\User::mentorat)
                                                        <small class="badge badge-warning ">MENTOR</small>
                                                    @endif
                                                    <span class="ml-3 pointer"><i class="fa fa-map-marker" aria-hidden="true"></i> <i class="ml-1 propg-location text-warning fa fa-edit"></i> <span class="span_for_city">{{$user->city}}</span> </span>
                                                    <div class="d-none edit_city">
                                                        <input type="text" id="city" class="form-control w-25 city d-inline-block" value="{{ $user->city }}" placeholder="City">
                                                        <button class="btn save_edit_city"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                                    </div>
                                                    <p>

                                                    @if(!empty($title_of_the_post))
                                                       <i class="ml-1 propg-title-of-post text-warning fa fa-edit"></i> <span class="old_title_of_the_post">{{$title_of_the_post}}</span>,
                                                    @endif
                                                    {{--@if(!empty($institution))--}}
                                                            {{--<i class="ml-1 propg-institution text-warning fa fa-edit"></i><span class="old_institution">{{$institution}}</span> .--}}
                                                    {{--@endif--}}
                                                        {{$schoolInfo->name}}
                                                    </p>
                                                    <div class="d-none edit_title_of_post">
                                                        <input type="text" class="form-control w-25 title_of_post d-inline-block" value="{{ (!empty($title_of_the_post))? $title_of_the_post : "" }}" >
                                                        <button class="btn save_edit_title_of_post"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                                    </div>
                                                    <div class="d-none edit_institution">
                                                        <input type="text" class="form-control w-25 new_institution d-inline-block" value="{{ (!empty($institution ))? $institution : ""}}" >
                                                        <button class="btn save_edit_institution"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                                    </div>
                                                   <!--  <span  class="d-inline-block mb-3 pointer"> <i class="ml-1 text-warning fa fa-edit propg-year"></i> <i class="fa fa-graduation-cap" aria-hidden="true"></i> <span class="span_for_year"> {{$user->GetGraduationYear?$user->GetGraduationYear->year:''}} </span> </span> -->
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
                                                    <span>{{ $user->email }}</span>
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

                                                    <h5 class="my-4 font-weight-light"><i class="fa fa-briefcase" aria-hidden="true"></i>  Expériences
                                                        {{--<a href="#" class="float-right"><i class="fa fa-edit"></i></a>--}}
                                                        <a href="#"  data-toggle="modal" data-target="#ModalExperience" class="btn btn-outline-warning">Ajouter une expérience</a>
                                                    </h5>
                                                    @if(!empty($title_of_the_post) || !empty($describe_mission))
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                            <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                            <div class="propgcl-mr-right">
                                                                <h6>{{ (!empty($title_of_the_post))? $title_of_the_post : "" }}</h6>
                                                                <p class=" mt-0"> {{$schoolInfo->name}}</p>
                                                                <p>{{ (!empty($describe_mission))? $describe_mission : "" }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{--@if(!empty($what_function_copy) && $what_function_copy)--}}
                                                        {{--<div class="propgcl-mr-row-inner-row d-flex mb-3">--}}
                                                            {{--<div class="propgcl-mr-left my propgcl-mr-left-work"></div>--}}
                                                            {{--<div class="propgcl-mr-right">--}}
                                                                {{--<h6>{{$what_function_copy}}</h6>--}}
                                                                {{--                                                                    <p class=" mt-0">Datalumni</p>--}}
                                                                {{--                                                                    <p class="mb-2">Oct 2018 – Present</p>--}}
                                                                {{--<p>{{ $company_name }}</p>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--@endif--}}
                                                    @foreach( App\UserExpeience::where('user_id',$user->id)->get() as $UserExpeience )
                                                        <div class="propgcl-mr-row-inner-row d-flex mb-3">
                                                            <div class="propgcl-mr-left my propgcl-mr-left-work"></div>
                                                            <div class="propgcl-mr-right">
                                                                <h6>{{$UserExpeience->name}}</h6>
                                                                <p class=" mt-0"> {{$UserExpeience->GetCompanyInfo->name}}</p>
                                                                <p class="mb-2">{{$UserExpeience->start_date}} - {{$UserExpeience->end_date}}</p>
                                                                <p class=" mt-0"> {!! $UserExpeience->description !!}</p>
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
                                                        <a href="#"  data-toggle="modal" data-target="#ModalFormation" class="btn btn-outline-warning">Ajouter une formation</a>
                                                    </h5>
                                                    @if(!empty($diplom) || !empty($graduation_year))
                                                        <div class="propgcl-mr-row-inner-row mb-3 align-top">
                                                            <div class="propgcl-mr-left d-inline-block mr-2"><i class="fa fa-book" aria-hidden="true"></i></div>
                                                            <div class="d-inline-block align-top"  style="width: 90%">
                                                                <h6>{{$diplom}}</h6>
                                                                <p class="mb-0">{{$institution}}</p>
                                                                <p class="mb-2">{{$graduation_year}}</p>
                                                            </div>
                                                        </div>
                                                    @endif
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
                                                        <a href="#" data-toggle="modal" data-target="#ModalHobby" class="btn btn-outline-warning">Ajouter un hobby</a>
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
                                                    <h5 class="my-4 font-weight-light"><i class="fa fa-info" aria-hidden="true"></i>  Information <h5>
                                                        <a href="{{ route('admin.remove-profile', ['id' => $user->id]) }}" class="float-right"><i class="fa fa-trash"></i> Delete Account</a>
                                                    </h5>
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
<div class="modal fade" id="ModalHobby" tabindex="-1" role="dialog" aria-labelledby="ModalForHobby" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalForHobby">Ajouter un hobby</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form_for_experience" action="{{ route('admin.AddHobby') }}" method="post">
                <div class="modal-body">
                    @csrf

                    <div class="form-group">
                        <label for="hobby">Hobby</label>
                        @if ($errors->has('hobby'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('hobby') }}</strong></p>
                        @endif
                        <input type="text" required="" class="form-control" id="hobby" name="hobby" placeholder="Hobby">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn_for_experience_form">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalFormation" tabindex="-1" role="dialog" aria-labelledby="ModalForFormation" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalForFormation">Ajouter une formation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form_for_experience" action="{{ route('admin.AddFormation') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group div_for_formation">
                        <label for="facility">Nom de l'établissement</label>
                        @if ($errors->has('facility'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('facility') }}</strong></p>
                        @endif
                        <select class="form-control multiple_formation " id="facility" name="facility">
                            <option value="" checked>Types</option>
                            @foreach(App\SchoolsOfRegsiterSurvey::all() as $SchoolsOfRegsiterSurvey)
                                <option value="{{$SchoolsOfRegsiterSurvey->id}}"> {{$SchoolsOfRegsiterSurvey->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name_of_formation">Nom de la formation</label>
                        @if ($errors->has('name_of_formation'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('name_of_formation') }}</strong></p>
                        @endif
                        <input type="text" required="" class="form-control" id="name_of_formation" name="name_of_formation" placeholder="Nom de la formation">
                    </div>

                    <div class="form-group">
                        <label for="city_of_formation">Ville </label>
                        <input class="form-control" id="city_of_formation" name="city_of_formation">
                    </div>
                    <div class="form-group div_for_formation">
                        <label for="graduation_year">Année de diplomation</label>
                        @if ($errors->has('graduation_year'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('graduation_year') }}</strong></p>
                        @endif
                        <select name="graduation_year" id="graduation_year" class='form-control w-100 multiple_formation' required="">
                            <option value="" >Année de diplomation</option>
                            @foreach(App\GraduationYear::all() as $graduationyear)
                                <option value="{{$graduationyear->id}}">{{$graduationyear->year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn_for_experience_form">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalExperience" tabindex="-1" role="dialog" aria-labelledby="ModalForExperience" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalForExperience">Ajouter une expérience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form_for_experience" action="{{ route('admin.AddExperience') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name_of_job_post">Fonction</label>
                        @if ($errors->has('name_of_job_post'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('name_of_job_post') }}</strong></p>
                        @endif
                        <input type="text" required="" class="form-control" id="name_of_job_post" name="name_of_job_post" placeholder="Fonction">
                    </div>
                    <div class="form-group div_for_experience">
                        <label for="company_id">Employeur</label>
                        @if ($errors->has('company_id'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('company_id') }}</strong></p>
                        @endif
                        <select required="" class="form-control multiple" name="company_id">
                            <option value="" disabled="" {{ old('company_id')?'':'selected' }}>Select Company</option>
                            @foreach(App\Company::all() as $company)
                                <option value="{{ $company->id }}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Date de début</label>
                        @if ($errors->has('start_date'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('start_date') }}</strong></p>
                        @endif
                        <input required="" type="date" id="start_date"  class="form-control" name="start_date" >
                        <label for="end_date">Date de fin</label>
                        @if ($errors->has('end_date'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('end_date') }}</strong></p>
                        @endif
                        <input required="" type="date" id="end_date" class="form-control" name="end_date" >
                    </div>
                    <div class="form-group">
                        <label for="description">Description des missions</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn_for_experience_form">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvvqgc0KhI8v-1cqDl2lbDpy12TFVKe_U&libraries=places&callback=initAutocomplete"async defer></script>
@if ($errors->has('experience'))
    <script>
        $(document).ready(function(){
            $('#ModalExperience').modal('toggle');
        })
    </script>
@endif
@if ($errors->has('formation'))
    <script>
        $(document).ready(function(){
            $('#ModalFormation').modal('toggle');
        })
    </script>
@endif
@if ($errors->has('hobby'))
    <script>
        $(document).ready(function(){
            $('#ModalHobby').modal('toggle');
        })
    </script>
@endif
<script>
    function initAutocomplete() {
        var input = document.getElementById('city');
        var city_of_formation = document.getElementById('city_of_formation');
        var opts = {
            types: ['(cities)']
        };
        new google.maps.places.Autocomplete(input, opts);
        new google.maps.places.Autocomplete(city_of_formation, opts);

    }
    $(document).ready(function(){
        setTimeout(function(){

            $('.multiple').select2({
                tags: "true",
                dropdownParent: $('#ModalExperience')
            });
            $('.multiple_formation').select2({
                tags: "true",
                dropdownParent: $('#ModalFormation')
            });
            $(".div_for_experience>span").addClass('form-control');
            $(".div_for_formation>span").addClass('form-control');
        },500)

    })
</script>
@endsection