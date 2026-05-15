<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LeaveType;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('admin.leave_types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('admin.leave_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days_per_year' => 'required|integer|min:0'
        ]);

        LeaveType::create($request->all());

        return redirect()->route('admin.leave_types.index')->with('success', 'Leave Type created successfully.');
    }

    public function edit(LeaveType $leaveType)
    {
        return view('admin.leave_types.edit', compact('leaveType'));
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days_per_year' => 'required|integer|min:0'
        ]);

        $leaveType->update($request->all());

        return redirect()->route('admin.leave_types.index')->with('success', 'Leave Type updated successfully.');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();
        return redirect()->route('admin.leave_types.index')->with('success', 'Leave Type deleted successfully.');
    }
}
