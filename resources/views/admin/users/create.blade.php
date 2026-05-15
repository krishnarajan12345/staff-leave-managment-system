@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Create User</h2>
    <a href="{{ route('admin.users.index') }}" class="btn" style="background: white; border: 1px solid var(--border);">Back</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" >
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" >
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" >
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="role">Role</label>
            <select name="role" id="role" class="form-control" >
                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label class="form-label" for="manager_id">Assign Manager (if employee)</label>
            <select name="manager_id" id="manager_id" class="form-control">
                <option value="">None</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                        {{ $manager->name }}
                    </option>
                @endforeach
            </select>
            @error('manager_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        
        <button type="submit" class="btn btn-primary" style="width: 100%;">Create User</button>
    </form>
</div>
@endsection
