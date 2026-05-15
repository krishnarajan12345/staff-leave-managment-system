@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>My Dashboard</h2>
    <a href="{{ route('employee.leaves.create') }}" class="btn btn-primary">Apply for Leave</a>
</div>

<div class="grid-cards">
    <div class="stat-card">
        <div class="stat-title">Pending Applications</div>
        <div class="stat-value" style="color: var(--warning);">{{ $stats['pending'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Approved Leaves</div>
        <div class="stat-value" style="color: var(--secondary);">{{ $stats['approved'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Rejected Applications</div>
        <div class="stat-value" style="color: var(--danger);">{{ $stats['rejected'] }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">My Leave Applications</div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Date Range</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Manager Comment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $leave)
                <tr>
                    <td>{{ $leave->leaveType->name }}</td>
                    <td>{{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</td>
                    <td>{{ Str::limit($leave->reason, 50) }}</td>
                    <td>
                        <span class="badge badge-{{ $leave->status }}">{{ ucfirst($leave->status) }}</span>
                    </td>
                    <td>{{ $leave->manager_comment ?: '-' }}</td>
                    <td>
                        @if($leave->status === 'pending')
                            <form action="{{ route('employee.leaves.destroy', $leave) }}" method="POST" onsubmit="return confirm('Cancel this application?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">Cancel</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted);">No leave applications found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
