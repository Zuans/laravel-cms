@extends('part.app')

@section('title','Home')

@section('style')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
<div class="jumbotron bg-white">
    <div class="row mt-1">
        <div class="col-6 pl-5">
            <h4 class="mt-3 font-weight-bold text-dark d-inline pr-2">Hi,Welcome</h4>
            <h1 class=" font-weight-bold text-dark mt-3">Zuans Post's</h1>
            <h4 class="mt-3 font-weight-bold">Let's, Post some article or anyhing you want !</h4>
            <p class="mt-3 font-weight-bold">Created By <a href="https://www.instagram.com/juanewaldo/?hl=id" target="_blank">Zuans</a></p>
            <a href="{{ route('dashboard.addPost') }}" class="btn btn-primary text-white btn-outline-dark">Get Started</a>
        </div>
        <div class="col-6">
            <img src="{{ asset('img/welcome.jpg') }}" class="avatar-img" alt="">
        </div>
    </div>
</div>
<hr style="border: 2px solid gray;" class="w-50 mt-2">
<div class="content">
    <h1 class="text-dark font-weight-bold  mt-5">Recent Posts</h1>
    <div class="card-post d-block">
        <div class="container mt-5">
            @if(count($posts) == 0 )
            <h1 class="text-dark text-center">Nothing Post Left</h1>
            @else
            @foreach( $posts as $post )
            <div class="row mt-5 px-5">
                <div class="post-wrapper mx-auto col-lg-10">
                    <div class="row p-4">
                        <div class="col-lg-4 mt-5">
                            <img src="storage/thumbnail/{{ $post->thumbnail}}" class="thumbnail" alt="">
                        </div>
                        <div class="col-lg-8">
                            <h3 class="mt-4 text-left font-weight-bold text-dark">{{ $post->title }}</h1>
                                <p class="text-left font-weight-bold text-dark ">Created By: {{ $post->author }}</p>
                                <p class="text-left font-weight-bold text-dark ">{{ $post->excerpt }}</p>
                                <p class="text-left font-weight-bold text-dark ">Created at: {{ $post->created_at->diffForHumans() }}</p>
                                <a href="{{ route('search.post',[ 'id' => $post->id]) }}" class="d-flex justify-content-start align-items-center font-weight-bold text-primary">See Details <i class="fas fa-angle-double-right pl-2 text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <button id="load-more" class="btn btn-primary px-4 mt-5">Load More</button>
            @endif
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const btn = document.getElementById('load-more');
    let index = 3;
    btn.addEventListener('click', async function() {
        const postElement = document.querySelector('.card-post');
        const token = document.querySelector('meta[name="_token"]').content;
        const url = "{{ route('search.add-post') }}";
        index += 3
        try {
            const res = await fetch(url, {
                headers: {
                    "X-CSRF-TOKEN": token,
                    "Content-type": "application/json",
                },
                method: "POST",
                body: JSON.stringify({
                    add: index
                })
            })
            const {
                result
            } = await res.json();
            postElement.innerHTML = result;
        } catch (error) {

        }
    })
</script>
@endsection