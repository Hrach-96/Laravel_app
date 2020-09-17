@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="col-md-10 text-center">
                <h4 class="text-info">{{$job->first_name}} {{$job->first_name}}</h4>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <form  action="{{ route('super_admin.UpdateJob') }}" class="mt-5 mb-5" method="post"  enctype="multipart/form-data">
                        @csrf
                        <input type='hidden' name="id" value="{{ Crypt::encrypt($job->id) }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="col-md-12 text-center">
                                        @if(!empty($job->logo))
                                            <img class="img_for_details_page mb-2" src="{{asset("images/Job/" . $job->logo)}}">
                                        @else
                                            <img class="img_for_details_page mb-2" src="{{asset("images/Users/default.jpg")}}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Intitulé du poste  <span class="text-danger">*</span></label>
                                        @if ($errors->has('title'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
                                        @endif
                                        <input type="text" id="title" value="{{ $job->title }}"  class="form-control" placeholder="Enter Job Bord title" name="title" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">Entreprise  <span class="text-danger">*</span></label>
                                        @if ($errors->has('company_name'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('company_name') }}</strong></p>
                                        @endif
                                        <select name="company_name" id="company_name" class='form-control multiple w-100' required="">
                                            <option value="" disabled="" >Company</option>
                                            @foreach(App\Company::all() as $company)
                                                @if($company->id == $job->company_id)
                                                    <option selected value="{{$company->id}}">{{$company->name}} </option>
                                                @else
                                                    <option value="{{$company->id}}">{{$company->name}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo de l’entreprise </label>
                                        @if ($errors->has('logo'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('logo') }}</strong></p>
                                        @endif
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="logo">
                                            <label class="custom-file-label" for="logo">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="area">Domaine d’activité  <span class="text-danger">*</span></label>
                                        @if ($errors->has('area'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('area') }}</strong></p>
                                        @endif
                                        <select name="area" id="area" class='form-control multiple w-100' required="">
                                            <option value="" disabled="" >Area</option>
                                            @foreach(App\Area::all() as $area)
                                                @if($area->id == $job->area_id)
                                                    <option selected value="{{$area->id}}">{{$area->name}}</option>
                                                @else
                                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="type_contract">Type de contrat <span class="text-danger">*</span></label>
                                        @if ($errors->has('type_contract'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('type_contract') }}</strong></p>
                                        @endif
                                        <select name="type_contract" id="type_contract" class='form-control multiple w-100' required="">
                                            <option value="" disabled="" >Type Contract</option>
                                            @foreach(App\Contract::all() as $contract)
                                                @if($contract->id == $job->contract_id)
                                                    <option selected value="{{$contract->id}}">{{$contract->name}}</option>
                                                @else
                                                    <option value="{{$contract->id}}">{{$contract->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-10 offset-1">
                                    <div class="form-group">
                                        <label for="description">Description du poste</label>
                                        @if ($errors->has('description'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('description') }}</strong></p>
                                        @endif
                                        <textarea name="description" class="form-control">{{ $job->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email pour candidater <span class="text-danger">*</span></label>
                                        @if ($errors->has('email'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
                                        @endif
                                        <input name="email" required="" class="form-control" type="email" value="{{$job->email}}" id="" placeholder="Email pour candidater">
                                    </div>
                                    <div class="form-group">
                                        <label for="experience">Expérience souhaitée <span class="text-danger">*</span></label>
                                        @if ($errors->has('experience'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('experience') }}</strong></p>
                                        @endif
                                        <select name="experience" id="experience" class='form-control multiple w-100' required="">
                                            <option value="" disabled="" >Expérience</option>
                                            @foreach(App\Experience::all() as $experience)
                                                @if($experience->id == $job->experience_id)
                                                    <option selected value="{{$experience->id}}">{{$experience->name}}</option>
                                                @else
                                                    <option value="{{$experience->id}}">{{$experience->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">Salaire </label>
                                        @if ($errors->has('salary'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('salary') }}</strong></p>
                                        @endif
                                        <select name="salary" id="salary" class='form-control multiple w-100' >
                                            <option value="" checked="" >Salaire</option>
                                            @foreach(App\Salary::all() as $salary)
                                                @if($salary->id == $job->salary_id)
                                                    <option selected value="{{$salary->id}}">{{$salary->name}}</option>
                                                @else
                                                    <option value="{{$salary->id}}">{{$salary->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Date de début <span class="text-danger">*</span></label>
                                        @if ($errors->has('start_date'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('start_date') }}</strong></p>
                                        @endif
                                        <input name="start_date" required="" class="form-control" type="date" value="{{$job->start_date}}" id="" placeholder="Enter Your Start date">
                                    </div>
                                    <div class="form-group">
                                        <label for="file_atachment">Ajouter une pièce-jointe</label>
                                        @if ($errors->has('file_atachment'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('file_atachment') }}</strong></p>
                                        @endif
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_atachment" name="file_atachment">
                                            <label class="custom-file-label" for="file_atachment">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="school">School <span class="text-danger">*</span></label>
                                        @if ($errors->has('school'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('school') }}</strong></p>
                                        @endif
                                        <select name="school" id="school" class='form-control multiple w-100' required="">
                                            <option value="" disabled="" >Expérience</option>
                                            @foreach(App\School::all() as $school)
                                                @if($school->id == $job->school_id)
                                                    <option selected value="{{$school->id}}">{{$school->name}}</option>
                                                @else
                                                    <option value="{{$school->id}}">{{$school->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <button class="btn btn-outline-danger float-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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