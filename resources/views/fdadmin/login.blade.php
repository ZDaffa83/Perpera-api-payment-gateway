<h2>Login Admin</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.login') }}">
    @csrf

    <label>Username:</label>
    <input type="text" name="username" value="{{ old('username') }}" required autofocus><br><br>

    <label>Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Masuk</button>
</form>

<p>Belum punya akun? <a href="{{ route('admin.list') }}">Registrasi/Lihat Admin di sini</a></p>