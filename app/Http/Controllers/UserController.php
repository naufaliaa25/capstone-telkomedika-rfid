<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAllDoctors() {
        $doctors = User::where('role', 'doctor')->get();
        return successResponse($doctors, 'Doctors data retrieved successfully', 200);
    }

}
