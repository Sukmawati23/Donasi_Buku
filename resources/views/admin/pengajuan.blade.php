@section('content')
<h2>Daftar Pengajuan</h2>
<table class="table table-striped bg-white text-dark">
    <thead>
        <tr>
            <th>User</th>
            <th>Buku</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengajuan as $item)
        <tr>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->buku->judul }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <form method="POST" action="{{ route('pengajuan.verifikasi', $item->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection