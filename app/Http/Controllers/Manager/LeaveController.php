<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LeaveApplication;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $manager = Auth::user();
        $subordinateIds = $manager->subordinates()->pluck('id');
        
        $leaves = LeaveApplication::whereIn('user_id', $subordinateIds)
            ->with(['user', 'leaveType'])
            ->latest()
            ->get();
            
        return view('manager.leaves', compact('leaves'));
    }

    public function approve(Request $request, LeaveApplication $leaveApplication)
    {
        $this->authorizeManager($leaveApplication);
        
        $request->validate([
            'manager_comment' => 'nullable|string'
        ]);
        
        $leaveApplication->update([
            'status' => 'approved',
            'manager_comment' => $request->manager_comment
        ]);
        
        return back()->with('success', 'Leave application approved.');
    }

    public function reject(Request $request, LeaveApplication $leaveApplication)
    {
        $this->authorizeManager($leaveApplication);
        
        $request->validate([
            'manager_comment' => 'nullable|string'
        ]);
        
        $leaveApplication->update([
            'status' => 'rejected',
            'manager_comment' => $request->manager_comment
        ]);
        
        return back()->with('success', 'Leave application rejected.');
    }
    
    private function authorizeManager(LeaveApplication $leaveApplication)
    {
        if ($leaveApplication->user->manager_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
