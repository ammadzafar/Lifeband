<?php

namespace App\Http\Controllers\Family;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
}
