<?php

namespace App\Http\Controllers;

use App\Models\DelayedReply;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(){
        $notifications = DelayedReply::all();
        return view('admin.dashboard',compact('notifications'));
    }
}
