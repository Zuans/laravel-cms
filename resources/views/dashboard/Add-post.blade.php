@extends('layouts.app')


@section('style')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection


@section('title','Add Post')

@section('content')
<div class="row">
    <div class="col-lg-2">
        @include('layouts.navside')
    </div>
    <div class="col-lg-10">
        <div class="container">
            <div class="container-wrapper">
                <h1>Add Post</h1>
                <hr style="border: 1.7px solid gray;" class="text-dark  float-left w-50">
                <br>
                @if(session('success'))
                <div class="alert alert-success alert-dismissible   w-50 fade show" role="alert">
                    <strong class="pl-5">Success</strong> Post Berhasil dibuat
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form class="w-50" enctype='multipart/form-data' action="{{ route('post.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="author" id="author" aria-describedby="emailHelp" placeholder="Enter Author Name">
                    </div>
                    @error('author')
                    <h5 class="text-danger">{{ $message }}</h5>
                    @enderror
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                    </div>
                    @error('title')
                    <h5 class="text-danger">{{ $message }}</h5>
                    @enderror
                    <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <input type="text" name="excerpt" class="form-control" id="excerpt" placeholder="Enter excerpt">
                    </div>
                    @error('excerpt')
                    <h5 class="text-danger">{{ $message }}</h5>
                    @enderror
                    <div class="form-group">
                        <label for="status">Status Post</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">
                                <p class="text-center">-- Status Post --</p>
                            </option>
                            <option value="Published">Publish</option>
                            <option value="Drafted">Draft</option>
                        </select>
                    </div>
                    @error('status')
                    <h5 class="text-danger">{{ $message }}</h5>
                    @enderror
                    <div class="form-group float-left">
                        <label><strong>Content :</strong></label>
                        <textarea class="summernote" id="summary" name="content"></textarea>
                    </div>
                    @error('content')
                    <h5 class="text-danger">{{ $message }}</h5>
                    @enderror
                    <label for="validatedCustomFile">Thumbnail</label>
                    <div class="custom-file">
                        <input type="file" name="thumbnail" class="custom-file-input" onchange="loadFile(event)" id="validatedCustomFile">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <label id="view-text" class="font-weight-bold mt-3" for=""></label>
                    <img src="" id="view-img" style="width: 8rem;" class="mt-1 d-block" alt="">
                    @error('thumbnail')
                    <h5 class="text-danger mt-4">{{ $message }}</h5>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    setTimeout(function() {
        CKEDITOR.replace('summary');
    }, 400);

    const loadFile = (event) => {
        let img = document.getElementById('view-img');
        let text = document.getElementById('view-text');
        img.src = URL.createObjectURL(event.target.files[0]);
        text.innerHTML = "Preview Image";
        img.onload = function() {
            URL.revokeObjectURL(img.src);
        }
    }
</script>`
@endsection