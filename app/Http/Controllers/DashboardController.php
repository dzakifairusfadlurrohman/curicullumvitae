<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;

class DashboardController extends Controller
{
    public function index()
    {
        $applicants = Applicant::all();
        return view('dashboard', compact('applicants'));
    }
}
