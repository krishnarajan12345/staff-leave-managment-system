@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Create Leave Type</h2>
    <a href="{{ route('admin.leave_types.index') }}" class="btn" style="background: white; border: 1px solid var(--border);">Back</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.leave_types.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" >
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="days_per_year">Days Per Year</label>
            <input type="number" name="days_per_year" id="days_per_year" class="form-control" value="{{ old('days_per_year') }}"  min="0">
            @error('days_per_year')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        
        <button type="submit" class="btn btn-primary" style="width: 100%;">Create Leave Type</button>
    </form>
</div>
@endsection
