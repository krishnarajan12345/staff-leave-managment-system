@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Apply for Leave</h2>
    <a href="{{ route('employee.dashboard') }}" class="btn" style="background: white; border: 1px solid var(--border);">Back</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('employee.leaves.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="leave_type_id">Leave Type</label>
            <select name="leave_type_id" id="leave_type_id" class="form-control" >
                <option value="">Select leave type</option>
                @foreach($leaveTypes as $type)
                    <option value="{{ $type->id }}" {{ old('leave_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('leave_type_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label class="form-label" for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" >
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" >
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="reason">Reason</label>
            <textarea name="reason" id="reason" class="form-control" rows="4" >{{ old('reason') }}</textarea>
            @error('reason')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Application</button>
    </form>
</div>
@endsection
