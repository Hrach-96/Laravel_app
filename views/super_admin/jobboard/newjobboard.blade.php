@extends('super_admin_inc.template')
@section('content')    
	<div class="container-fluid page-body-wrapper">
	  	<!-- partial -->
		<div class="main-panel p-4 mb-5">
			<div class="super_admin_content">
				<form action="{{ route('super_admin.NewJobBoard') }}" method="post" class="form" enctype="multipart/form-data">
					@csrf
					<h4 class="text-info">Job Board Information</h4>
					<div class="form-group">
						<label for="title">Intitulé du poste  <span class="text-danger">*</span></label>
						@if ($errors->has('title'))
							<p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
						@endif
						<input type="text" id="title" value="{{ old('title') }}"  class="form-control" placeholder="Enter Job Bord title" name="title" required >
					</div>
					<div class="form-group">
						<label for="company_name">Entreprise  <span class="text-danger">*</span></label>
						@if ($errors->has('company_name'))
							<p role="alert" class='text-danger'><strong>{{ $errors->first('company_name') }}</strong></p>
						@endif
						<select name="company_name" id="company_name" class='form-control multiple w-100' required="">
							<option value="" disabled="" >Company</option>
							@foreach(App\Company::all() as $company)
								<option >{{$company->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="logo">Logo de l’entreprise  <span class="text-danger">*</span></label>
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
								<option value="{{$area->id}}">{{$area->name}}</option>
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
								<option value="{{$contract->id}}">{{$contract->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="description">Description du poste</label>
						@if ($errors->has('description'))
							<p role="alert" class='text-danger'><strong>{{ $errors->first('description') }}</strong></p>
						@endif
						<textarea {{ old('description') }} name="description" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="email">Email pour candidater <span class="text-danger">*</span></label>
						@if ($errors->has('email'))
							<p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
						@endif
						<input name="email" required="" class="form-control" type="email" value="{{old('email')}}" id="" placeholder="Email pour candidater">
					</div>
					<div class="form-group">
						<label for="experience">Expérience souhaitée <span class="text-danger">*</span></label>
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
					<div class="form-group">
						<label for="salary">Salaire </label>
						@if ($errors->has('salary'))
							<p role="alert" class='text-danger'><strong>{{ $errors->first('salary') }}</strong></p>
						@endif
						<select name="salary" id="salary" class='form-control multiple w-100' >
							<option value="" checked="" >Salaire</option>
							@foreach(App\Salary::all() as $salary)
								<option value="{{$salary->id}}">{{$salary->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="start_date">Date de début <span class="text-danger">*</span></label>
						@if ($errors->has('start_date'))
							<p role="alert" class='text-danger'><strong>{{ $errors->first('start_date') }}</strong></p>
						@endif
						<input name="start_date" required="" class="form-control" type="date" value="{{old('start_date')}}" id="" placeholder="Enter Your Start date">
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
								<option value="{{$school->id}}">{{$school->name}}</option>
							@endforeach
						</select>
					</div>
					<button type="submit" class="btn btn-outline-primary mt-4">Create</button>
				</form>
		</div>
	</div>
	</div>
@endsection