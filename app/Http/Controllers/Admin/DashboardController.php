<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class DashboardController extends Controller
{
    public  function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('dashboard.users.show', compact('user'));
    }
}
