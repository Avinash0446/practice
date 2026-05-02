<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userDashboard()
    {
        $plans = Plan::where('is_active', 1)->get();
        return view('user.dashboard', compact('plans'));
    }
}
