@extends('admin_inc.template')
@section('content')
         <main>
            <div class="postjob-pg py-5">
               <div class="container-fluid py-5">
                  <div class="postjob-pg-wrp">
                     <div class="postjobpg-box p-5 bg-white box-shadow m-auto">
                        <h3><i class="fa fa-pencil-square-o mr-3 tcolor" aria-hidden="true"></i> Publier</h3>
                        <div class="postjobpg-fields-wrp">
                           <form action="{{ route('admin.new-job') }}" method="post" class="form" enctype="multipart/form-data">
                              @csrf
                              <div class="d-flex mb-4 mt-5">
                                 <h6 class="postjobpg-lside-postjobpg">Job title</h6>
                                 <div class="postjobpg-fields-title">
                                    <div class="postjobpg-fields-grp">
                                       @if ($errors->has('title'))
                                          <p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
                                       @endif
                                       <input class="form-control"  name="title" type="text" value="{{old('title')}}" id="" placeholder="Intitulé du poste">
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex">
                                 <h6 class="postjobpg-lside-postjobpg">Job Summary</h6>
                                 <div class="postjobpg-fields-summry">
                                    <div class="postjobpg-fields-summry-wrp">
                                       <div class="postjobpg-fields-summry-row row">
                                          <div class="col-md-6">
                                             <label class="">Entreprise</label>
                                             <div class="postjobpg-fields-grp ">
                                                @if ($errors->has('company_name'))
                                                   <p role="alert" class='text-danger'><strong>{{ $errors->first('company_name') }}</strong></p>
                                                @endif
                                                <select name="company_name" id="company_name" class='form-control multiple w-100' required="">
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
                                                <input required="" class="form-control" name="logo" type="file" value="" id="">
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
                                                <select name="area" id="area" class='form-control multiple w-100' required="">
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
                                                <select name="type_contract" id="type_contract" class='form-control multiple w-100' required="">
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
                                                <textarea name="description" class="form-control"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="postjobpg-fields-summry-row row">
                                          <div class="col-md-6">
                                             <label class=""></label>
                                             <div class="postjobpg-fields-grp">
                                                @if ($errors->has('email'))
                                                   <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
                                                @endif
                                                <input name="email" required="" class="form-control" type="email" value="{{old('email')}}" id="" placeholder="Email pour candidater">
                                             </div>
                                          </div>
                                          <div class="col-md-6 mt-2">
                                             <label>Expérience souhaitée</label>
                                             <div class="form-control-select-wrp">
                                                @if ($errors->has('experience'))
                                                   <p role="alert" class='text-danger'><strong>{{ $errors->first('experience') }}</strong></p>
                                                @endif
                                                <select name="experience" id="experience" class='form-control multiple w-100' required="">
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
                                                <select name="salary" id="salary" class='form-control multiple w-100' required="">
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
                                                <input name="start_date" required="" class="form-control" type="date" value="{{old('start_date')}}" id="" placeholder="Enter Your Start date">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="postjobpg-fields-summry-row row">
                                          <div class="col-md-6 offset-3">
                                             <label class="">Ajouter une pièce-jointe</label>
                                             <div class="postjobpg-fields-grp">
                                                <input name="file_atachment" class="form-control" type="file" value="" id="">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="postjobpg-fields-btn mt-4">
                                          <input type="submit" class="btn btn-theme" value="Publier" name="">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
@endsection