<table id="" class="table table-striped mt-5 ">
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
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->author }}</td>
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
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pt-3 d-flex justify-content-center">
    {{ $datas->links() }}
</div>