<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LeaveApplication;
use App\Models\LeaveType;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_leaves' => LeaveApplication::count(),
            'pending_leaves' => LeaveApplication::where('status', 'pending')->count(),
            'leave_types' => LeaveType::count(),
        ];
        
        $recentLeaves = LeaveApplication::with(['user', 'leaveType'])->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentLeaves'));
    }
}
