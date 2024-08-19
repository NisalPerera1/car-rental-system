<!-- resources/views/admin/login.blade.php -->

<h1>Admin Login</h1>

<form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>

    <button type="submit">Login</button>
</form>
