<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Booking;
use app\Models\Customer;
use app\Models\Models\Vehicle;
class AdminController extends Controller
{
   public function login()
{
    return view('admin.login');
}
}
