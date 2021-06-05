<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render("Home");
    }

    public function login()
    {
        return Inertia::render("Login");
    }

    public function signin()
    {
        return Inertia::render("SignIn");
    }
}
