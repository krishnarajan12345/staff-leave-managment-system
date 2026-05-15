<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LeaveApplication;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $manager = Auth::user();
        $subordinateIds = $manager->subordinates()->pluck('id');
        
        $pendingLeavesCount = LeaveApplication::whereIn('user_id', $subordinateIds)
            ->where('status', 'pending')
            ->count();
            
        $teamSize = $manager->subordinates()->count();
            
        return view('manager.dashboard', compact('pendingLeavesCount', 'teamSize'));
    }
}
