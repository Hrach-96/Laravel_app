@extends('admin_inc.template')
@section('content')
	<main>
		<div class="directory-pg jbpgs">
			<div class="container-fluid">
				<div class="directory-pg-wrp jbpgs-wrp">
					<div class="jbpgs-searchbox">
						<form action="{{ route('admin.emailing') }}" method="get">
							<div class="jbpgs-searchbox-wrp m-auto bg-white box-shadow">
								<div class="row p-2 jbpgs-searchbox-row align-items-center">
									<div class="col-md-2">
										<div class="jbpgs-searchbox-col">
											<div class="form-control-select-wrp">
												<select class="form-control pt-0 border-0" name="platform">
													<option value="">platform</option>
													<option >Active</option>
													<option >Inactive</option>
												</select>
												<i class="fa fa-angle-down" aria-hidden="true"></i>
											</div>
										</div>
									</div>
									<div class="col-md-3">
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
									<div class="col-md-3">
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
                            <div class="">
                                <a data-toggle="modal" data-target="#ModalSendMail" class="btn btn-theme">Send Mail</a>
                            </div>
                        </div>
                    </div>
						<div class="row jbpgs-post-start-row more_content">
							@foreach($users as $user)
								<div class="col-md-12 jbpgs-post-start-col">
									<div class="emailing_div p-3 bg-white" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2)">
										<div class="mr-2">
											@if(is_null($user->avatar))
												<img src="{{ asset("images/avatar/default.jpg") }}" class="emailing-col-img" alt="">
											@else
												<img src="{{ asset("images/avatar/$user->avatar") }}" class="emailing-col-img" alt="">
											@endif
										</div>
										<div>
											<h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
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
	</main>
<div class="modal fade" id="ModalSendMail" tabindex="-1" role="dialog" aria-labelledby="ModalForExperience" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalForExperience">Send Mail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form_for_experience" action="{{ route('admin.emailing.SendMail') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        @if ($errors->has('subject'))
                            <p role="alert" class='text-danger'><strong>{{ $errors->first('subject') }}</strong></p>
                        @endif
                        <textarea name="subject" id="subject"  required="" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn_for_experience_form">Send Mail</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->has('subject'))
    <script>
        $(document).ready(function(){
            $('#ModalSendMail').modal('toggle');
        })
    </script>
@endif
@endsection
