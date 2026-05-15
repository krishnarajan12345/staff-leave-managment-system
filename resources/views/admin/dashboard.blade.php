@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Admin Dashboard</h2>
</div>

<div class="grid-cards">
    <div class="stat-card">
        <div class="stat-title">Total Users</div>
        <div class="stat-value" style="color: var(--primary);">{{ $stats['total_users'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Total Leaves</div>
        <div class="stat-value" style="color: var(--secondary);">{{ $stats['total_leaves'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Pending Leaves</div>
        <div class="stat-value" style="color: var(--warning);">{{ $stats['pending_leaves'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Leave Types</div>
        <div class="stat-value" style="color: var(--primary);">{{ $stats['leave_types'] }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">Recent Leave Applications</div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Type</th>
                    <th>Date Range</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLeaves as $leave)
                <tr>
                    <td>{{ $leave->user->name }}</td>
                    <td>{{ $leave->leaveType->name }}</td>
                    <td>{{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</td>
                    <td>
                        <span class="badge badge-{{ $leave->status }}">{{ ucfirst($leave->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: var(--text-muted);">No leave applications found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
