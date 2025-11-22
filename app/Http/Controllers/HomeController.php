<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $applications = Application::where('status', true)->latest()->get();
        return view('home', compact('applications'));
    }
}