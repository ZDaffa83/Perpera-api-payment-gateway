<h2>Tambah Admin</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.store') }}">
    @csrf

    <label>Nama Admin:</label>
    <input type="text" name="nama_admin" value="{{ old('nama_admin') }}"><br><br>

    <label>Email:</label>
    <input type="email" name="email_admin" value="{{ old('email_admin') }}"><br><br>

    <label>Username:</label>
    <input type="text" name="username" value="{{ old('username') }}"><br><br>

    <label>Password:</label>
    <input type="password" name="password"><br><br>

    <button type="submit">Simpan</button>
</form>