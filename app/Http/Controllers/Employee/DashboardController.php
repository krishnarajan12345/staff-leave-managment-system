<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\LeaveApplication;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $leaves = LeaveApplication::where('user_id', $user->id)->with('leaveType')->latest()->get();
        
        $stats = [
            'pending' => $leaves->where('status', 'pending')->count(),
            'approved' => $leaves->where('status', 'approved')->count(),
            'rejected' => $leaves->where('status', 'rejected')->count(),
        ];
        
        return view('employee.dashboard', compact('leaves', 'stats'));
    }
}
