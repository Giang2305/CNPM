<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class AdminController extends Controller
{
    public function index() {
        $userId = session('user_id');
        $user = User::findOrFail($userId);
        return view('Admin.home', compact('user'));
    }


}
