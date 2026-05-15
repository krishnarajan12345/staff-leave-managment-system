<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        LeaveType::create(['name' => 'Annual Leave', 'days_per_year' => 12]);
        LeaveType::create(['name' => 'Sick Leave', 'days_per_year' => 6]);
        LeaveType::create(['name' => 'Casual Leave', 'days_per_year' => 5]);
    }
}
