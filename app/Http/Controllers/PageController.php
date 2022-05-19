<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('spa2');
    }

    public function setup() {
        return view('welcome');
    }

    public function setup2() {
        return view('app');
    }
}
