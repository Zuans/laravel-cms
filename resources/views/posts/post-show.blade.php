@extends('part.app')

@section('title','Info Post')

@section('style')
<link rel="stylesheet" href="{{ asset('css/detail-post.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="offset-lg-1">
        </div>
        <div class="col-lg-10 ">
            <div class="post-wrapper ">
                <div class="post-head p-3 py-4 text-dark row">
                    <div class="col-lg-4 d-flex-justify-content-center">
                        <img src="/storage/thumbnail/{{ $post->thumbnail }}" class="post-img" alt="">
                    </div>
                    <div class="col-lg-8 post-info">
                        <h1 id="title-post" class="font-weight-bold mt-2">{{ $post->title }}</h1 class="mt-5">
                        <h4 class="font-weight-bold mt-5">Author: {{ $post->author}}</h4>
                        <h5 class="font-weight-bold">{{ $post->status}}</h5>
                        <p class="font-weight-bold">Created: {{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <hr class="my-5  w-75" style="border: 2px solid gray;">

                <div class="bg-dark post-body p-4">
                    <div class="post-content col-lg-12">
                        @if( $post->excerpt )
                        <h3 class="text-white">"{{ $post->excerpt }}"</h3>
                        @endif
                        <div class="content text-left font-weight-bold text-white">
                            <p class="">&nbsp;&nbsp;&nbsp;{!! $post->content !!}</p>
                        </div>
                    </div>
                    <a href="/" class="btn btn-primary mt-5"><i class="fas fa-arrow-left pr-2"></i>HOME</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    const title = document.querySelector('#title-post');
    const text = title.textContent;

    function upperCase(text) {
        const upCase = text.toUpperCase();
        title.innerHTML = upCase;
    }

    upperCase(text);
</script>
@endsection