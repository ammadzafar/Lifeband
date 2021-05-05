<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
}
