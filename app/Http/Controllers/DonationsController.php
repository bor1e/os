<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationsController extends Controller
{
    public function index()
    {
        return view('donate');
    }

    public function store(Request $request)
    {
        dd($request->toArray());

        return view('donate');
    }
}
