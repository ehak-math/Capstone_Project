
<div class="login-box">
    <h2>Login</h2>

    @if(session('error'))
        <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="form-group mt-2">
            <label>Password</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Login</button>
    </form>
</div>
