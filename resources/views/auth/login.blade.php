<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SchoolERP Login</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div style="min-height:100vh;display:grid;place-items:center;background:var(--bg);padding:24px;">
    <div class="card" style="width:min(440px,100%);">
        <div class="card-body">
            <div class="sidebar-logo" style="padding:0;margin-bottom:24px;">
                <div class="logo-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <div class="logo-text"><h2>XYZ School</h2><span>Finance ERP</span></div>
            </div>
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" type="email" value="{{ old('email', 'admin@school.test') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" type="password" value="password" required>
                </div>
                @error('email')<div style="color:var(--danger);font-size:12px;margin-bottom:12px;">{{ $message }}</div>@enderror
                <button class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
