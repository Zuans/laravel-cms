<div class="container mt-5">
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
</div>