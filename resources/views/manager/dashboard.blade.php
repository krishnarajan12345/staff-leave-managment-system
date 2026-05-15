@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Manager Dashboard</h2>
</div>

<div class="grid-cards">
    <div class="stat-card">
        <div class="stat-title">Team Size</div>
        <div class="stat-value" style="color: var(--primary);">{{ $teamSize }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Pending Leave Requests</div>
        <div class="stat-value" style="color: var(--warning);">{{ $pendingLeavesCount }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">Quick Actions</div>
    <div>
        <a href="{{ route('manager.leaves') }}" class="btn btn-primary">Review Team Leaves</a>
    </div>
</div>
@endsection
