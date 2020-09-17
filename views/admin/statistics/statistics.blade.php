@extends('admin_inc.template')
@section('content')
	<main>
		<div class="directory-pg jbpgs">
			<div class="container-fluid">
				<div class="directory-pg-wrp jbpgs-wrp">
					<div class="jbpgs-searchbox">
						<form action="{{ route('admin.statistics') }}" method="get">
							<div class="jbpgs-searchbox-wrp m-auto bg-white box-shadow">
								<div class="row p-2 jbpgs-searchbox-row align-items-center">
									<div class="col-md-4">
										<div class="jbpgs-searchbox-col">
											<div class="form-control-select-wrp">
												<select class="form-control pt-0 border-0" name="category">
													<option value="">Catégorie d’utilisateur</option>
													@foreach(App\Category::all() as $category)
														<option {{ $categorys == $category->title?'selected':'' }}>{{ $category->title }}</option>
													@endforeach
												</select>
												<i class="fa fa-angle-down" aria-hidden="true"></i>
											</div>
										</div>
									</div>
									<div class="col-md-4">
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
									{{--<a href="{{ route('admin.user-csv') }}" class="btn btn-theme">Exporter</a>--}}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								{!! $chart->html() !!}
							</div>
							<div class="col-md-4 text-center">
								<h4>Pourcentage d’alumni devenus mentor</h4>
								<h1>
									<i class="fas fa-user-shield"></i>
									{{$procent_of_mentors}} %
								</h1>
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_after_this_training->html() !!}
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_time_to_first_find_job->html() !!}
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_nature_of_contract->html() !!}
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_what_area_this_job->html() !!}
							</div>
							<div class="col-md-6 mt-1">
								{!! $chart_full_time_or_part_time_job->html() !!}
							</div>
							<div class="col-md-6 mt-1">
								{!! $chart_salary_bracket->html() !!}
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_before_entering_old_degree->html() !!}
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_foloowed_sector->html() !!}
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_quality_of_lessons->html() !!}
							</div>
							<div class="col-md-12 mt-1">
								{!! $chart_your_rate_overall_satisfaction_training->html() !!}
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>
	{!! Charts::scripts() !!}
	{!! $chart->script() !!}
	{!! $chart_time_to_first_find_job->script() !!}
	{!! $chart_nature_of_contract->script() !!}
	{!! $chart_what_area_this_job->script() !!}
	{!! $chart_full_time_or_part_time_job->script() !!}
	{!! $chart_salary_bracket->script() !!}
	{!! $chart_before_entering_old_degree->script() !!}
	{!! $chart_foloowed_sector->script() !!}
	{!! $chart_quality_of_lessons->script() !!}
	{!! $chart_your_rate_overall_satisfaction_training->script() !!}
	{!! $chart_after_this_training->script() !!}
@endsection
