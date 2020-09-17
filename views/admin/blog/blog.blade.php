@extends('admin_inc.template')
@section('content')
	<main>
		<div class="directory-pg jbpgs">
			<div class="container-fluid">
				<div class="directory-pg-wrp jbpgs-wrp">
					<div class="section2-content section_class">
						<div class="mt-3">
							<div class="d-flex mb-4 pb-3 align-items-center">
								<div class="ml-2">
									<a href="{{ route('admin.addblog') }}" class="btn btn-theme">Ajouter un article</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 offset-3 pos-rel">
								<div class="card">
									<div class="card-header">
										<h4>A la une</h4>
									</div>
									<div class="card-body">
										<div class="todo-list todo-list-hover todo-list-divided">
											@if(App\BlogOfTheSchool::where('school_id',$AdminOfTheSchool->school_id)->count() > 0)
												@foreach(App\BlogOfTheSchool::where('school_id',$AdminOfTheSchool->school_id)->get() as $blog_post)
													<div class="todo todo-default">
														<img src="{{ asset('images/Blogs/' . $blog_post->GetBlogInfo->image) }}" class="img-responsive img_class_200 mr-2 img-circle" alt="">
														<span class="com-status bage-warning"></span>
														<h5 class="ct-title"><span class="font-weight-bold mb-2">{{$blog_post->GetBlogInfo->title}}</span><span class="ct-designation div_for_blogpost">{!! $blog_post->GetBlogInfo->content !!}<a href="{{route('admin.BlogInfo' , ['id' => $blog_post->GetBlogInfo->id ])}}">Lire plus</a></h5>
														@if($blog_post->GetBlogInfo->status == \App\BlogPost::status_active)
															<h5><small class="badge badge-success ">Active</small></h5>
														@else
															<h5><small class="badge badge-danger ">Inactive</small></h5>
														@endif
													</div>
												@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
