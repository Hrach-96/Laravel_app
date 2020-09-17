@extends('admin_inc.template')
@section('content')
    <main>
        <div class="directory-pg jbpgs">
            <div class="container-fluid">
                <div class="directory-pg-wrp jbpgs-wrp">
                    <div class="section2-content section_class">
                        <div class="row">
                            <div class="col-md-6 mt-5 offset-3 pos-rel">
                                <img src="{{ asset('images/Blogs') . "/". $BlogPost->image}}" class="img_fro_blog_page">
                            </div>
                            <div class="col-md-6 mt-5 offset-3 ">
                                <h1 class="float-left"><b>{{$BlogPost->title}}</b></h1>
                            </div>
                            <div class="col-md-6 mt-5 offset-3 ">
                                <span class="float-left"><b>{!! $BlogPost->content  !!}</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
