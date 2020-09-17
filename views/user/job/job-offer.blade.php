@extends('user_inc.template')
@section('content')
    <main>
        <div class="joboffer-pg jbpgs">
            <div class="container-fluid">
                <div class="joboffer-pg-wrp jbpgs-wrp">
                    <div class="jbpgs-searchbox">
                        <div class="jbpgs-searchbox-wrp m-auto bg-white box-shadow">
                            <div class="row p-2 jbpgs-searchbox-row align-items-center">
                                <div class="col-md-3">
                                    <div class="jbpgs-searchbox-col">
                                        <input type="text" class="form-control pt-1 border-0" id="" placeholder="Mots clés">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0">
                                                <option>Poste</option>
                                                <option>Banking</option>
                                                <option>Estate</option>
                                                <option>Retail</option>
                                                <option>Agency</option>
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0">
                                                <option>Type de contrat</option>
                                                <option>Banking</option>
                                                <option>Estate</option>
                                                <option>Retail</option>
                                                <option>Agency</option>
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col">
                                        <div class="form-control-select-wrp">
                                            <select class="form-control pt-0 border-0">
                                                <option>Lieux</option>
                                                <option>New York</option>
                                                <option>Washington</option>
                                                <option>Springfield</option>
                                                <option>Franklin</option>
                                            </select>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="jbpgs-searchbox-col ">
                                        <input type="submit" class="btn btn-theme btn-block " name="" value="chercher">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="jbpgs-post-start jobofferpg-post-start m-auto pb-5">
                        <div class="section-title-wrp text-center">
                            <h2 class="section-title">Les dernières offres d'emploi</h2>
                        </div>
                        <div>
                            <div class="d-flex mb-4 pb-3 align-items-center">
                                <div >
                                    <a href="{{ route('user.post-job') }}" class="btn btn-theme">Poster une offre</a>
                                </div>
                            </div>
                        </div>
                        <div class="jobofferpg-post-start-wrp">
                            <div class="row jobofferpg-post-wrp more_content">
                                @if($jobs->count() == 0)
                                    <div class="col-md-12 text-cneter">
                                        <h5 class="text-info text-center">ll n’y a rien pour le moment par ici, et si vous étiez le premier à poster une offre d'emploi pour votre réseau ?</h5>
                                    </div>
                                @endif
                                @foreach($jobs as $job)
                                    <div class="jobofferpg-post-col col-lg-6">
                                        <div class="jobofferpg-post-col-wrp d-flex bg-white box-shadow p-4">
                                        <div class="jobofferpg-post-img">
                                            <img src="{{asset('images/Job/'. $job->logo)}}">
                                        </div>
                                        <div class="jobofferpg-post-content pl-3">
                                            <h6 class="jobofferpg-post-title mb-2">{{ $job->title }}</h6>
                                            <p class="mb-1">{{$job->GetContactInfo->name}}</p>
                                            <p class="mb-1">Paris</p>
                                            {{--<p class="mb-1"><span>CDI</span> </p>--}}
                                            <p class="mb-1">
                                                @php
                                                    $user_of_the_job = App\JobOfTheUser::where('job_id',$job->id)->first()->GetUserInfo;
                                                @endphp
                                                Auteur: {{$user_of_the_job->first_name}} {{$user_of_the_job->last_name}}
                                            </p>
                                        </div>
                                        <div class="jobofferpg-post-btnc ml-auto">
                                            <div class="jobofferpg-post-btnc-wrp d-flex align-items-end flex-column h-100">
                                                <div class="jobofferpg-post-date text-right mb-auto">{{ date('d M, Y',strtotime($job->created_at)) }}</div>
                                                @if($job->status == \App\JobBoard::status_active)
                                                    <small class="badge badge-success ">Active</small>
                                                @else
                                                    <small class="badge badge-danger ">Inactive</small>
                                                @endif
                                                <div class="jobofferpg-post-btn mt-3">
                                                    @if(App\JobOfTheUser::where('job_id',$job->id)->where('user_id',$user->id)->first())
                                                        <a href="#" data-job-id="{{ Crypt::encrypt($job->id) }}" data-toggle="modal" data-target="#ModalEditJob" class="btn btn-theme btn_for_job_offers btn_for_job_{{$job->id}}">Edit</a>
                                                    @endif
                                                    <a href="#" class="btn btn-theme">Consulter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if($jobs->lastPage() > 1)
                                <div class="mt-3 text-right">
                                    <a href="#" class="btn btn-theme VoirPlus" data_url="{{ urlencode($jobs->nextPageUrl()) }}"  count="{{ $jobs->lastPage() }}">Voir plus</a>
                                </div>
                            @endif

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="ModalEditJob" tabindex="-1" role="dialog" aria-labelledby="ModalForEditJob" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalForEditJob"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form_for_experience" enctype="multipart/form-data" action="{{ route('user.UpdateJobInfo') }}" method="post">
                    <input type="hidden" name="id" class="input_for_job_id">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group text-center">
                            <img class="img_for_150_150_px">
                        </div>
                        <div class="d-flex mb-4 mt-5">
                            <div class="postjobpg-fields-title">
                                <div class="postjobpg-fields-grp">
                                    @if ($errors->has('title'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
                                    @endif
                                    <label class="">Intitulé du poste</label>
                                    <input class="form-control"  name="title" type="text" value="{{old('title')}}" id="title" placeholder="Intitulé du poste">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="postjobpg-fields-summry">
                                <div class="postjobpg-fields-summry-wrp">
                                    <div class="postjobpg-fields-summry-row row">
                                        <div class="col-md-6">
                                            <label class="">Entreprise</label>
                                            <div class="postjobpg-fields-grp ">
                                                @if ($errors->has('company_name'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('company_name') }}</strong></p>
                                                @endif
                                                <select name="company_name" id="company_name" class='form-control multiple w-100' >
                                                    <option value="" disabled="" >Company</option>
                                                    @foreach(App\Company::all() as $company)
                                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label class="">Logo de l’entreprise</label>
                                            @if ($errors->has('logo'))
                                                <p role="alert" class='text-danger'><strong>{{ $errors->first('logo') }}</strong></p>
                                            @endif
                                            <div class="postjobpg-fields-grp">
                                                <input  class="form-control" name="logo" type="file" value="" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="postjobpg-fields-summry-row row">
                                        <div class="col-md-6">
                                            <label class="">Domaine d’activité </label>
                                            <div class="postjobpg-fields-grp">
                                                @if ($errors->has('area'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('area') }}</strong></p>
                                                @endif
                                                <select name="area" id="area" class='form-control multiple w-100' >
                                                    <option value="" disabled="" >Area</option>
                                                    @foreach(App\Area::all() as $area)
                                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="">type de contrat</label>
                                            <div class="postjobpg-fields-grp">
                                                @if ($errors->has('type_contract'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('type_contract') }}</strong></p>
                                                @endif
                                                <select name="type_contract" id="type_contract" class='form-control multiple w-100' >
                                                    <option value="" disabled="" >Type Contract</option>
                                                    @foreach(App\Contract::all() as $contract)
                                                        <option value="{{$contract->id}}">{{$contract->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="postjobpg-fields-summry-row row">
                                        <div class="col-md-12">
                                            <label class="">Description du poste </label>
                                            <div class="postjobpg-fields-grp">
                                                <textarea id="description" name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="postjobpg-fields-summry-row row">
                                        <div class="col-md-6">
                                            <label class="">Email pour candidater</label>
                                            <div class="postjobpg-fields-grp">
                                                @if ($errors->has('email'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
                                                @endif
                                                <input name="email"  class="form-control" type="email" value="{{old('email')}}" id="email_to_apply" placeholder="Email pour candidater">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label>Expérience souhaitée</label>
                                            <div class="form-control-select-wrp">
                                                @if ($errors->has('experience'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('experience') }}</strong></p>
                                                @endif
                                                <select name="experience" id="experience" class='form-control multiple w-100' >
                                                    <option value="" disabled="" >Expérience</option>
                                                    @foreach(App\Experience::all() as $experience)
                                                        <option value="{{$experience->id}}">{{$experience->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="postjobpg-fields-summry-row row">
                                        <div class="col-md-6 mt-2">
                                            <label class="">Salaire</label>
                                            <div class="form-control-select-wrp">
                                                @if ($errors->has('salary'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('salary') }}</strong></p>
                                                @endif
                                                <select name="salary" id="salary" class='form-control multiple w-100' >
                                                    <option value="" disabled="" >Salaire</option>
                                                    @foreach(App\Salary::all() as $salary)
                                                        <option value="{{$salary->id}}">{{$salary->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="">Date de début</label>
                                            <div class="postjobpg-fields-grp">
                                                @if ($errors->has('start_date'))
                                                    <p role="alert" class='text-danger'><strong>{{ $errors->first('start_date') }}</strong></p>
                                                @endif
                                                <input name="start_date"  class="form-control" type="date" value="{{old('start_date')}}" id="start_date" placeholder="Enter Your Start date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="postjobpg-fields-summry-row row">
                                        <div class="col-md-6 offset-3">
                                            <label class="">Ajouter une pièce-jointe</label>
                                            <div class="postjobpg-fields-grp">
                                                <input name="file_atachment"  class="form-control" type="file" value="" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection
