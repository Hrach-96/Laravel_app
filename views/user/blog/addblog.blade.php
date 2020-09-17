@extends('admin_inc.template')
@section('content')
    <main>
        <div class="directory-pg jbpgs">
            <div class="container-fluid">
                <div class="directory-pg-wrp jbpgs-wrp">
                    <h5 class="text-warning mt-5">Ajouter un article</h5>
                    <form action="{{ route('user.NewBlog') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titre de l’article <span class="text-danger">*</span></label>
                            @if ($errors->has('title'))
                                <p role="alert" class='text-danger'><strong>{{ $errors->first('title') }}</strong></p>
                            @endif
                            <input type="text" id="title" value="{{ old('title') }}"  class="form-control" placeholder="Indiquez le titre de votre article" name="title" required >
                        </div>
                        <div class="form-group">
                            @if ($errors->has('editor'))
                                <p role="alert" class='text-danger'><strong>{{ $errors->first('editor') }}</strong></p>
                            @endif
                            <textarea class="editor_for_admin" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_for_blog">Picture  <span class="text-danger">*</span></label>
                            @if ($errors->has('image_for_blog'))
                                <p role="alert" class='text-danger'><strong>{{ $errors->first('image_for_blog') }}</strong></p>
                            @endif
                            <div class="form-group">
                                <input type="file" class="form-control" required="" id="image_for_blog" name="image_for_blog">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="switch switch-label switch-pill switch-success switch-sm">
                                <input name="active" class="switch-input user_status" type="checkbox">
                                Active
                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                            </label>
                        </div>
                        <div class="form-group text-right mt-5">
                            <button class="btn btn-outline-danger">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        setTimeout(function(){
            $('.editor_for_admin').froalaEditor({
                heightMin: 300,
                imageMove: true,
                imageUploadParam: 'file',
                imageUploadMethod: 'post',
                imageUploadURL: 'UploadImage',
                imageUploadParams: {
                    froala: 'true',               // This allows us to distinguish between Froala or a regular file upload.
                    _token: $('meta[name="token"]').attr('content'),  // This passes the laravel token with the ajax request.
                }
            });
        },500)
    </script>
@endsection
