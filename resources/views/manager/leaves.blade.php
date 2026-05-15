@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Team Leave Applications</h2>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Type</th>
                    <th>Date Range</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $leave)
                <tr>
                    <td>{{ $leave->user->name }}</td>
                    <td>{{ $leave->leaveType->name }}</td>
                    <td>{{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</td>
                    <td>{{ Str::limit($leave->reason, 50) }}</td>
                    <td>
                        <span class="badge badge-{{ $leave->status }}">{{ ucfirst($leave->status) }}</span>
                    </td>
                    <td>
                        @if($leave->status === 'pending')
                            <div style="display: flex; gap: 0.5rem; align-items: flex-start; flex-direction: column;">
                                <form action="{{ route('manager.leaves.approve', $leave) }}" method="POST" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                    @csrf
                                    <input type="text" name="manager_comment" placeholder="Comment..." class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; width: 120px;">
                                    <button type="submit" class="btn btn-success" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">Approve</button>
                                </form>
                                <form action="{{ route('manager.leaves.reject', $leave) }}" method="POST" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                    @csrf
                                    <input type="text" name="manager_comment" placeholder="Comment..." class="form-control" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; width: 120px;">
                                    <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">Reject</button>
                                </form>
                            </div>
                        @else
                            {{ $leave->manager_comment ?: '-' }}
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted);">No leave applications from team members.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
