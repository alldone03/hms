<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $device = Device::all();
        return view('pages.dashboard.admin', compact('device'));
    }
}
