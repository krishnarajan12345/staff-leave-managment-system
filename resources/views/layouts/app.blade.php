<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Leave Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @if(Auth::check())
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                LeaveSystem
            </div>
            <nav>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Manage Users</a>
                    <a href="{{ route('admin.leave_types.index') }}" class="nav-link">Leave Types</a>
                @elseif(Auth::user()->role === 'manager')
                    <a href="{{ route('manager.dashboard') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('employee.dashboard') }}" class="nav-link">My Leaves</a>
                    <a href="{{ route('employee.leaves.create') }}" class="nav-link">Apply Leave</a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" style="margin-top: 2rem;">
                    @csrf
                    <button type="submit" class="nav-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; color: var(--danger);">Logout</button>
                </form>
            </nav>
        </aside>
        
        <main class="main-content">
            <header class="topbar">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <span style="font-weight: 500;">{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>
                </div>
            </header>
            
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #f87171;">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    @else
        @yield('content')
    @endif
</body>
</html>
