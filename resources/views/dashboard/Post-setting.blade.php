@extends('layouts.app')

@section('title','Post Setting')


@section('style')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/you-post.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-2">
        @include('layouts.navside')
    </div>
    <div class="col-lg-10">
        <div class="container">
            <div class="container-wrapper">
                <h1>All Post</h1>
                <hr style="border: 1.7px solid gray;" class="text-dark float-left w-50">
                <br>
                @if(session('success'))
                <div class="alert alert-success alert-dismissible w-50 fade show" role="alert">
                    <strong>Success!</strong>&nbsp; Post Berhasil Dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if( count($datas) <= 0 ) <br>
                    <h1 class="text-center mt-5">Nothing Post Left</h1>
                    <br>
                    <img src="{{ asset('img/empty.jpg') }}" class="mx-auto d-block" style="width: 20vw;" alt="">
                    <br>
                    @else
                    <div class="row  mt-5">
                        <div class="col-lg-4">
                            <div class="card mx-auto" style="width: 13rem;">
                                <div class="card-body bg-primary mt-3 text-white">
                                    <h5 class="card-title font-weight-bold">Total Post :</h5>
                                    <p class="card-text display-3 font-weight-bold">{{ $totalPost }}</p>
                                    <i class="fas fa-clipboard icons"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-4">
                                <div class="card mx-auto" style="width: 14rem;">
                                    <div class="card-body bg-success mt-3 text-white">
                                        <h5 class="card-title font-weight-bold">Total Published Post :</h5>
                                        <p class="card-text display-3 font-weight-bold">{{ $publishPost }}</p>
                                        <i class="fas fa-clipboard icons"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-4">
                                <div class="card mx-auto" style="width: 13rem;">
                                    <div class="card-body bg-secondary mt-3 text-white">
                                        <h5 class="card-title font-weight-bold">Total Drafted Post :</h5>
                                        <p class="card-text display-3 font-weight-bold">{{ $draftPost }}</p>
                                        <i class="fas fa-clipboard icons"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <br>
                        <h3>Search..</h3>
                        <input id="search" onkeyup="searchData(this)" class="d-inline px-5 py-1" type="text" placeholder="Search(Author or Title)" width="100px;" class="form-control mt-2">
                    </div>
                    <div id="table-data" class="mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $datas as $data )
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $data->author}}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->created_at->diffForHumans() }}</td>
                                    <td>
                                        <form action="{{ route('post.edit',[ 'id' => $data->id]) }}" class="d-inline" method="GET">
                                            @csrf
                                            <button class="btn btn-primary">Edit</button>
                                        </form>
                                        <form action="{{ route('post.delete',[ 'id' => $data->id]) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                        <a class="btn btn-secondary" href="{{ route('search.post',[ 'id' => $data->id ]) }}">See Post</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $datas->links() }}
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const token = document.querySelector('input[name="_token"]').value;
    const searchData = async function(e) {
        const url = "{{ route('post.admin-search') }}"
        const value = e.value;
        const table = document.querySelector('#table-data');
        try {
            const res = await fetch(url, {
                headers: {
                    "X-CSRF-TOKEN": token,
                    "Content-type": "application/json"
                },
                method: "POST",
                body: JSON.stringify({
                    search: value,
                })
            });
            const {
                result
            } = await res.json();
            if (result) {
                table.innerHTML = result;
            }
        } catch (error) {
            console.error(error);
        }
    }
</script>
@endsection