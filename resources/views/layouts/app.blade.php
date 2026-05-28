<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SchoolERP Finance')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="logo-text"><h2>XYZ School</h2><span>Finance ERP</span></div>
        </div>
        <nav class="sidebar-nav">
            @php($nav = [
                ['Dashboard', 'dashboard', 'fa-grip', route('dashboard')],
                ['Income', 'incomes.*', 'fa-hand-holding-dollar', route('incomes.index')],
                ['Expenses', 'expenses.*', 'fa-receipt', route('expenses.index')],
                ['Payroll', 'payrolls.*', 'fa-wallet', route('payrolls.index')],
                ['Reports', 'reports.*', 'fa-chart-pie', route('reports.index')],
            ])
            <div class="nav-section-label">School Finance</div>
            @foreach($nav as [$label, $pattern, $icon, $url])
                <a class="nav-item {{ request()->routeIs($pattern) ? 'active' : '' }}" href="{{ $url }}">
                    <span class="nav-icon"><i class="fa-solid {{ $icon }}"></i></span>
                    <span class="nav-label">{{ $label }}</span>
                </a>
            @endforeach
        </nav>
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="avatar">SA</div>
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name ?? 'School Admin' }}</div>
                    <div class="role">School Admin</div>
                </div>
            </div>
        </div>
    </aside>
    <div class="overlay" id="overlay"></div>

    <main class="main" id="main">
        <header class="topbar">
            <button class="menu-toggle" id="menuToggle"><i class="fa-solid fa-bars"></i></button>
            <div class="breadcrumb">
                <span>SchoolERP</span><span class="sep"><i class="fa-solid fa-chevron-right" style="font-size:9px"></i></span>
                <span class="current" id="breadcrumbCurrent">@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="topbar-actions">
                <a class="topbar-btn" href="{{ route('reports.pdf') }}" title="Download report"><i class="fa-solid fa-file-pdf"></i></a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="topbar-btn" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
                <div class="topbar-user"><div class="topbar-avatar">SA</div></div>
            </div>
        </header>

        <section class="page active">
            <div class="page-content" style="padding:24px;">
                @if(session('success'))
                    <div class="alert-banner green" style="margin-bottom:16px;">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert-banner red" style="margin-bottom:16px;">{{ $errors->first() }}</div>
                @endif
                @yield('content')
            </div>
        </section>
    </main>
</div>
<script src="{{ asset('script.js') }}"></script>
<script>
document.getElementById('menuToggle')?.addEventListener('click', () => document.getElementById('sidebar')?.classList.toggle('open'));
</script>
</body>
</html>
