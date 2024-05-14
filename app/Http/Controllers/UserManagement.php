<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagement extends Controller
{
    public function home_page() {
        return view('pages/user_management');
    }
    public function user_management() {
        return 'here will be user management page';
    }
}
