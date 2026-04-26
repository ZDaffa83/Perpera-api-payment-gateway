<h2>Daftar Admin</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.create') }}">Tambah Admin</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Username</th>
        <th>Created</th>
        <th>Aksi</th>
    </tr>

    @foreach ($admin as $a)
    <tr>
        <td>{{ $a->id }}</td>
        <td>{{ $a->nama_admin }}</td>
        <td>{{ $a->email_admin }}</td>
        <td>{{ $a->username }}</td>
        <td>{{ $a->created_at }}</td>
        <td>
            <a href="{{ route('admin.edit', $a->id) }}">Edit</a>
            <form action="{{ route('admin.destroy', $a->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>