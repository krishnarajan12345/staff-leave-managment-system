<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LeaveApplication;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function create()
    {
        $leaveTypes = LeaveType::all();
        return view('employee.leave_create', compact('leaveTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $overlapping = LeaveApplication::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->where(function($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                      ->orWhere(function($q) use ($request) {
                          $q->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                      });
            })->exists();

        if ($overlapping) {
            return back()->with('error', 'You already have a pending or approved leave during this period.');
        }

        LeaveApplication::create([
            'user_id' => Auth::id(),
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('employee.dashboard')->with('success', 'Leave application submitted successfully.');
    }

    public function destroy(LeaveApplication $leaveApplication)
    {
        if ($leaveApplication->user_id !== Auth::id() || $leaveApplication->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $leaveApplication->delete();

        return redirect()->route('employee.dashboard')->with('success', 'Leave application cancelled.');
    }
}
