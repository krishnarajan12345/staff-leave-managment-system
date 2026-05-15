@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Manage Leave Types</h2>
    <a href="{{ route('admin.leave_types.create') }}" class="btn btn-primary">Create Leave Type</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Days Per Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveTypes as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->days_per_year }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.leave_types.edit', $type) }}" class="btn btn-primary" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">Edit</a>
                            <form action="{{ route('admin.leave_types.destroy', $type) }}" method="POST" onsubmit="return confirm('Delete this leave type?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
